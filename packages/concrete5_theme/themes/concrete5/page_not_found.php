<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<main>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">

                <?php $a = new Area('Main'); ?>
                <?php $a->display($c); ?>

                <a href="<?=DIR_REL?>/"><?=t('Back to Home')?></a>.

            </div>
        </div>
    </div>
</main>

<?php  $this->inc('elements/footer.php'); ?>
