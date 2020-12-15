<?php

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Block\Autonav\Controller;
use Concrete\Core\Page\Page;

/** @var Controller $controller */

$navItems = $controller->getNavItems();
$c = Page::getCurrentPage();

foreach ($navItems as $ni) {
    $classes = array();

    if ($ni->isCurrent) {
        $classes[] = 'nav-selected';
    }

    if ($ni->inPath) {
        $classes[] = 'nav-path-selected';
    }

    $ni->classes = implode(" ", $classes);
}

if (count($navItems) > 0) {
    echo '<ul class="list-unstyled">'; //opens the top-level menu

    foreach ($navItems as $ni) {
        echo '<li class="' . $ni->classes . '">'; //opens a nav item
        echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="' . $ni->classes . '">' . h($ni->name) . '</a>';

        if ($ni->hasSubmenu) {
            echo '<ul>'; //opens a dropdown sub-menu
        } else {
            echo '</li>'; //closes a nav item

            echo str_repeat('</ul></li>', $ni->subDepth); //closes dropdown sub-menu(s) and their top-level nav item(s)
        }
    }

    echo '</ul>'; //closes the top-level menu
} elseif (is_object($c) && $c->isEditMode()) {
    ?>
    <div class="ccm-edit-mode-disabled-item">
        <?php echo t('Empty Auto-Nav Block.') ?>
    </div>
<?php }
