<?php
/**
 * @package WordPress
 * @subpackage Agriculture
 * @since Agriculture 1.6.4
 * 
 * TGM-Plugin-Activation 2.4.2
 * Created by CMSMasters
 * 
 */


require_once locate_template('/framework/class/class-tgm-plugin-activation.php');


function cmsms_register_theme_plugins() { 
	$plugins = array( 
		array( 
			'name'					=> 'CMSMasters Contact Form Builder', 
			'slug'					=> 'cmsms-contact-form-builder', 
			'source'				=> get_template_directory_uri() . '/framework/admin/inc/plugins/cmsms-contact-form-builder.zip', 
			'required'				=> true, 
			'version'				=> '1.0.1', 
			'force_activation'		=> false, 
			'force_deactivation' 	=> true 
		), 
		array( 
			'name' 					=> 'LayerSlider WP', 
			'slug' 					=> 'LayerSlider', 
			'source'				=> get_template_directory_uri() . '/framework/admin/inc/plugins/LayerSlider.zip', 
			'required'				=> true, 
			'version'				=> '5.6.9',
			'force_activation'		=> false, 
			'force_deactivation' 	=> false 
		), 
		array( 
			'name' 					=> 'Revolution Slider', 
			'slug' 					=> 'revslider', 
			'source'				=> get_template_directory_uri() . '/framework/admin/inc/plugins/revslider.zip', 
			'required'				=> false, 
			'version'				=> '5.2.5.4', 
			'force_activation'		=> false, 
			'force_deactivation' 	=> false 
		), 
		array( 
			'name' 					=> 'Contact Form 7', 
			'slug' 					=> 'contact-form-7', 
			'required' 				=> false 
		), 
		array( 
			'name' 					=> 'WooCommerce', 
			'slug' 					=> 'woocommerce', 
			'required'				=> false 
		)
	);
	
	
	$config = array( 
		'domain' => 			'cmsmasters', 
		'default_path' => 		'', 
		'parent_menu_slug' => 	'themes.php', 
		'parent_url_slug' => 	'themes.php', 
		'menu' => 				'theme-required-plugins', 
		'has_notices' => 		true, 
		'is_automatic' => 		false, 
		'message' => 			'', 
		'strings' => 			array( 
			'page_title' => 						__('Theme Required Plugins', 'cmsmasters'), 
			'menu_title' => 						__('Theme Plugins', 'cmsmasters'), 
			'installing' => 						__('Installing Plugin: %s', 'cmsmasters'), 
			'oops' => 								__('Something went wrong with the plugin API.', 'cmsmasters'), 
			'notice_can_install_required' => 		_n_noop('This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.'), 
			'notice_can_install_recommended' => 	_n_noop('This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.'), 
			'notice_cannot_install' => 				_n_noop('Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.'), 
			'notice_can_activate_required' => 		_n_noop('The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.'), 
			'notice_can_activate_recommended' => 	_n_noop('The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.'), 
			'notice_cannot_activate' => 			_n_noop('Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.'), 
			'notice_ask_to_update' => 				_n_noop('The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.'), 
			'notice_cannot_update' => 				_n_noop('Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.'), 
			'install_link' => 						_n_noop('Begin installing plugin', 'Begin installing plugins'), 
			'activate_link' => 						_n_noop('Activate installed plugin', 'Activate installed plugins'), 
			'return' => 							__('Return to Required Plugins Installer', 'cmsmasters'), 
			'plugin_activated' => 					__('Plugin activated successfully.', 'cmsmasters'), 
			'complete' => 							__('All plugins installed and activated successfully. %s', 'cmsmasters'), 
			'nag_type' => 							'updated' 
		) 
	);
	
	
	tgmpa($plugins, $config);
}

add_action('tgmpa_register', 'cmsms_register_theme_plugins');

