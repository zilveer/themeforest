<?php
$phpinfo =  pathinfo( __FILE__ );
$path = $phpinfo['dirname'];
include( $path . '/config.php' );

$id = Mk_Static_Files::shortcode_id();

if ( $images == '' ) return null;

$images = explode( ',', $images );

$parallax = ( $enable_3d == 'true' ) ? 'parallax-slideshow ' : '';

$border_color = !empty($border_color) ? ('border:1px solid '.$border_color.';') : '';
$backgroud_image = !empty( $bg_image ) ? 'background-image:url('.$bg_image.'); ' : '';
$bg_color = !empty( $bg_color ) ? 'background-color:'.$bg_color.'; ' : '';

$slider_atts[] = 'data-speedFactor="'.$speed_factor.'"';
$slider_atts[] = 'data-animation="'.$effect.'"';
$slider_atts[] = 'data-easing="swing"';
$slider_atts[] = 'data-direction="horizontal"';
$slider_atts[] = 'data-smoothHeight="'.$smooth_height.'"';
$slider_atts[] = 'data-animationSpeed="'.$animation_speed.'"';
$slider_atts[] = 'data-slideshowSpeed="'.$slideshow_speed.'"';
$slider_atts[] = 'data-pauseOnHover="'.$pause_on_hover.'"';
$slider_atts[] = 'data-controlNav="false"';
$slider_atts[] = 'data-directionNav="'.$direction_nav.'"';
$slider_atts[] = 'data-isCarousel="false"';

?>

<div id="fullwidth-slideshow-wrapper-<?php echo $id; ?>">
	<div id="fullwidth-slideshow-<?php echo $id; ?>" class="mk-fullwidth-slideshow mk-script-call mk-flexslider js-flexslider <?php echo $parallax.$el_class; ?> stretch-images-<?php echo $stretch_images; ?>" <?php echo implode(' ', $slider_atts); ?>>
		<ul class="mk-flex-slides">
			<?php foreach ( $images as $image ) { ?>
			    <li>
			    	<img src="<?php echo wp_get_attachment_image_src( $image, 'full' )[0]; ?>" alt="<?php echo trim(strip_tags( get_post_meta($image, '_wp_attachment_image_alt', true) )); ?>" />
			    </li>
			<?php } ?>
		</ul>
	</div>
	<div class="clearboth"></div>
</div>

<?php
/**
 * Custom CSS Output
 * ==================================================================================
 */

$app_styles = '
	#fullwidth-slideshow-wrapper-'.$id.' {
		padding:'.$padding.'px 0;
		'.$backgroud_image.$bg_color.$border_color.';
		background-position:'.$bg_position.';
		background-attachment:'.$attachment.';
		border-left:none;
		border-right:none;
	}
';

Mk_Static_Files::addCSS($app_styles, $id);
