<?php

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Application\Service\UserInterface;
use Concrete\Core\Localization\Service\Date;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Support\Facade\Url;
use Concrete\Core\User\PrivateMessage\Mailbox;
use Concrete\Core\User\PrivateMessage\PrivateMessage;
use Concrete\Core\User\PrivateMessage\PrivateMessageList;
use Concrete\Core\User\UserInfo;
use Concrete\Core\Validation\CSRF\Token;
use Concrete\Core\View\View;

/** @var int $msgID */
/** @var UserInfo $recipient */
/** @var View $view */
/** @var Mailbox $mailbox * */
/** @var string $box * */
/** @var Mailbox $inbox * */
/** @var Mailbox $sent * */
/** @var PrivateMessage $msg * */
/** @var PrivateMessageList $messageList * */
/** @var PrivateMessage[] $messages * */
/** @var string $backURL */
/** @var string $deleteURL */
/** @var string $dateAdded */

$app = Application::getFacadeApplication();
/** @var Date $dh */
$dh = $app->make(Date::class);
/** @var UserInterface $userInterface */
$userInterface = $app->make(UserInterface::class);
/** @var Token $token */
$token = $app->make(Token::class);

?>

<div class="messages">
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>
                    <?php echo t("Messages"); ?>
                </h1>

                <p>
                    <?php echo t("Each level of certification build on the one before."); ?>
                </p>

            </div>
        </div>

        <div class="row">
            <div class="col">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link <?php echo $mailbox->getMailboxID() == $inbox->getMailboxID() ? "active" : ""; ?>"
                           href="<?php echo (string)Url::to("/account/messages", $inbox->getMailboxID()); ?>">
                            <?php echo t("Inbox"); ?>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link <?php echo $mailbox->getMailboxID() == $sent->getMailboxID() ? "active" : ""; ?>"
                           href="<?php echo (string)Url::to("/account/messages", $sent->getMailboxID()); ?>">
                            <?php echo t("Sent"); ?>
                        </a>
                    </li>
                </ul>
            </div>

            <div class="col">
                <div class="float-right">
                    <a href="javascript:void(0);" class="btn btn-primary send-message">
                        <?php echo t("Send Message"); ?>
                    </a>
                </div>
            </div>
        </div>


        <div class="clearfix"></div>

        <div class="row">
            <div class="col">
                <table class="table message-table">
                    <thead>
                    <tr>
                        <th>
                            <?php if ('sent' == $mailbox) { ?>
                                <?php echo t('To'); ?>
                            <?php } else { ?>
                                <?php echo t('From'); ?>
                            <?php } ?>
                        </th>

                        <th>
                            <?php echo t('Subject'); ?>
                        </th>

                        <th class="text-right">
                            <?php echo t('Sent At'); ?>
                        </th>
                    </tr>
                    </thead>

                    <tbody>
                    <?php if (is_array($messages)) { ?>
                        <?php foreach ($messages as $msg) { ?>
                            <?php $profileURL = $msg->getMessageRelevantUserObject()->getUserPublicProfileURL(); ?>
                            <tr class="<?php echo $msg->isMessageUnread() ? "unread" : ""; ?>" data-message-id="<?php echo h($msg->getMessageID()); ?>">
                                <td class="ccm-profile-message-from">
                                    <?php if ($profileURL) { ?>
                                        <a href="<?php echo $profileURL; ?>">
                                            <?php echo $msg->getMessageRelevantUserName(); ?>
                                        </a>
                                    <?php } else { ?>
                                        <div>
                                            <?php echo $msg->getMessageRelevantUserName(); ?>
                                        </div>
                                    <?php } ?>
                                </td>

                                <td class="ccm-profile-messages-item-name">
                                    <a href="javascript:void(0);" class="send-message"
                                       data-message-id="<?php echo $msg->getMessageID(); ?>">
                                        <?php echo $msg->getFormattedMessageSubject(); ?>
                                    </a>
                                </td>

                                <td class="text-right">
                                    <?php /** @noinspection PhpUnhandledExceptionInspection */
                                    echo $dh->formatDateTime($msg->getMessageDateAdded(), true); ?>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php } else { ?>
                        <tr>
                            <td colspan="4">
                                <?php echo t('No messages found.'); ?>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

                <?php
                $summary = $messageList->getSummary();
                $paginator = $messageList->getPagination(false, []);
                $paginator->classOff = "page-link";
                $paginator->classOn = "page-link";
                $paginator->classCurrent = "page-link";
                ?>
                <?php if ($summary->pages > 1) { ?>
                <ul class="pagination justify-content-center">
                    <?php echo $paginator->getPages("li"); ?>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>