<?php

/**
 * Declare plugin dependencies
 *
 * @package wpv
 */

/**
 * Declare plugin dependencies
 */
function wpv_register_required_plugins() {
	$plugins = array(
		array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'required' => false,
		),

		array(
			'name' => 'WooCommerce',
			'slug' => 'woocommerce',
			'required' => false,
		),

		array(
			'name' => 'Love it (Maintained by Vamtam)',
			'slug' => 'vamtam-love-it',
			'source' => WPV_PLUGINS . 'vamtam-love-it.zip',
			'required' => false,
			'version' => '1.0.0',
		),

		array(
			'name' => 'Timetable Responsive Schedule For WordPress',
			'slug' => 'timetable',
			'source' => WPV_PLUGINS . 'timetable.zip',
			'required' => false,
			'version' => '2.2.0',
		),

		array(
			'name' => 'WP Retina 2x',
			'slug' => 'wp-retina-2x',
			'required' => false,
		),

		array(
			'name' => 'MailPoet Newsletters (formerly Wysija)',
			'slug' => 'wysija-newsletters',
			'required' => false,
		),

		array(
			'name' => 'Vamtam Push Menu',
			'slug' => 'vamtam-push-menu',
			'source' => WPV_PLUGINS . 'vamtam-push-menu.zip',
			'required' => false,
			'version' => '1.3.0',
		),

		array(
			'name' => 'Revolution Slider',
			'slug' => 'revslider',
			'source' => WPV_PLUGINS . 'revslider.zip',
			'required' => false,
			'version' => '5.0.9',
		),
	);

	$config = array(
		'default_path' => '',    // Default absolute path to pre-packaged plugins
		'is_automatic' => true,  // Automatically activate plugins after installation or not
	);

	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'wpv_register_required_plugins' );