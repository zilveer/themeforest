<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Kriya for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once VEDA_THEME_DIR . '/functions/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'veda_register_required_plugins' );
/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */
function veda_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(

		array(
			'name'     				=> 'Visual Composer',
			'slug'     				=> 'js_composer',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/premium/js_composer.zip',
			'version' 				=> '4.12',
			'required' 				=> true,
			'force_activation' 		=> true,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> 'Ultimate Addons for Visual Composer',
			'slug'     				=> 'Ultimate_VC_Addons',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/premium/Ultimate_VC_Addons.zip',
			'version' 				=> '3.16.5',
			'required' 				=> false,
		),

		array(
			'name'     				=> 'Layer Slider',
			'slug'     				=> 'LayerSlider',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/premium/LayerSlider.zip',
			'version' 				=> '5.6.9',
		),

		array(
			'name'     				=> 'Revolution Slider',
			'slug'     				=> 'revslider',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/premium/revslider.zip',
			'version' 				=> '5.2.6',
		),

		array(
			'name'     				=> 'Responsive Google Maps',
			'slug'     				=> 'responsive-maps-plugin',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/premium/responsive-maps-plugin.zip',
			'version' 				=> '3.4',
		),

		array(
			'name'     				=> 'DesignThemes Core Features Plugin',
			'slug'     				=> 'designthemes-core-features',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-core-features.zip',
			'required' 				=> true,
			'version' 				=> '1.6',
			'force_activation' 		=> true,
			'force_deactivation' 	=> true,
		),
		
		array(
			'name'     				=> 'Veda Demo Importer',
			'slug'     				=> 'veda-demo-importer',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/veda-demo-importer.zip',
			'required' 				=> false,
			'version' 				=> '1.8',
		),

		array(
			'name'     				=> 'DesignThemes Attorney Add-on',
			'slug'     				=> 'designthemes-attorney-addon',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-attorney-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> 'DesignThemes Doctor Add-on',
			'slug'     				=> 'designthemes-doctor-addon',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-doctor-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.2',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> 'DesignThemes Event ( Night club ) Add-on',
			'slug'     				=> 'designthemes-event-addon',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-event-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.1',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> 'DesignThemes Model Add-on',
			'slug'     				=> 'designthemes-model-addon',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-model-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> 'DesignThemes Program( Fitness ) Add-on',
			'slug'     				=> 'designthemes-program-addon',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-program-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> 'DesignThemes Restaurant Add-on',
			'slug'     				=> 'designthemes-restaurant-addon',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-restaurant-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> 'DesignThemes Rooms( Hotel ) Add-on',
			'slug'     				=> 'designthemes-rooms-addon',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-rooms-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> 'DesignThemes University Add-on',
			'slug'     				=> 'designthemes-university-addon',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-university-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.1',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name'     				=> 'DesignThemes Yoga Add-on',
			'slug'     				=> 'designthemes-yoga-addon',
			'source'   				=> 'https://s3.amazonaws.com/wedesignthemes/veda/designthemes-yoga-addon.zip',
			'required' 				=> false,
			'version' 				=> '1.0',
			'force_activation' 		=> false,
			'force_deactivation' 	=> false,
		),

		array(
			'name' 					=> 'Contact Form 7',
			'slug' 					=> 'contact-form-7',
			'required' 				=> false,
		),

		array(
			'name' 					=> 'WooCommerce - excelling eCommerce',
			'slug' 					=> 'woocommerce',
			'required' 				=> false,
		),

		array(
			'name' 					=> 'The Events Calendar',
			'slug' 					=> 'the-events-calendar',
			'required'			 	=> false,
		),				

		array(
			'name'					=> 'Envato WordPress Toolkit',
			'slug'					=> 'envato-wordpress-toolkit',
			'source'				=> 'https://s3.amazonaws.com/wedesignthemes/premium/envato-wordpress-toolkit.zip'
		)	
	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'veda',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );
}?>