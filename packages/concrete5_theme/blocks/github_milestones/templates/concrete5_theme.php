<?php
use Michelf\MarkdownExtra;

defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php if (count($milestones)) {

    for ($i = 0; $i < count($milestones); $i++) {
        $milestone = $milestones[$i];
        $progress = $milestone->getProgress();
        ?>

        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <h1 class="" style="margin-top: 0px"><?=$milestone->getTitle()?></h1>
                    </div>
                    <div class="col-sm-8">
                        <h4><?=t('Description')?></h4>
                        <?=MarkdownExtra::defaultTransform($milestone->getDescription());?>

                        <div class="clearfix" style="height:20px"></div>

                        <h4><?=t('Status')?></h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress?>%;">
                                <span class="sr-only"><?=$progress?>% <?=t('Complete')?></span>
                            </div>
                        </div>
                        <a href="<?=$milestone->getPublicURL()?>" class="btn btn-get-started-light"><?=t('View Open Issues')?></a>

                    </div>
                </div>
            </div>
        </div>
        <?php if (($i + 1) < count($milestones)) { ?>
            <div class="clearfix" style="height:50px"></div>
            <hr/>
            <div class="clearfix" style="height:50px"></div>
        <?php } ?>


    <?php } ?>

<?php } else { ?>

    <p><?=t('There are no open milestones.')?></p>

<?php } ?>


