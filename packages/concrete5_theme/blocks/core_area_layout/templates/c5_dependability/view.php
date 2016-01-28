<?php defined('C5_EXECUTE') or die("Access Denied.") ?>

<div class="c5-dependability">
    <div class="c5-layout-container">
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
