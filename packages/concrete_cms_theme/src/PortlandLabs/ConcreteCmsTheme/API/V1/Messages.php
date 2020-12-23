<?php

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace PortlandLabs\ConcreteCmsTheme\API\V1;

use Concrete\Core\Application\Application;
use Concrete\Core\Application\EditResponse;
use Concrete\Core\Error\ErrorList\ErrorList;
use Concrete\Core\Form\Service\Validation;
use Concrete\Core\Http\Request;
use Concrete\Core\Localization\Service\Date;
use Concrete\Core\User\PrivateMessage\Mailbox as UserPrivateMessageMailbox;
use Concrete\Core\User\PrivateMessage\PrivateMessage as UserPrivateMessage;
use Concrete\Core\User\User;
use Concrete\Core\User\UserInfo;
use Concrete\Core\User\UserInfoRepository;
use Concrete\Core\Validation\CSRF\Token;
use Symfony\Component\HttpFoundation\JsonResponse;

class Messages
{
    protected $request;
    protected $app;
    protected $user;
    protected $userInfoRepository;
    protected $userInfo;
    protected $dateHelper;
    protected $token;
    protected $validation;

    public function __construct(
        Request $request,
        Application $app,
        User $user,
        UserInfoRepository $userInfoRepository,
        Date $dateHelper,
        Token $token,
        Validation $validation
    )
    {
        $this->request = $request;
        $this->app = $app;
        $this->user = $user;
        $this->userInfoRepository = $userInfoRepository;
        $this->userInfo = $this->userInfoRepository->getByID($this->user->getUserID());
        $this->dateHelper = $dateHelper;
        $this->token = $token;
        $this->validation = $validation;
    }

    protected function validateUser($uID)
    {
        return (($ui = $this->userInfoRepository->getByID($uID)) instanceof UserInfo && ($ui->getAttribute('profile_private_messages_enabled') == 1));
    }

    public function compose()
    {
        $messageData = [
            "msgID" => '',
            "msgSubject" => '',
            "msgBody" => '',
            "uID" => '',
            "uName" => '',
            "box" => '',
            "sendMessageToken" => $this->token->generate("validate_send_message"),
            "searchUserToken" => $this->token->generate('quick_user_select_receiver')
        ];

        $response = new EditResponse();
        $errorList = new ErrorList();

        $mailbox = UserPrivateMessageMailbox::get($this->userInfo, UserPrivateMessageMailbox::MBTYPE_INBOX);
        $messageData["box"] = $mailbox->getMailboxID();

        if ($this->request->query->has("msgID") && $this->request->query->getInt("msgID") > 0) {
            $messageId = (int)$this->request->query->get("msgID");

            $msg = UserPrivateMessage::getByID($messageId, $mailbox);

            if (!$msg) {
                $errorList->add(t('Message not found.'));
            } elseif (!$this->userInfo->canReadPrivateMessage($msg)) {
                $errorList->add(t('Access Denied.'));
            }

            if (!$errorList->has()) {
                if ($this->validateUser($msg->getMessageRelevantUserID())) {
                    $ui = $this->userInfoRepository->getByID($msg->getMessageRelevantUserID());

                    $messageData["msgID"] = $msg->getMessageID();
                    $messageData["msgSubject"] = t("Re: %s", $msg->getFormattedMessageSubject());

                    $body = "\n\n\n" . $msg->getMessageDelimiter() . "\n";
                    /** @noinspection PhpUnhandledExceptionInspection */
                    $body .= t("From: %s\nDate Sent: %s\nSubject: %s", $msg->getMessageAuthorName(), $this->dateHelper->formatDateTime($msg->getMessageDateAdded(), true), $msg->getFormattedMessageSubject());
                    $body .= "\n\n" . h($msg->getMessageBody());

                    $messageData["msgBody"] = $body;

                    $messageData["uID"] = $msg->getMessageRelevantUserID();
                    $messageData["uName"] = $ui->getUserName();

                    // mark as read
                    $msg->markAsRead();
                } else {
                    $errorList->add(t("The user don't want to receive messages."));
                }
            }
        } else if ($this->request->query->has("uID") && $this->request->query->getInt("uID") > 0) {
            $uID = $this->request->query->getInt('uID');
            $recipient = $this->userInfoRepository->getByID($uID);

            if (!$recipient instanceof UserInfo) {
                $errorList->add(t("The user doesn't exists."));
            } else if ($recipient->getAttribute('profile_private_messages_enabled') != 1) {
                $errorList->add(t("The user don't want to receive messages."));
            } else {
                $messageData["uID"] = $uID;
                $messageData["uName"] = $recipient->getUserName();
            }
        }

        $response->setAdditionalDataAttribute("messageData", $messageData);

        $response->setError($errorList);

        return new JsonResponse($response);
    }

    public function send()
    {
        $response = new EditResponse();
        $errorList = new ErrorList();

        $this->validation->setData($this->request->request->all());
        $this->validation->addRequired('uID', t("You need to select a receiver."));
        $this->validation->addRequired('msgSubject', t("You haven't written a subject!"));
        $this->validation->addRequired('msgBody', t("You haven't written a message!"));
        $this->validation->addRequiredToken('validate_send_message');

        if ($this->validation->test()) {
            $uID = $this->request->request->getInt('uID');
            $recipient = $this->userInfoRepository->getByID($uID);

            if (!$recipient instanceof UserInfo) {
                $errorList->add(t("The user doesn't exists."));
            } else if ($recipient->getAttribute('profile_private_messages_enabled') != 1) {
                $errorList->add(t("The user don't want to receive messages."));
            } else {
                $subject = $this->request->request->get("msgSubject");
                $body = $this->request->request->get("msgBody");

                $inReplyTo = null;

                if ($this->request->request->has("msgID") && $this->request->request->getInt("msgID") > 0) {
                    // This message is an reply to another message
                    $msgID = $this->request->request->getInt("msgID");
                    $mailbox = UserPrivateMessageMailbox::get($this->userInfo, UserPrivateMessageMailbox::MBTYPE_INBOX); // @todo: double check this
                    $inReplyTo = UserPrivateMessage::getByID($msgID, $mailbox);
                }

                $r = $this->userInfo->sendPrivateMessage(
                    $recipient,
                    $subject,
                    $body,
                    $inReplyTo
                );

                if ($r === null) {
                    if ($inReplyTo === null) {
                        $response->setMessage(t("Message sent!"));
                    } else {
                        $response->setMessage(t("Reply sent!"));
                    }
                } else if ($r === false) {
                    $errorList->add(t("The message was detected as spam."));
                } else if ($r instanceof ErrorList) {
                    $errorList = $r;
                }
            }
        } else {
            $errorList = $this->validation->getError();
        }

        $response->setError($errorList);

        return new JsonResponse($response);
    }
}