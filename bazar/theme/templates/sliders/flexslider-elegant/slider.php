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
$height_inline = ( empty( $height ) ) ? '' : "height:{$height}px;";   

$slider_class = 'flexslider';
if ( ! $is_primary ) $slider_class = 'container';
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';

$caption_position = yit_slide_get( 'caption_position' );                  

if ( ! has_action( 'yit_after_header', 'yit_slider_space' ) ) add_action( 'yit_after_header', 'yit_slider_space' );
// switch ( $caption_position ) {
//     case 'left' :
//         $caption_class = 'span4';
//         break;
//     case 'right' :
//         $caption_class = 'span4 offset8';
//         break;  
//     case 'top' :
//     case 'bottom' :
//         $caption_class = 'span12';
//         break;  
// }
?>
 
 		<!-- BEGIN NIVO SLIDER -->
        <div id="<?php echo $slider_id ?>"<?php yit_slider_class($slider_class) ?> style="<?php echo $width_inline; ?>">     
    	   	<div class="slider-wrapper">
                <ul class="slides" style="<?php echo $width_inline; ?>">
                <?php
                while( yit_have_slide() ) : ?>
                    <li>
                    	<?php yit_slide_the( 'featured-content', array(
                            'container' => false
                        )); ?>             
                            
                        <?php if( yit_slide_get( 'content' ) ): ?>
                        <div class="slider-caption caption-<?php echo $caption_position; ?>">
                            <div class="caption-wrapper">
                                <h2><?php yit_slide_the( 'title' ) ?></h2>
                                <h4><?php yit_slide_the( 'subtitle' ) ?></h4>
                                <?php yit_slide_the( 'content' ) ?> 
                            </div>
                        </div>
                        <?php endif ?>
                    </li>
                <?php endwhile; ?>
                </ul>
            </div>     
            <div class="slider-shadow"></div>
        </div>
        
 
        <script type="text/javascript">
            jQuery(document).ready(function($){
                //$('#slider-<?php echo $current_slider ?>.flexslider img.attachment-full').css('width', '<?php yit_slide_the( 'width_' . $slider_type ); ?>px').css('height', '<?php yit_slide_the( 'height_' . $slider_type ); ?>px');
			    
			    var flex_caption_hide = function(slider) {
                    var currSlideElement = slider;
                    var caption_speed = <?php echo yit_slide_get('caption_speed') * 1000; ?>;
                    var width = parseInt( $('.slider-caption', currSlideElement).outerWidth() );
                    var height = parseInt( $('.slider-caption', currSlideElement).outerHeight() );
                    
                    $('.caption-top', currSlideElement).animate({top:height*-1}, caption_speed);
                    $('.caption-bottom', currSlideElement).animate({bottom:height*-1}, caption_speed);
                    $('.caption-left', currSlideElement).animate({left:width*-1}, caption_speed);
                    $('.caption-right', currSlideElement).animate({right:width*-1}, caption_speed);
                };        
			    
			    var flex_caption_show = function(slider) {      
                    var nextSlideElement = slider;
                    var caption_speed = <?php echo yit_slide_get('caption_speed') * 1000; ?>;
                    
                    $('.caption-top', nextSlideElement).animate({top:0}, caption_speed);
                    $('.caption-bottom', nextSlideElement).animate({bottom:0}, caption_speed);
                    $('.caption-left', nextSlideElement).animate({left:0}, caption_speed);
                    $('.caption-right', nextSlideElement).animate({right:0}, caption_speed);
                };
			    
			    $('#<?php echo $slider_id ?> .slider-wrapper').flexslider({
			        animation: '<?php yit_slide_the( 'effect_' . $slider_type ); ?>',
			        slideshowSpeed: <?php echo yit_slide_get('interval') * 1000 ?>,
			        animationSpeed: <?php echo yit_slide_get('speed') * 1000 ?>,
			        pauseOnAction: false,
			        controlNav: false,
			        directionNav: true,
			        touch: false,
                    start   : flex_caption_show,
                    before  : flex_caption_hide,
                    after   : flex_caption_show
			    });
            });
        </script>