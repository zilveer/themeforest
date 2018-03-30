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
<div id="slider" class="thumbnails group inner">
    <div class="showcase group">  
    <?php while( yiw_have_slide() ) :  

            list( $thumbnail, $thumb_width, $thumb_height ) = yit_image( "src=" . yiw_slide_get('image_url') . "&size=thumbnail&output=array" );
            ?>

            <div class="showcase-slide">
                <div class="showcase-content">
                        <!-- If the slide contains multiple elements you should wrap them in a div with the class
                        .showcase-content-wrapper. We usually wrap even if there is only one element,
                        because it looks better. -->
                        <div class="showcase-content-wrapper">
                            <?php yiw_slide_the( 'featured-content', array( 'container' => false ) ) ?>
                        </div>
                    </div>
                    <!-- Put the caption content in a div with the class .showcase-caption -->
                    <?php yiw_string_( '<div class="showcase-caption"><p class="">', yiw_slide_get( 'clean-content' ), '</p></div>' ) ?>

                    <div class="showcase-thumbnail">
                        <img src="<?php echo $thumbnail ?>" />
                    </div>

                    <!-- Put the tooltips in a div with the class .showcase-tooltips. -->
                    <?php if ( yiw_slide_get('extra_tooltip_x_pos') != '' && yiw_slide_get('extra_tooltip_y_pos') != '' && yiw_slide_get('extra_tooltip_content') != '' ) ?>
            <div class="showcase-tooltips">
                <!-- Each anchor in .showcase-tooltips represents a tooltip.
                The coords attribute represents the position of the tooltip. -->
                <a href="<?php yiw_slide_the('extra_tooltip_url') ?>" coords="<?php yiw_slide_the('extra_tooltip_x_pos') ?>,<?php yiw_slide_the('extra_tooltip_y_pos') ?>">
                    <?php if ( yiw_slide_get('extra_tooltip_image') != '' ) : ?>
                    <img src="<?php yiw_slide_the('extra_tooltip_image') ?>" />
                    <?php endif; ?>
                    <!-- The content of the anchor-tag is displayed in the tooltip. -->
                    <?php yiw_slide_the('extra_tooltip_content') ?>
                </a>
            </div>
        </div>

    <?php endwhile; ?>
    </div>
</div> 
<!-- END SLIDER --> 