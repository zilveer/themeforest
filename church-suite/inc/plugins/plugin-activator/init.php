<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.4.1
 * @author     Thomas Griffin
 * @author     Gary Jones
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation
 */

require_once get_template_directory() . '/inc/plugins/plugin-activator/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'webnus_register_required_plugins' );
function webnus_register_required_plugins() {
	$plugins = array(
		
		array(
			'name' 		=> esc_html__( 'Woocommerce', 'webnus_framework' ),
			'slug' 		=> 'woocommerce',
			'required' 	=> false,
		),

		array(
			'name' 		=> esc_html__( 'The Events Calendar', 'webnus_framework' ),
			'slug' 		=> 'the-events-calendar',
			'required' 	=> true,
		),
		
		array(
			'name' 		=> esc_html__( 'Contact Form 7', 'webnus_framework' ),
			'slug' 		=> 'contact-form-7',
			'required' 	=> true,
		),

		array(
			'name' 		=> esc_html__( 'WP PageNavi', 'webnus_framework' ),
			'slug' 		=> 'wp-pagenavi',
			'required' 	=> true,
		),

 		array(
            'name'       => esc_html__( 'Social Count Plus', 'webnus_framework' ),
            'slug'       => 'social-count-plus',
            'required'   => false,
        ),

		array(
            'name'       => esc_html__( 'Webnus Sermons', 'webnus_framework' ),
            'slug'       => 'webnus-sermons',
            'source'     => get_template_directory() . '/inc/plugins/webnus-sermons.zip',
            'required'   => true,
        ),

		array(
            'name'       => esc_html__( 'Webnus Causes', 'webnus_framework' ),
            'slug'       => 'webnus-causes',
            'source'     => get_template_directory() . '/inc/plugins/webnus-causes.zip',
            'required'   => true,
        ),
		
		array(
            'name'       => esc_html__( 'Essential Grid', 'webnus_framework' ),
            'slug'       => 'essential-grid',
            'source'     => get_template_directory() . '/inc/plugins/essential-grid.zip',
            'required'   => false,
        ),
		
		
		array(
			'name'       => esc_html__( 'Slider Revolution', 'webnus_framework' ),
			'slug'       => 'revslider',
			'source'     => get_template_directory() . '/inc/plugins/revslider.zip',
			'required'   => false,
		),
		
		array(
			'name'       => esc_html__( 'Layer Slider', 'webnus_framework' ),
			'slug'       => 'LayerSlider',
			'source'     => get_template_directory() . '/inc/plugins/layerslider.zip',
			'required'   => false,
		),	
			
		array(
			'name'       => esc_html__( 'Visual Composer', 'webnus_framework' ),
			'slug'       => 'js_composer',
			'source'     => get_template_directory() . '/inc/plugins/js_composer.zip',
			'required'   => true,
		),
		
		array(
			'name'       => esc_html__( 'Envato Wordpress Toolkit', 'webnus_framework' ),
			'slug'       => 'envato-wordpress-toolkit',
			'source'     => get_template_directory() . '/inc/plugins/envato-wordpress-toolkit.zip',
			'required'   => false,
		),	

	);
	

	$config = array(
		'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'parent_slug'  => 'themes.php',            // Parent menu slug.
		'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);

	tgmpa( $plugins, $config );

}
if(function_exists('vc_set_as_theme')) vc_set_as_theme( $disable_updater = true );