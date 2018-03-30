<?php 
/**
 * @package WordPress
 * @subpackage Sheeva
 * @since 1.0
 */
 
$slider = yiw_get_option( 'slider_layers_choose', 1 );
 ?>
 
<!-- START SLIDER -->
<div id="slider" class="layers-slider <?php echo yit_slider_mobile_hide_class()?>">
    <div class="shadowWrapper">
        <?php echo do_shortcode('[layerslider id="'.$slider.'"]'); ?>
        <div class="shadow-left"></div>
        <div class="shadow-right"></div>
    </div>
</div>
<!-- END SLIDER -->