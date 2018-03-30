<?php
$id = rand(0, 9999);
if (jaw_template_get_var('animate', '0') == '1') {
    $width = 0;
    ?>
    <script>
        jQuery(document).ready(function() {
            var checkStartAnimation = function() {
                var bottom_of_window = jQuery(window).scrollTop() + jQuery(window).height();
                var bottom_of_object = jQuery('#progress-<?php echo $id; ?> .progress-bar').offset().top;
                if (bottom_of_window > bottom_of_object) {
                    return true;
                }
                ;
                return false;
            };

            var jawAnimationHandler = function() {
                if (checkStartAnimation()) {
                    jQuery('#progress-<?php echo $id; ?> .progress-bar').css('width', '<?php echo jaw_template_get_var('value'); ?>%');
                }
            };
            jawAnimationHandler();
            jQuery(window).scroll(jawAnimationHandler);


        });
    </script>
    <?php
} else {
    $width = jaw_template_get_var('value');
}
?>
<div id="progress-<?php echo $id; ?>" class="progress">   
    <div class="progress-bar" role="progressbar" aria-valuenow="<?php echo jaw_template_get_var('value'); ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $width; ?>%; background:<?php echo jaw_template_get_var('color'); ?>">
        <span><?php echo jaw_template_get_var('title'); ?> </span><span class="progress-percents">(<?php echo jaw_template_get_var('value'); ?>%)</span>
    </div>
</div>

