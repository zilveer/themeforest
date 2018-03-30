<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
global $is_primary;

$thumbs = ''; 
$slider_type = yit_slide_get( 'slider_type' );  

$width = yit_slide_get('width') == 0 ? '100%' : yit_slide_get('width') . 'px'; 
$width_inline = ( yit_slide_get('width') == 0 ) ? "" : "width: $width;";

$slider_class  = 'ei-slider';
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';

if ( yit_slide_get('width') == 0 && ! $is_primary ) {
    $slider_class .= ' container';
} else {
    $width_inline = "width: $width;";
}
?>
 		<!-- BEGIN #slider -->
        <div id="<?php echo $slider_id ?>"<?php yit_slider_class($slider_class) ?> style="<?php echo $width_inline ?>">
            <div class="ei-slider-loading"><?php _e( 'Loading', 'yit' ) ?></div>
            <ul class="ei-slider-large">
            
                <?php while( yit_have_slide() ) :       
                    global $_wp_additional_image_sizes;
                    
                    list( $thumbnail, $thumb_width, $thumb_height ) = yit_image( "id=" . yit_slide_get('item_id') . "&size=thumb-slider-elastic&output=array" );
                    
                    $thumbs .= "<li><a href=\"#\">".strip_tags(yit_slide_get( 'title' ))." - ".strip_tags(yit_slide_get( 'clean-content' ))."</a><img src=\"$thumbnail\" alt=\"".strip_tags(yit_slide_get( 'slide_title' ))." - ".strip_tags(yit_slide_get( 'clean-content' ))."\" /></li>\n"; ?>
                    
                <li<?php yit_slide_class( 'slide align-' . yit_slide_get( 'layout_slide' ) ) ?>>
                    <?php yit_slide_the( 'featured-content', array(
                         'container' => false
                      ) ) ?> 
                    <?php if ( yit_slide_get( 'title' ) != '' || yit_slide_get( 'subtitle' ) != '' ) : ?>
                    <div class="ei-title">
                        <?php yit_string( '<h2>', yit_slide_get( 'title' ), '</h2>' ) ?>   
                        <?php yit_string( '<h3>', yit_slide_get( 'subtitle' ), '</h3>' ) ?>
                    </div>
                    <?php endif; ?>
                </li>
                <?php endwhile; ?> 
            </ul><!-- ei-slider-large -->
            <ul class="ei-slider-thumbs">
                <li class="ei-slider-element"><?php _e( 'Current', 'yit' ) ?></li>
                <?php echo $thumbs ?>
            </ul><!-- ei-slider-thumbs -->    
            
            <div class="shadow"></div>
        </div><!-- ei-slider -->    
 		<!-- END #slider -->
 
        <script type="text/javascript">
            jQuery(document).ready(function($){
                $('#<?php echo $slider_id ?>.elastic').eislideshow({
        			easing		: 'easeOutExpo',
        			titleeasing	: 'easeOutExpo',
        			titlespeed	: 1200,
        			autoplay	: <?php yit_slide_the( 'autoplay', array( 'bool' => true ) ) ?>,
        			slideshow_interval : <?php echo yit_slide_get('interval') * 1000 ?>,
        			speed       : <?php echo yit_slide_get('speed') * 1000 ?>,
        			animation   : '<?php yit_slide_the('animation') ?>'
        // 		slidesLoaded: function() {
        //                    $('.ei-slider .ei-slider-loading').hide();
        //              }
                });
            });
        </script>