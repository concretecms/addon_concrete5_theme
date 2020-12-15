<?php

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

defined('C5_EXECUTE') or die('Access Denied.');

use Concrete\Core\Attribute\Form\Renderer;
use Concrete\Core\Config\Repository\Repository;
use Concrete\Core\Entity\Attribute\Key\UserKey;
use Concrete\Core\Form\Service\Form;
use Concrete\Core\Localization\Localization;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\User\UserInfo;
use Concrete\Core\Validation\CSRF\Token;
use Concrete\Core\Page\View\PageView;

/** @var UserKey[]|null $unassignedAttributes */
/** @var Renderer $profileFormRenderer */
/** @var array|null $attributeSets */
/** @var UserInfo $profile */
/** @var PageView $view */

$app = Application::getFacadeApplication();
/** @var Token $token */
$token = $app->make(Token::class);
/** @var Repository $config */
$config = $app->make(Repository::class);
/** @var Form $form */
$form = $app->make(Form::class);

?>

<div class="container">
    <div class="row">
        <div class="col">
            <form method="post" action="<?php /** @noinspection PhpUndefinedMethodInspection */
            echo $view->action('save'); ?>" enctype="multipart/form-data">
                <?php $token->output('profile_edit'); ?>

                <fieldset>
                    <legend>
                        <?php echo t('Basic Information'); ?>
                    </legend>

                    <div class="form-group">
                        <?php echo $form->label('uEmail', t('Email')); ?>
                        <?php echo $form->text('uEmail', $profile->getUserEmail()); ?>
                    </div>
                </fieldset>

                <?php foreach ($attributeSets as $setName => $attributeKeys) { ?>
                    <?php /** @var UserKey $attributeKeys */ ?>
                    <fieldset>
                        <legend>
                            <?php echo $setName; ?>
                        </legend>

                        <?php foreach ($attributeKeys as $attributeKey) { ?>
                            <?php /** @noinspection PhpUndefinedMethodInspection */
                            $profileFormRenderer->buildView($attributeKey)->setIsRequired($attributeKey->isAttributeKeyRequiredOnProfile())->render(); ?>
                        <?php } ?>
                    </fieldset>
                <?php } ?>

                <?php if (!empty($unassignedAttributes)) { ?>
                    <fieldset>
                        <legend>
                            <?php echo t('Other'); ?>
                        </legend>

                        <?php foreach ($unassignedAttributes as $attributeKey) { ?>
                            <?php /** @noinspection PhpUndefinedMethodInspection */
                            $profileFormRenderer->buildView($attributeKey)->setIsRequired($attributeKey->isAttributeKeyRequiredOnProfile())->render(); ?>
                        <?php } ?>
                    </fieldset>
                <?php } ?>

                <div class="float-right">
                    <button type="submit" class="btn btn-primary">
                        <?php echo t("Save"); ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>