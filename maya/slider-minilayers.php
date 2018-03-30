<?php 
/**
 * @package WordPress
 * @subpackage Maya Shop
 * @since 1.0
 */
 
$slider = yiw_get_option( 'slider_minilayers_choose', 1 );
 ?>
 
<!-- START SLIDER -->
<div id="slider" class="minilayers-slider group inner mobile <?php echo yit_slider_mobile_hide_class()?>">
    <div class="slider-images">
        <?php echo do_shortcode('[layerslider id="'.$slider.'"]'); ?>
    </div>
    <div class="slider-minilayers-static">
        <h3>
        <?php
        $static_title = stripslashes( yiw_slide_get( 'static_title' ) );
        $static_title = str_replace(
            array( '[', ']'),
            array( '<span>', '</span>' ),
            $static_title
        );
        
        echo $static_title;
        ?>
        </h3>
        <p><?php echo stripslashes( yiw_slide_get( 'static_text' ) ) ?></p>
        <?php
        $short_text = yiw_slide_get( 'static_short_text' );
        $short_text = str_replace( array( '[', ']' ), array( '<strong>', '</strong>' ), $short_text );
        
        
        if( !empty( $short_text ) ) {
            echo '<p class="short-text">', stripslashes( $short_text ), '</p>';
        }
        ?>
    </div>
</div>
<!-- END SLIDER -->