<? defined('C5_EXECUTE') or die("Access Denied."); ?>

<? $a = new Area('Main'); ?>
<? $a->display($c); ?>

<a href="<?=DIR_REL?>/"><?=t('Back to Home')?></a>.
