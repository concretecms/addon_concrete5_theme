<?php /** @noinspection PhpInconsistentReturnPointsInspection */
/** @noinspection PhpUnused */

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

namespace Concrete\Package\ConcreteCmsTheme\Controller\SinglePage\Account;

use Concrete\Core\Attribute\Category\CategoryService;
use Concrete\Core\Attribute\Category\UserCategory;
use Concrete\Core\Attribute\Controller;
use Concrete\Core\Entity\Attribute\Category;
use Concrete\Core\Entity\Attribute\Key\UserKey;
use Concrete\Core\Error\UserMessageException;
use Concrete\Core\Support\Facade\Url;
use Concrete\Core\User\UserInfo;
use PortlandLabs\ConcreteCmsTheme\Page\Controller\AccountPageController;

/** @noinspection PhpInconsistentReturnPointsInspection */

class EditProfile extends AccountPageController
{
    /**
     * @throws UserMessageException
     */
    public function view()
    {
        $profile = $this->get('profile');

        if (!is_object($profile)) {
            throw new UserMessageException(t('You must be logged in to access this page.'));
        }

        /** @var CategoryService $service */
        $service = $this->app->make(CategoryService::class);

        /** @var Category $categoryEntity */
        $categoryEntity = $service->getByHandle('user');
        $category = $categoryEntity->getController();
        $setManager = $category->getSetManager();
        $attributeSets = [];

        foreach ($setManager->getAttributeSets() as $set) {
            foreach ($set->getAttributeKeys() as $ak) {
                if ($ak->isAttributeKeyEditableOnProfile()) {
                    $attributeSets[$set->getAttributeSetDisplayName()][] = $ak;
                }
            }
        }

        $this->set('attributeSets', $attributeSets);

        $unassignedAttributes = [];

        foreach ($setManager->getUnassignedAttributeKeys() as $ak) {
            if ($ak->isAttributeKeyEditableOnProfile()) {
                $unassignedAttributes[] = $ak;
            }
        }

        $this->set('unassignedAttributes', $unassignedAttributes);
    }

    /**
     * @throws UserMessageException
     */
    public function save_complete()
    {
        $this->set('success', t('Profile updated successfully.'));
        $this->view();
    }

    /**
     * @throws UserMessageException
     */
    public function save()
    {
        $this->view();

        $ui = $this->get('profile');
        /* @var UserInfo $ui */

        $app = $this->app;

        $valt = $app->make('token');

        if (!$valt->validate('profile_edit')) {
            $this->error->add($valt->getErrorMessage());
        }

        // validate the user's email
        $email = $this->post('uEmail');
        $app->make('validator/user/email')->isValidFor($email, $ui, $this->error);

        // Username validation
        $username = $this->post('uName');

        if ($username) {
            $app->make('validator/user/name')->isValidFor($username, $ui, $this->error);
        }

        /** @var UserCategory $userCategory */
        $userCategory = $this->app->make(UserCategory::class);
        /** @var UserKey[] $aks */
        $aks = $userCategory->getEditableInProfileList();

        foreach ($aks as $uak) {
            /** @var Controller $controller */
            $controller = $uak->getController();
            $validator = $controller->getValidator();
            $response = $validator->validateSaveValueRequest($controller, $this->request, $uak->isAttributeKeyRequiredOnProfile());

            if (!$response->isValid()) {
                $error = $response->getErrorObject();
                $this->error->add($error);
            }
        }

        if (!$this->error->has()) {
            $data['uEmail'] = $email;

            /** @noinspection PhpParamsInspection */
            $ui->saveUserAttributesForm($aks);
            $ui->update($data);

            return $this->responseFactory->redirect((string)Url::to('/account/edit_profile', 'save_complete'));
        }
    }

}