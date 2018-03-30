<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
if (isset($dfd_ronneby['custom_logo_image_second']['url']) && !empty($dfd_ronneby['custom_logo_image_second']['url'])) :
	$header_logo_width = (isset($dfd_ronneby['header_logo_width']) && !empty($dfd_ronneby['header_logo_width'])) ? $dfd_ronneby['header_logo_width'] : '';
	$header_logo_height = (isset($dfd_ronneby['header_logo_height']) && !empty($dfd_ronneby['header_logo_height'])) ? $dfd_ronneby['header_logo_height'] : '';
	
	$_logo_size = array($header_logo_width, $header_logo_height);
	$custom_logo_image_url = (isset($dfd_ronneby['custom_logo_image_second']['url']) && $dfd_ronneby['custom_logo_image_second']['url']) ? $dfd_ronneby['custom_logo_image_second']['url'] : '';
	$custom_logo_image = dfd_aq_resize($custom_logo_image_url, $_logo_size[0], $_logo_size[1]);
	
	if (empty($custom_logo_image)) {
		$custom_logo_image = $custom_logo_image_url;
	}
	
	$custom_retina_logo_image = '';
	$logo_image_w = '';
	$logo_image_h = '';
	
	if (
		isset($dfd_ronneby['custom_retina_logo_image_second']['url']) &&
		!empty($dfd_ronneby['custom_retina_logo_image_second']['url']) &&
		isset($dfd_ronneby['custom_retina_logo_image_second']['width']) &&
		!empty($dfd_ronneby['custom_retina_logo_image_second']['width']) &&
		isset($dfd_ronneby['custom_retina_logo_image_second']['height']) &&
		!empty($dfd_ronneby['custom_retina_logo_image_second']['height'])
	)
	{
		# Retina ready logo
		$custom_retina_logo_image = $dfd_ronneby['custom_retina_logo_image_second']['url'];
		$logo_image_w = $dfd_ronneby['custom_retina_logo_image_second']['width'];
		$logo_image_h = $dfd_ronneby['custom_retina_logo_image_second']['height'];
	}
		
?>
	<div class="logo-for-panel">
		<div class="inline-block">
			<a href="<?php echo home_url(); ?>/">
				<img src="<?php echo esc_url($custom_logo_image); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>" data-retina="<?php echo esc_url($custom_retina_logo_image); ?>" data-retina_w="<?php echo esc_attr($logo_image_w); ?>" data-retina_h="<?php echo esc_attr($logo_image_h); ?>" style="height: <?php echo esc_attr($header_logo_height); ?>px;" />
			</a>
		</div>
	</div>
<?php endif; ?>