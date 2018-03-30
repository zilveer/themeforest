<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */             

global $is_primary;
 
$thumbs = ''; 
$slider_type = yit_slide_get( 'slider_type' ); 

$width  = yit_slide_get( 'width' );
$height = yit_slide_get( 'height' );

$width_inline  = ( empty( $width ) )  ? ( ( $is_primary ) ? "width:100%;" : '' ) : "width:{$width}px;";
$height_inline = ( empty( $height ) ) ? '' : "max-height:{$height}px;";

$slider_class = '';
if ( ! $is_primary ) $slider_class = 'container';
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';

if ( ! has_action( 'yit_after_header', 'yit_slider_space' ) ) add_action( 'yit_after_header', 'yit_slider_space' );
?>
 
 		<!-- BEGIN FLEXSLIDER SLIDER -->
 		<div id="<?php echo $slider_id ?>"<?php yit_slider_class($slider_class) ?> style="<?php echo $width_inline; ?><?php echo $height_inline; ?>">
    	   	<div class="slider-wrapper">
                <ul class="slides">
    		    <?php
                while( yit_have_slide() ) : ?>
                    <li>
                    	<?php yit_slide_the( 'featured-content', array(
    	                    'container' => false
    	                )); ?>
    	            </li>
                <?php endwhile; ?>
                </ul>
            </div>
            <div class="slider-shadow"></div>
		</div>
        
 
        <script type="text/javascript">
            jQuery(document).ready(function($){
                //$('#slider-<?php echo $current_slider ?>.flexslider img.attachment-full').css('width', '<?php echo $width == 0 ? '100%' : $width . 'px'; ?>').css('height', '<?php echo $height; ?>px');
			    
			    $('#<?php echo $slider_id ?>.flexslider .slider-wrapper').flexslider({
			        animation: '<?php yit_slide_the( 'effect' ); ?>',
			        slideshowSpeed: <?php echo yit_slide_get('interval') * 1000 ?>,
			        animationSpeed: <?php echo yit_slide_get('speed') * 1000 ?>,
			        touch: false,
			        controlNav: <?php if(yit_slide_get('controlnav')!='') {
	                            echo yit_slide_get('controlnav');
    			        }else {
    			            echo 'false';
    			        } ?>
			    });
            });
        </script>