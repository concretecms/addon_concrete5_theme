<?php
defined('C5_EXECUTE') or die("Access Denied.");
use Concrete\Package\Concrete5Docs\Page\PageInspector;
use Concrete\Core\Support\Facade\Application;
use Concrete\Core\Utility\Service\Text;
use Concrete\Core\Page\Page;

$app = Application::getFacadeApplication();

if ($results) {

    foreach ($results as $result) {
        /** @var Page $result */
        $username = t('Unknown');
        $ui = UserInfo::getByID($result->getCollectionUserID());
        if (is_object($ui)) {
            $username = $ui->getUserDisplayName();
        }
        $inspector = new PageInspector($result);

        $collectionDate = $result->getCollectionDatePublic();
        if ($collectionDate) {
            $date = strtotime($collectionDate);
            $publishDate = date('m/d/Y', $date);
        }

        /** @var Text $th */
        $th = $app->make('helper/text');
        ?>

        <div class="ccm-margin-bottom-20">
            <a href="<?=$result->getCollectionLink()?>" style="margin-right: 10px; font-weight: bold; text-decoration: none;">
                <?= $result->getCollectionName() ?>
            </a>
            <div>
                <?= t('Publish on ') . $publishDate ?>
                <span class="tutorial-list-item-byline"><?= t('By ') ?><a href="#"><?= $username ?>.</a></span>
            </div>
            <div>
                <p><?= $th->shorten($result->getCollectionDescription(), 100) ?></p>
            </div>
            <a href="<?=$result->getCollectionLink()?>">
                <?= t('Read Tutorial') ?>
            </a>
        </div>

        <?php
    }
}
?>
