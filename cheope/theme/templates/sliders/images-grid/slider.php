<?php
/**
 * @package WordPress
 * @subpackage Your Inspiration Themes
 */         
 
$thumbs = ''; 
$slider_type = yit_slide_get( 'slider_type' ); 

$height = yit_slide_get( 'height' );
$height_inline = ( empty( $height ) ) ? '' : "height:{$height}px;"; 

$atts = array( 'width', 'height', 'cols', 'min_rows', 'max_rows', 'random_heights', 'padding', 'interval', 'speed', 'easing' );
foreach ( $atts as $att ) {
    ${$att} = yit_slide_get( $att );
}

// adjust min_rows and max_rows for mobile
if ( yit_is_mobile() && ! yit_is_ipad() ) {
    if ( $cols > 3 ) $cols = 3;
    if ( $height > 350 ) $height = 350;
}                   

$slider_class = '';
$slider_class .= yit_slide_get('align') != '' ? ' align' . yit_slide_get('align') : '';
?>
 
 		<!-- BEGIN FLEXSLIDER SLIDER -->
 		<div id="<?php echo $slider_id ?>"<?php yit_slider_class($slider_class) ?><?php if ( yit_slide_get('align') == 'center' && ! empty( $width ) ) : ?> style="width:<?php echo $width; ?>px;"<?php endif; ?>>
 		    <div class="slides-container">
    		    <?php
                while( yit_have_slide() ) : ?>
                    <div class="dg-cell">
                    	<div class="dg-cell-src"><?php yit_slide_the('image_url'); ?></div>
    					<div class="dg-cell-title"><?php yit_slide_the('title'); ?></div>
    					<div class="dg-cell-description"><?php yit_slide_the('text'); ?></div>
    					<div class="dg-cell-link"><?php yit_slide_the('slide-link-url'); ?></div>
    	            </div>
                <?php endwhile; ?>
            </div>
		</div>
        
 
        <script type="text/javascript">
            <?php if ( yit_ie_version() == 8 ) : ?>
            jQuery(window).load(function(){ $ = jQuery;
            <?php else : ?>
            jQuery(document).ready(function($){
            <?php endif; ?>
                //$('#slider-<?php echo $current_slider ?>.flexslider img.attachment-full').css('width', '<?php echo $width == 0 ? '100%' : $width . 'px'; ?>').css('height', '<?php echo $height; ?>px');
			    
			    $('#<?php echo $slider_id ?> .slides-container').dynamicGallery({
			        <?php if ( ! empty( $width ) ) : ?>width          : <?php echo $width ?>,<?php endif; ?>
			        height         : <?php echo $height ?>,
			        cols           : <?php echo $cols ?>,
			        min_rows       : <?php echo $min_rows ?>,
			        max_rows       : <?php echo $max_rows ?>,
			        random_heights : false,
			        padding        : <?php echo $padding ?>,            
			        <?php if ( ! empty( $easing ) ) : ?>easing         : '<?php echo $easing ?>',<?php endif; ?>
			        interval       : <?php echo $interval * 1000 ?>,
			        speed          : <?php echo $speed * 1000 ?>,
			        scale_images   : true,
			        center_images  : true,
			        show_title_in_lightbox : false
			    });
            });
        </script>