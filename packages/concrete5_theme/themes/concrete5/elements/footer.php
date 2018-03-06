<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

<?php View::element('footer_navigation', array(), 'concrete5_theme')?>

<?php $view->inc('elements/footer_bottom.php');?>

<script>
    (function() {
        $('img.svg').each(function() {
            var me = $(this)
            $.get(me.attr('src'), function(data) {
                var svg = $(data);

                if (me.hasClass('scale-up')) {
                    svg.css({
                        transform: 'scale(1.5, 1.5)'
                    });
                }
                me.replaceWith(svg);
            }, 'text');
        })
    }());
</script>
