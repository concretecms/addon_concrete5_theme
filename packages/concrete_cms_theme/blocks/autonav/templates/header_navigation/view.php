<?php

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Block\Autonav\Controller;

/** @var Controller $controller */

$navItems = $controller->getNavItems();

foreach ($navItems as $ni) {
    $classes = [];

    $classes[] = 'nav-item';

    if ($ni->isCurrent || $ni->inPath) {
        $classes[] = 'active';
    }

    if ($ni->hasSubmenu) {
        //class for items that have dropdown sub-menus
        $classes[] = 'dropdown';
    }

    //Put all classes together into one space-separated string
    $ni->classes = implode(" ", $classes);
}


//*** Step 2 of 2: Output menu HTML ***/

echo '<ul class="nav navbar-nav navbar-right' . '' . '">'; //opens the top-level menu

foreach ($navItems as $ni) {
    $dataToggle = '';
    $dropdownClass = '';
    $dropdownCarrot = '';
    if ($ni->hasSubmenu) {
        $dataToggle = ' data-toggle="dropdown"';
        $dropdownClass = ' dropdown-toggle';
        $dropdownCarrot = ' <span class="caret"></span>';
    }

    echo '<li class="' . $ni->classes . '">'; //opens a nav item

    echo '<a href="' . $ni->url . '" target="' . $ni->target . '" class="nav-link ' . $dropdownClass . '"' . $dataToggle . '>' . $ni->name . $dropdownCarrot . '</a>';

    if ($ni->hasSubmenu) {
        echo '<ul class="dropdown-menu">'; //opens a dropdown sub-menu
    } else {
        echo '</li>'; //closes a nav item
        echo str_repeat('</ul></li>', $ni->subDepth); //closes dropdown sub-menu(s) and their top-level nav item(s)
    }
}

echo '</ul>'; //closes the top-level menu