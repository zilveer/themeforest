<?php

// Only require these files, if the Visual Composer plugin is activated
if ( defined( 'WPB_VC_VERSION' ) ) {

	// require Visual Composer classes
	require_once( get_template_directory() . '/inc/vc-shortcodes/class-vc-shortcode.php' );
	require_once( get_template_directory() . '/inc/vc-shortcodes/class-vc-custom-param-types.php' );
	require_once( get_template_directory() . '/inc/vc-shortcodes/class-vc-helpers.php' );

	// require Visual Composer templates
	require_once( get_template_directory() . '/inc/vc-shortcodes/templates/template-vc-home-page.php' );
	require_once( get_template_directory() . '/inc/vc-shortcodes/templates/template-vc-projects.php' );
	require_once( get_template_directory() . '/inc/vc-shortcodes/templates/template-vc-our-services.php' );
	require_once( get_template_directory() . '/inc/vc-shortcodes/templates/template-vc-about-us.php' );
	require_once( get_template_directory() . '/inc/vc-shortcodes/templates/template-vc-contact-us.php' );

	// custom visual composer shortcodes for the theme
	$cargopress_custom_vc_shortcodes = array(
		'banner',
		'brochure-box',
		'facebook',
		'featured-page',
		'location',
		'container-google-maps',
		'icon-box',
		'social-icons',
		'testimonial',
		'container-testimonials',
	);

	foreach ( $cargopress_custom_vc_shortcodes as $file ) {
		require_once( sprintf( '%s/inc/vc-shortcodes/shortcodes/vc-%s.php', get_template_directory(), $file ) );
	}
}