<?php
defined('C5_EXECUTE') or die("Access Denied.");

$u = new \Concrete\Core\User\User();
$loggedIn = $u->isLoggedIn();

if ($loggedIn) {
    ?>
    <html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <?php
        \Concrete\Core\View\View::element('header_required');
        ?>
        <link rel="stylesheet" type="text/css" href="<?=$view->getThemePath()?>/css/bootstrap.min.css">
        <script type="text/javascript" src="<?=$view->getThemePath()?>/js/bootstrap.min.js"></script>

    </head>
    <?php
}
?>

<div id="wcbit" <?= $loggedIn ? "style='padding-top:50px'" : '' ?>>
    <div>

        <div class="wcbit-close">
            <i class="fa fa-times"></i>
        </div>

        <div class="wcbit-header">
            <?php
            $a = new GlobalArea('WCBIT Header');
            $a->display($c);
            ?>
        </div>

        <div class='wcbit-content-container'>
            <?php

            $a = new Area('WCBIT Subheader');
            $a->display($c);
            ?>

            <div class="wcbit-content wcbit-well wcbit-well-blue">
                <?php
                $a = new Area('Main');
                $a->display($c);
                ?>
            </div>
        </div>
    </div>

    <div class="wcbit-alert-dialog container">
        <div class="wcbit-alert-icon">
            <img src="<?= $view->getThemePath()?>/images/icon-group-white.svg" />
        </div>
        <div class="wcbit-cta">
            <span class="wcbit-wcbit">
                We Can Build It Together
            </span>
            <span>
                A community of thousands and the company behind concrete5 are eager to help!
            </span>
        </div>
        <div class="wcbit-alert-buttons">
            <a href="#" class='wcbit-toggle btn wcbit-btn wcbit-btn-blue'>
                Learn More <i class='fa fa-angle-right'></i>
            </a>
            <a href="#" class='wcbit-alert-close btn wcbit-btn wcbit-btn-gray'>
                Dismiss
            </a>
        </div>

        <style>
            #wcbit-container {
                position:absolute;
                overflow:hidden;
                top:0;
                right:0;
                left:0;
                bottom:0;
            }
            #wcbit {
                position:absolute;
                top:0;
                bottom:0;
                right:0;
                width: 370px;
                border-left: solid 1px #09f;
                box-shadow: 0px 0px 10px rgba(0,0,0,.3);
                font-size: 14px;
                z-index: 100;
                background-color: white;
            }
            #wcbit > div {
                padding: 30px 30px;
                text-align: center;
            }
            #wcbit img {
                display: inline-block;
            }
            #wcbit .wcbit-well {
                padding: 20px 30px;
                border-radius: 5px;
                background-color: #f6f6f6;
                margin-bottom: 20px;
            }
            #wcbit .wcbit-well-blue {
                background-color: #f0f8fc;
            }
            #wcbit .wcbit-close {
                position:absolute;
                top: 0;
                right: 0;
                padding: 10px;
            }
            #wcbit .wcbit-nav {
                color: #adcae6;
                font-size: 14px;
                margin-bottom: 20px;
            }
            #wcbit .wcbit-content {
                text-align: left;
                color: #0099ff;
                font-size: 16px;
            }
            #wcbit .wcbit-btn, .wcbit-alert-dialog .wcbit-btn {
                display: inline-block;
                margin: 5px 5px 0 0;
                padding: 10px 15px;
                border: solid 1px #2671a3;
                border-radius: 3px;
                font-size: 14px;
                min-width: 75px;
                text-align:center;
            }

            #wcbit .wcbit-btn-blue, .wcbit-alert-dialog .wcbit-btn-blue {
                background-color: #1a7bbb;
                border-color: transparent;
                color: white;
            }
            #wcbit .wcbit-btn-gray, .wcbit-alert-dialog .wcbit-btn-gray {
                background-color: #5b5e5f;
                border-color: transparent;
                color: white;
            }
            #wcbit .wcbit-btn-gray:hover,
            #wcbit .wcbit-btn-blue:hover,
            .wcbit-alert-dialog .wcbit-btn-blue:hover,
            .wcbit-alert-dialog .wcbit-btn-gray:hover {
                color: #fafafa;
            }

            #wcbit .wcbit-alert-dialog {
                display: none;
            }

            body > .wcbit-alert {
                background: #32383c;
                background: -webkit-linear-gradient(#262b2e, #3e464b);
                background: -o-linear-gradient(#262b2e, #3e464b);
                background: -moz-linear-gradient(#262b2e, #3e464b);
                background: linear-gradient(#262b2e, #3e464b);
                color: white;
            }
            body > .wcbit-alert > .wcbit-alert-dialog {
                margin: 0 auto;
                padding: 30px 0;
            }

            body > .wcbit-alert > .wcbit-alert-dialog > div {
                display: inline-block;
                float: left;
            }

            body > .wcbit-alert > .wcbit-alert-dialog > div.wcbit-alert-icon {
                margin-right: 10px;
            }

            body > .wcbit-alert > .wcbit-alert-dialog > div.wcbit-alert-buttons {
                float: right;
            }

            .wcbit-cta > span {
                display: block;
                color: #a1a1a1;
            }

            .wcbit-cta > .wcbit-wcbit {
                font-size: 20px;
                font-weight: 500;
                color: white;
                line-height: 25px;
            }

            .wcbit-alert-dialog .wcbit-btn {
                padding: 11px 20px !important;
            }

            .wcbit-close {
                cursor: pointer;
            }
        </style>
    </div>
</div>


<?php
if ($loggedIn) {
    \Concrete\Core\View\View::element('footer_required');
    ?>
    <html>
    <?php
}
