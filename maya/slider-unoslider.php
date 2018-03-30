<?php 
/**
 * @package WordPress
 * @subpackage Impero
 * @since 1.0
*/
?>

    <!-- START SLIDER -->
    <!--<div class="slider-wrapper theme-default">
        <div class="ribbon"></div>--> 
        <div id="slider" class="inner mobile <?php echo yit_slider_mobile_hide_class()?>">
            <ul class="unoslider">
                <?php while( yiw_have_slide() ) : ?>           
                    <li><?php if ( yiw_slide_get('slide_title') != '' ) : ?><div class='unoslider_caption'><?php yiw_slide_the('slide_title') ?></div><?php endif;
                        yiw_slide_the( 'featured-content', array( 'container' => false ) ); ?></li>
                <?php endwhile; ?>
            </ul>                    
        </div>
    <!--</div>-->