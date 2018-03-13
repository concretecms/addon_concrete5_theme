<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php if (count($milestones)) {

    for ($i = 0; $i < count($milestones); $i++) {
        $milestone = $milestones[$i];
        $progress = $milestone->getProgress();
        ?>

        <div class="container">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-4">
                        <h2 class="c5-feature-section"><?=$milestone->getTitle()?></h2>
                    </div>
                    <div class="col-sm-4">
                        <h4><?=t('Description')?></h4>
                        <?=$milestone->getDescription()?>
                    </div>
                    <div class="col-sm-4">
                        <h4><?=t('Status')?></h4>
                        <div class="progress">
                            <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress?>%;">
                                <span class="sr-only"><?=$progress?>% <?=t('Complete')?></span>
                            </div>
                        </div>
                        <a href="<?=$milestone->getPublicURL()?>" class="btn btn-default"><?=t('View Open Issues')?></a>

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


