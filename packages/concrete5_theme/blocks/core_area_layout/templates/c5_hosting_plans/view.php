<?php defined('C5_EXECUTE') or die("Access Denied.") ?>

<div class="c5-plans c5-hosting-plans">
    <div class="c5-layout-container container-fluid">
        <?php
        $a = $b->getBlockAreaObject();

        $container = $formatter->getLayoutContainerHtmlObject();
        foreach($columns as $column) {
            $html = $column->getColumnHtmlObject();
            $container->appendChild($html);
        }
        print $container;
        ?>
    </div>
</div>
