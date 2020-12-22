<?php

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

defined('C5_EXECUTE') or die("Access Denied."); ?>

<div class="offset-sm-4">
<div class="checkbox">
    <label>
        <input
                type="checkbox"
                value="1"
                name="<?php echo $view->field('value') ?>"
            <?php if ($checked) { ?> checked <?php } ?>
        >
        <?php echo $controller->getCheckboxLabel() ?>
    </label>
</div>
</div>