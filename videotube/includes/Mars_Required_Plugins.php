<?php
/**
 * VideoTube Required Plugin
 * Display the notifcation about the required plugins, TGM_Plugin_Activation class is required.
 * @author 		Toan Nguyen
 * @category 	Core
 * @version     1.0.0
 */
if( !defined('ABSPATH') ) exit;

if( ! function_exists( 'mars_theme_register_required_plugins' ) ):

	function mars_theme_register_required_plugins() {
	
		/**
		 * Array of plugin arrays. Required keys are name and slug.
		 * If the source is NOT from the .org repo, then source is also required.
		 */
		$plugins = array(
			array(
				'name'					=>	'Redux Framework',
				'slug'					=>	'redux-framework'
			),			
			array(
				'name'					=>	'Advanced Custom Fields',
				'slug'					=>	'advanced-custom-fields',
				'required'				=>	true
			),
			array(
				'name'					=>	'Advanced Custom Fields: Gallery Field',
				'slug'					=>	'acf-gallery',
				'source'				=>	get_template_directory() . '/plugins/acf-gallery.zip',
				'required'				=>	true
			),			
			array(
				'name'					=>	'Video Thumbnails',
				'slug'					=>	'video-thumbnails'
			),
			array(
				'name'					=>	'WPBakery Visual Composer',
				'slug'					=>	'js_composer',
				'version'				=>	'4.12',
				'source'				=>	get_template_directory() . '/plugins/js_composer.zip'
			),
			array(
				'name'					=>	'Social Count Plus',
				'slug'					=>	'social-count-plus'
			)
		);
		/**
		 * Array of configuration settings. Amend each line as needed.
		 * If you want the default strings to be available under your own theme domain,
		 * leave the strings uncommented.
		 * Some of the strings are added into a sprintf, so see the comments at the
		 * end of each line for what each argument will be.
		 */
		$config = array(
			'id'           => 'tgmpa',                 // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => '',                      // Default absolute path to bundled plugins.
			'menu'         => 'tgmpa-install-plugins', // Menu slug.
			'parent_slug'  => 'themes.php',            // Parent menu slug.
			'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => true,                   // Automatically activate plugins after installation or not.
			'message'      => ''
		);	
		
		tgmpa( $plugins, $config );
	}
	add_action( 'tgmpa_register', 'mars_theme_register_required_plugins' );

endif;