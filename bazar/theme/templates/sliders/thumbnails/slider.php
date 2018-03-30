<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */    
 
global $is_primary;     

$thumbs = ''; 
$slider_type = yit_slide_get( 'slider_type' );

$slider_class = 'group';         
if ( ! $is_primary ) $slider_class = 'container';
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';

$background = ( yit_slide_get( 'header-background' ) != '' ) ? 'style="background-color: ' . yit_slide_get( 'header-background' ) . ';"' : '' ;

if ( ! has_action( 'yit_after_header', 'yit_slider_space' ) ) add_action( 'yit_after_header', create_function( '', "echo \"<div style='height:130px;'></div> \";" ) );
?>
<div class="thumb_wrapper <?php if ($background != '') echo 'back-color' ?>" <?php echo $background ?>> 
<!-- START SLIDER -->
<div id="<?php echo $slider_id ?>"<?php yit_slider_class($slider_class) ?>>
    <div class="showcase group">  
    <?php while( yit_have_slide() ) :  

        list( $thumbnail, $thumb_width, $thumb_height ) = yit_image( "id=" . yit_slide_get('item_id') . "&size=thumb-slider-thumbnails&output=array" );
    ?>

    <div class="showcase-slide">
        <div class="showcase-content">
            <!-- If the slide contains multiple elements you should wrap them in a div with the class
            .showcase-content-wrapper. We usually wrap even if there is only one element,
            because it looks better. -->
            <div class="showcase-content-wrapper">
            	<div class="showcase-content-slides">
                	<?php yit_slide_the( 'featured-content', array( 'container' => false ) ) ?>
                </div>
            </div>
        </div>
        <!-- Put the caption content in a div with the class .showcase-caption -->
        <?php if ( yit_slide_get('caption') ) : ?><div class="showcase-caption"><p class=""><?php yit_slide_the('caption'); ?></p></div><?php endif; ?>

        <div class="showcase-thumbnail">
            <img src="<?php echo $thumbnail ?>" width="<?php echo $thumb_width ?>" height="<?php echo $thumb_height ?>" />
        </div>

        <!-- Put the tooltips in a div with the class .showcase-tooltips. -->
        <?php if ( yit_slide_get('tooltip_x') != '' && yit_slide_get('tooltip_y') != '' && yit_slide_get('tooltip_text') != '' ) : ?>
        <div class="showcase-tooltips">
            <!-- Each anchor in .showcase-tooltips represents a tooltip.
            The coords attribute represents the position of the tooltip. -->
            <a href="<?php echo esc_url( yit_slide_get('tooltip_url') ) ?>" coords="<?php yit_slide_the('tooltip_x') ?>,<?php yit_slide_the('tooltip_y') ?>">
                <?php if ( yit_slide_get('tooltip_image') != '' ) : ?>
                <img src="<?php yit_slide_the('tooltip_image') ?>" />
                <?php endif; ?>
                <!-- The content of the anchor-tag is displayed in the tooltip. -->
                <?php yit_slide_the('tooltip_text') ?>
            </a>
        </div>
        <?php endif; ?>
    </div>

    <?php endwhile; ?>
    </div>
</div> 
<!-- END SLIDER --> 
</div>        
    <script type="text/javascript">
        jQuery(document).ready(function($){
        	$('#<?php echo $slider_id ?>.thumbnails img.attachment-full').css('width', '<?php yit_slide_the( 'width' ); ?>px').css('height', '<?php yit_slide_the( 'height_' . $slider_type ); ?>px');
            var resize_height_thumbnail = function(){
                if ( ! $('body').hasClass('responsive') ) {
                    return;
                }
                
                $('.showcase-content-container, .showcase-content').height( $('.showcase-content-wrapper').outerHeight() + 1 );
                $('#<?php echo $slider_id ?>.thumbnails .showcase-content-wrapper img').css({ 
                    width : $('#<?php echo $slider_id ?>.slider.thumbnails .showcase-content').width() - 22
                });
                var arrow_width = parseInt( $('#<?php echo $slider_id ?> .showcase-thumbnail-restriction').css('margin-left').replace( 'px', '' ) );
                var thumbnails_container_width = $('#<?php echo $slider_id ?> .showcase-thumbnail-container').width();
                $('#<?php echo $slider_id ?> .showcase-thumbnail-restriction').width( thumbnails_container_width - arrow_width*2 );
            };
            $(window).resize(resize_height_thumbnail);
            
            var content_width  = <?php yit_slide_the('width') ?> + 22;
            var content_height = <?php yit_slide_the('height') ?> + 22;
            
            if ( content_width > $('.slider.thumbnails .showcase').width() ) {
                content_width = $('.slider.thumbnails .showcase').width();
            }
            
			$("#<?php echo $slider_id ?> .showcase").awShowcase({
    	        content_width           : content_width,
    	        content_height          : content_height,		
    			show_caption            : '<?php yit_slide_the('show_caption') ?>', /* onload/onhover/show */    
				continuous              : true,
	    		buttons                 : false,
	    		auto                    : true,
	    		thumbnails              : true,        
	    		transition              : '<?php yit_slide_the('effect') ?>', /* hslide / vslide / fade */
	    		interval                : <?php echo yit_slide_get('interval') * 1000 ?>,
	    		transition_speed        : <?php echo yit_slide_get('speed') * 1000 ?>,
	    		thumbnails_position     : 'outside-last', /* outside-last/outside-first/inside-last/inside-first */
	    		thumbnails_direction    : 'horizontal', /* vertical/horizontal */
	    		thumbnails_slidex       : 1, /* 0 = auto / 1 = slide one thumbnail / 2 = slide two thumbnails / etc. */
	    		onload                  : function(){
                    $( window ).load(function(){
                        resize_height_thumbnail();
                    });
                },
                onchange         : resize_height_thumbnail
    	    }); 
        }); 
   </script>