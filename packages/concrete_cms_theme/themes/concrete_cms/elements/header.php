<?php

/**
 * @project:   ConcreteCMS Theme
 *
 * @copyright  (C) 2021 Portland Labs (https://www.portlandlabs.com)
 * @author     Fabian Bitter (fabian@bitter.de)
 */

defined('C5_EXECUTE') or die("Access Denied.");

use Concrete\Core\Area\GlobalArea;
use Concrete\Core\Localization\Localization;
use Concrete\Core\View\View;

/** @var View $view */

?>
<!DOCTYPE html>
<html lang="<?php echo Localization::activeLanguage() ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--suppress HtmlUnknownTarget -->
    <link rel="stylesheet" type="text/css" href="<?php echo $view->getThemePath() ?>/css/main.css"/>
    <?php
    /** @noinspection PhpUnhandledExceptionInspection */
    View::element('header_required', [
        'pageTitle' => isset($pageTitle) ? $pageTitle : '',
        'pageDescription' => isset($pageDescription) ? $pageDescription : '',
        'pageMetaKeywords' => isset($pageMetaKeywords) ? $pageMetaKeywords : ''
    ]);
    ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="<?php echo $c->getPageWrapperClass() ?>">
    <header>
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="navbar-brand">
                    <div class="header-site-title">
                        <?php
                        $a = new GlobalArea('Header Site Title');
                        $a->display($c);
                        ?>
                    </div>
                </div>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="header-navigation">
                        <?php
                        $a = new GlobalArea('Header Navigation');
                        $a->display($c);
                        ?>
                    </div>
                </div>
            </nav>
        </div>
    </header>