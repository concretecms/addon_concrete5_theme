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

        <div class="wcbit-content wcbit-well wcbit-well-blue">
            <?php
            $a = new Area('Main');
            $a->display($c);
            ?>
        </div>
    </div>
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
        #wcbit .wcbit-btn {
            display: inline-block;
            margin: 5px 5px 0 0;
            padding: 10px 15px;
            border: solid 1px #2671a3;
            border-radius: 3px;
            font-size: 14px;
            min-width: 75px;
            text-align:center;
        }

        #wcbit .wcbit-btn-blue {
            background-color: #1a7bbb;
            border-color: transparent;
            color: white;
        }
        #wcbit .wcbit-btn-gray {
            background-color: #5b5e5f;
            border-color: transparent;
            color: white;
        }
        #wcbit .wcbit-btn-gray:hover, #wcbit .wcbit-btn-blue:hover {
            color: #
        }
    </style>

<?php
if ($loggedIn) {
    \Concrete\Core\View\View::element('footer_required');
    ?>
    <html>
    <?php
}
