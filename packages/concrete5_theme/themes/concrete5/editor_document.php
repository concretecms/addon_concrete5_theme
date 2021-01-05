<?php
defined('C5_EXECUTE') or die("Access Denied.");
$this->inc('elements/header.php'); ?>

<main>

    <?php
    $a = new Area('Page Header');
    $a->enableGridContainer();
    $a->display($c);
    ?>
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-content">
                <?php
                $a = new Area('Main');
                $a->setAreaGridMaximumColumns(12);
                $a->display($c);
                ?>
            </div>
            <div class="col-sm-4 col-sidebar">
                <?php
                $a = new Area('Sidebar');
                $a->display($c);

                $stack = Stack::getByName('Thumbs');
                if ($stack) {
                    $stack->display();
                }

                ?>
                <div class="well text-muted">
                    <p style="text-align: center">
                        <?=t('Could this page use improvement? Edit it!')?><br/><br/>
                        <a class="btn btn-primary btn-lg" href="<?=URL::to('/contribute/', 'edit', $c->getCollectionID())?>"><i class="fa fa-pencil"></i> <?=t('Edit Page')?></a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <?php
    $a = new Area('Page Footer');
    $a->enableGridContainer();
    $a->display($c);
    ?>

</main>

<?php  $this->inc('elements/footer.php'); ?>
