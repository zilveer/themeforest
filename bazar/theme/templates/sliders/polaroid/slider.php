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

$slider_class = '';
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : ''; 
if ( empty( $width ) && ! $is_primary ) $slider_class .= ' container';

$width_inline  = ( empty( $width ) )  ? ( ( $is_primary ) ? "width:100%;" : '' ) : "width:{$width}px;";
$height_inline = ( empty( $height ) ) ? '' : "height:{$height}px;";
?>
 
 		<!-- BEGIN FLEXSLIDER SLIDER -->
 		<div id="<?php echo $slider_id ?>"<?php yit_slider_class($slider_class) ?> style="<?php echo $height_inline; echo $width_inline?>">
 		    <div class="thumbs <?php if ( ! $is_primary ) echo ' container'; ?>">
    		    <?php
                while( yit_have_slide() ) : list( $thumb_url, $thumb_width, $thumb_height ) = yit_image( array( 'id' => yit_slide_get('item_id'), 'size' => 'slider-polaroid-thumb', 'output' => 'array' ) ); ?>
                    <div class="thumb">
                    	<img src="<?php echo $thumb_url ?>" alt="<?php echo wp_get_attachment_url( yit_slide_get('item_id') ); ?>" />
                    	<?php if ( yit_slide_get( 'content' ) != '' || yit_slide_get( 'title' ) != '' ) : ?>
                        <div class="slide-content container align-<?php echo yit_slide_the('content_align'); ?><?php if ( yit_slide_get( 'is_full' ) ) echo ' full'; ?>" style="background-image:url('<?php echo wp_get_attachment_url( yit_slide_get('item_id') ); ?>');">
                            <?php if ( yit_slide_get( 'is_full' ) ) : ?><div class="container"><?php endif; ?>
                            <div class="text">
                                <h2><?php yit_slide_the( 'title' ); ?></h2> 
                                <?php yit_slide_the( 'content' ); ?>      
                            </div>  
                            <?php if ( yit_slide_get( 'is_full' ) ) : ?></div><?php endif; ?>
                        </div>
                        <?php endif; ?>
    	            </div>
                <?php endwhile; ?>
 		    </div>                                  
		</div>
        
 
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#<?php echo $slider_id ?>').polaroid({
			        animation: '<?php yit_slide_the( 'effect' ); ?>',
			        pause: <?php echo yit_slide_get('interval') * 1000 ?>,
			        animationSpeed: <?php echo yit_slide_get('speed') * 1000 ?>
			    });
            });
        </script>