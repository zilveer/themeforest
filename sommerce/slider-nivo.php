<?php 
/**
 * @package WordPress
 * @subpackage Sommerce
 * @since 1.0
 */
 
if ( yiw_is_empty() )
    return;
?>
 

    <!-- START SLIDER -->
    <div class="slider-wrapper theme-default inner">
        <div class="ribbon"></div>
        <div id="slider" class="nivoSlider">
            <div class="sliderWrapper">
                <?php 
                while( yiw_have_slide() ) :
            
                yiw_slide_the( 'featured-content', array(
                     'container' => false,
                     'video_width' => 439,
                     'video_height' => 245
                ) ); 
                
                endwhile; ?>
            </div>
        </div>
    </div>
