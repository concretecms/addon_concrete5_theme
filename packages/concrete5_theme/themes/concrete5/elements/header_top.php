<?php defined('C5_EXECUTE') or die("Access Denied."); ?>
<!DOCTYPE html>
<html lang="<?=Localization::activeLanguage()?>">
<head>
    <?php
    $gtm = getenv('GTM_ID');
    if ($gtm) {
        ?>
        <!-- Google Tag Manager -->
        <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','<?= $gtm ?>');</script>
        <!-- End Google Tag Manager -->
        <?php
    }
    ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" type="text/css" href="<?=$view->getThemePath()?>/css/main.css">
    <?php Loader::element('header_required', array('pageTitle' => $pageTitle));?>
    <link rel="stylesheet" type="text/css" href="<?=$view->getThemePath()?>/css/bootstrap.min.css">
    <script type="text/javascript" src="<?=$view->getThemePath()?>/js/bootstrap.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        if (navigator.userAgent.match(/IEMobile\/10\.0/)) {
            var msViewportStyle = document.createElement('style')
            msViewportStyle.appendChild(
                document.createTextNode(
                    '@-ms-viewport{width:auto!important}'
                )
            )
            document.querySelector('head').appendChild(msViewportStyle)
        }
    </script>

    <?php
    $tags = \Core::make(\PortlandLabs\Theme\Seo\MetaTags::class, [$c]);
    $tags->outputTags();
    ?>


</head>
<body>
<?php
if ($gtm) {
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?= $gtm ?>"
                      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
?>

<div class="<?=$c->getPageWrapperClass()?>">
