<?php global $jaw_data; ?>
<?php $id = rand(0, 1000); ?>
<?php
if (jaw_template_get_var('animate', 'no-animate') == 'animate') {
    ?>
    <script>
        jQuery(document).ready(function(){            
            jQuery('#icon-<?php echo $id; ?>').jawScroolAnimation({animation:"<?php echo jaw_template_get_var('animate_style', 'slide'); ?>", 
                animationSpeed: <?php echo jaw_template_get_var('animate_duration', '800'); ?>,
                animationDirection:"<?php echo jaw_template_get_var('animate_direction', 'left'); ?>",
                animationEasing:"<?php echo jaw_template_get_var('animate_easing', 'swing'); ?>"});    
        });
    </script>
<?php } ?>
<span id="icon-<?php echo $id; ?>" class="<?php echo jaw_template_get_var('animate', 'no-animate'); ?> in-el-icon">
    <span  class="<?php echo jaw_template_get_var('icon'); ?> icon"  style=" font-size: <?php echo jaw_template_get_var('size'); ?>px; color:<?php echo jaw_template_get_var('color'); ?>"></span>
    <span class="icon_text">  
        <?php echo do_shortcode(jaw_template_get_var('custom_text')); ?>
    </span>
</span>