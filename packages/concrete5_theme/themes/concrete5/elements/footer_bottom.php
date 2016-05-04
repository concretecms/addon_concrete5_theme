<?php defined('C5_EXECUTE') or die("Access Denied."); ?>

</div>

<?php Loader::element('footer_required'); ?>
<script>
    var $buoop = {vs:{i:10,f:25,o:12.1,s:7},c:2};
    function $buo_f(){
        var e = document.createElement("script");
        e.src = "//browser-update.org/update.min.js";
        document.body.appendChild(e);
    };
    try {document.addEventListener("DOMContentLoaded", $buo_f,false)}
    catch(e){window.attachEvent("onload", $buo_f)}
</script>

<script>
    $(function() {
        var load = [
            '/packages/concrete5_theme/themes/concrete5/images/icon-header.svg',
            '/packages/concrete5_theme/themes/concrete5/images/icon-header-hover.svg'
        ], image = new Image();
        for (var key in load) {
            image.src = load[key];
        }
    });
</script>
<script src="https://www.concrete5.org/application/js/wcbit.js" async defer/>
</body>
</html>
