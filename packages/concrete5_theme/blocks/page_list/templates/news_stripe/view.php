<?php
use Concrete\Core\File\File;

defined('C5_EXECUTE') or die("Access Denied.");
$th = Loader::helper('text');
$c = Page::getCurrentPage();
$dh = Core::make('helper/date'); /* @var $dh \Concrete\Core\Localization\Service\Date */
?>

<?php if ( $c->isEditMode() && $controller->isBlockEmpty()) { ?>
    <div class="ccm-edit-mode-disabled-item"><?=t('Empty Page List Block.')?></div>
<?php } else { ?>

    <div class="row c5-news-stripe">

        <?php
        /** @var \Concrete\Core\Page\Page $page */
        foreach ($pages as $page) {

            $limit--;
            /** @var \Concrete\Core\User\UserInfo $author */
            $author = \Concrete\Core\User\UserInfo::getByID($page->getCollectionUserID());
            $title = $th->entities($page->getCollectionName());
            $description = $page->getCollectionDescription();
            $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
            $description = $th->entities($description);
            /** @var File $thumbnail */
            $thumbnail = $page->getAttribute('thumbnail');

            /** @var \DateTime $date */
            $date = $page->getCollectionDatePublicObject();
            $date_string = $date->format('M d, Y');
            $parent = Page::getByID($page->getCollectionParentID());
            ?>

            <div class="col-md-4 col-md-offset-0">
                <a class="c5-news" href="<?= \URL::to($page) ?>">
                    <div class="header">
                        <h2 class="title"><?= h($title) ?></h2>
                        <span class="info">
                            Posted by <author><?= h($author ? $author->getUserDisplayName() : 'unknown') ?></author>
                            in <strong class="category"><?=$parent->getCollectionName()?></strong>
                            on <strong class="date"><?= $date_string ?></strong>
                        </span>
                    </div>
                    <p class="description"><?= $description ?></p>
                </a>
            </div>

        <?php } ?>

    </div><!-- end .ccm-block-page-list -->

<?php } ?>
