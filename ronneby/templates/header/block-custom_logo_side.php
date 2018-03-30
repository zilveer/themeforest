<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
global $dfd_ronneby;
if (isset($dfd_ronneby['custom_logo_image_side']['url']) && !empty($dfd_ronneby['custom_logo_image_side']['url'])) :
	$header_logo_width = (isset($dfd_ronneby['header_logo_width']) && !empty($dfd_ronneby['header_logo_width'])) ? $dfd_ronneby['header_logo_width'] : '';
	$header_logo_height = (isset($dfd_ronneby['header_logo_height']) && !empty($dfd_ronneby['header_logo_height'])) ? $dfd_ronneby['header_logo_height'] : '';
	
	$_logo_size = array($header_logo_width, $header_logo_height);
	$custom_logo_image_url = (isset($dfd_ronneby['custom_logo_image_side']['url']) && $dfd_ronneby['custom_logo_image_side']['url']) ? $dfd_ronneby['custom_logo_image_side']['url'] : '';
	$custom_logo_image = dfd_aq_resize($custom_logo_image_url, $_logo_size[0], $_logo_size[1]);
	
	if (empty($custom_logo_image)) {
		$custom_logo_image = $custom_logo_image_url;
	}
	
	$custom_retina_logo_image = '';
	$logo_image_w = '';
	$logo_image_h = '';
	
	if (
		isset($dfd_ronneby['custom_retina_logo_image_side']['url']) &&
		!empty($dfd_ronneby['custom_retina_logo_image_side']['url']) &&
		isset($dfd_ronneby['custom_retina_logo_image_side']['width']) &&
		!empty($dfd_ronneby['custom_retina_logo_image_side']['width']) &&
		isset($dfd_ronneby['custom_retina_logo_image_side']['height']) &&
		!empty($dfd_ronneby['custom_retina_logo_image_side']['height'])
	)
	{
		# Retina ready logo
		$custom_retina_logo_image = $dfd_ronneby['custom_retina_logo_image_side']['url'];
		$logo_image_w = $dfd_ronneby['custom_retina_logo_image_side']['width'];
		$logo_image_h = $dfd_ronneby['custom_retina_logo_image_side']['height'];
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