<?php

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Attribute\Category\UserCategory;
use Concrete\Core\Entity\File\File;
use Concrete\Core\Localization\Service\Date;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Support\Facade\Url;
use Concrete\Core\User\Group\Group;
use Concrete\Core\User\Point\Entry;
use Concrete\Core\User\UserInfo;
use Concrete\Core\View\View;

/** @var Group[] $badges */
/** @var View $view */
/** @var bool $canEdit */
/** @var UserInfo $profile */

$app = Application::getFacadeApplication();
/** @var  Date $dateHelper */
$dateHelper = $app->make(Date::class);
/** @var UserCategory $userCategory */
$userCategory = $app->make(UserCategory::class);

?>

<div class="container">
    <div class="row">
        <div class="col">
            <div id="ccm-profile-header">
                <div id="ccm-profile-avatar">
                    <?php echo $profile->getUserAvatar()->output(); ?>
                </div>

                <h1>
                    <?php echo $profile->getUserName() ?>
                </h1>

                <div id="ccm-profile-controls">
                    <?php if ($canEdit) { ?>
                        <div class="btn-group">
                            <a href="<?php echo (string)Url::to('/account/edit_profile') ?>"
                               class="btn btn-sm btn-default">
                                <i class="fa fa-cog"></i> <?php echo t('Edit') ?>
                            </a>
                            <a href="<?php echo (string)Url::to('/') ?>" class="btn btn-sm btn-default">
                                <i class="fa fa-home"></i> <?php echo t('Home') ?>
                            </a>
                        </div>
                    <?php } else { ?>
                        <?php if ($profile->getAttribute('profile_private_messages_enabled')) { ?>
                            <a href="<?php echo (string)Url::to('/account/messages', 'write', $profile->getUserID()) ?>"
                               class="btn btn-sm btn-default">
                                <i class="fa-user fa"></i> <?php echo t('Send Message') ?>
                            </a>
                        <?php } ?>
                    <?php } ?>
                </div>
            </div>

            <div id="ccm-profile-statistics-bar">
                <div class="ccm-profile-statistics-item">
                    <i class="icon-time"></i> <?php /** @noinspection PhpUnhandledExceptionInspection */
                    echo t(/*i18n: %s is a date */ 'Joined on %s', $dateHelper->formatDate($profile->getUserDateAdded(), true)) ?>
                </div>

                <div class="ccm-profile-statistics-item">
                    <i class="icon-fire"></i> <?php echo number_format(Entry::getTotal($profile)) ?> <?php echo t('Community Points') ?>
                </div>

                <div class="ccm-profile-statistics-item">
                    <i class="icon-bookmark"></i>

                    <?php echo number_format(count($badges)) ?><?php echo t2('Badge', 'Badges', count($badges)) ?>
                </div>

                <div class="clearfix"></div>
            </div>


            <div id="ccm-profile-wrapper">
                <div id="ccm-profile-detail">


                    <?php $uaks = $userCategory->getPublicProfileList(); ?>

                    <?php foreach ($uaks as $ua) { ?>
                        <div>
                            <h4>
                                <?php echo $ua->getAttributeKeyDisplayName() ?>
                            </h4>

                            <?php
                            $r = $profile->getAttribute($ua, 'displaySanitized');

                            if ($r) {
                                echo $r;
                            } else {
                                echo t('None');
                            }
                            ?>
                        </div>
                    <?php } ?>

                    <h4>
                        <?php echo t("Badges") ?>
                    </h4>

                    <?php if (count($badges) > 0) { ?>
                        <ul class="thumbnails">
                            <?php foreach ($badges as $ub) { ?>
                                <?php /** @var File $uf */
                                $uf = $ub->getGroupBadgeImageObject(); ?>

                                <?php if (is_object($uf)) { ?>
                                    <li class="span2">
                                        <div class="thumbnail ccm-profile-badge-image">
                                            <div>
                                                <img src="<?php echo $uf->getApprovedVersion()->getRelativePath() ?>"
                                                     alt="<?php echo h($ub->getGroupBadgeDescription()) ?>"/>
                                            </div>

                                            <div>
                                                <?php /** @noinspection PhpUnhandledExceptionInspection */
                                                echo t("Awarded %s", $dateHelper->formatDate($ub->getGroupDateTimeEntered($profile))) ?>
                                            </div>
                                        </div>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>

                    <?php } else { ?>
                        <p>
                            <?php echo t("This user hasn't won any badges.") ?>
                        </p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>