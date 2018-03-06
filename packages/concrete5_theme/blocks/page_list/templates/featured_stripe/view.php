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

    <div class="row c5-featured-stripe">

        <?php
        $limit = 3;

        foreach ($pages as $page) {
            if (!$limit--) break;

            $title = $th->entities($page->getCollectionName());
            $description = $page->getCollectionDescription();
            $description = $controller->truncateSummaries ? $th->wordSafeShortText($description, $controller->truncateChars) : $description;
            $description = $th->entities($description);
            /** @var File $thumbnail */
            $thumbnail = $page->getAttribute('thumbnail');
            ?>

            <div class="col-sm-4">
                <a class="c5-featured-page" href="<?= \URL::to($page) ?>">
                    <div class="image">
                        <div class="image-inner">
                        <?php
                        if ($thumbnail) {
                            $img = Core::make('html/image', array($thumbnail));
                            echo $img->getTag();
                        } else {
                            echo "<img />";
                        }
                        ?>
                        </div>
                    </div>
                    <div class="details">
                        <span class="title"><?= $title ?></span>
                        <p class="description"><?= $description ?></p>
                    </div>
                </a>
            </div>

        <?php } ?>

    </div><!-- end .ccm-block-page-list -->

<?php } ?>
