<?php
defined('C5_EXECUTE') or die("Access Denied.");
$view->inc('elements/header.php'); ?>

<main>
    <br/>
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <?php Loader::element('system_errors', array('format' => 'block', 'error' => $error, 'success' => $success, 'message' => $message)); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-9">
                <?php print $innerContent; ?>
            </div>
            <div class="col-sm-3">
                <?php
                Element::get('account/menu', 'concrete5_community')->render();
                ?>
            </div>
        </div>
    </div>
</main>

<?php $view->inc('elements/footer.php'); ?>
