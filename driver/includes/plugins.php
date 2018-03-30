<?php

/*
 * Register recommended plugins for this theme.
 */

function iron_register_required_plugins ()
{
	$plugins = array(
    array(
        'name' => 'Envato WordPress Toolkit',
        'slug' => 'envato-wordpress-toolkit-master',
        'source' => IRON_PARENT_DIR . '/includes/plugins/envato-wordpress-toolkit-master.zip',
        'required' => false,
        'version' => '1.6.3',
        'force_activation' => false,
        'force_deactivation' => false,
        'external_url' => '',
    ),
		array(
			'name'     => 'Contact Form 7',
			'slug'     => 'contact-form-7',
			'required' => true
		),
		array(
			'name'     => 'Simple Page Ordering',
			'slug'     => 'simple-page-ordering',
			'required' => false
		),
		array(
			'name'     => 'Duplicate Post',
			'slug'     => 'duplicate-post',
			'required' => false
		),
		array(
			'name'		=>	'Google Analytics for WordPress',
			'slug'		=>	'google-analytics-for-wordpress',
			'required'	=>	false
		),
		array(
			'name'		=>	'WooCommerce',
			'slug'		=>	'woocommerce',
			'required'	=>	false
		),
		array(
            'name'                  => 'MailChimp Widget', // The plugin name
            'slug'                  => 'nmedia-mailchimp-widget', // The plugin slug (typically the folder name)
            'file_path'				=> 'nmedia-mailchimp-widget/nm_mailchimp.php',
            'source'                => IRON_PARENT_DIR . '/includes/plugins/nmedia-mailchimp-widget.zip', // The plugin source
            'required'              => false, // If false, the plugin is only 'recommended' instead of required
            'version'               => '3.2.4', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),  
		array(
            'name'                  => 'Visual Composer', // The plugin name
            'slug'                  => 'js_composer', // The plugin slug (typically the folder name)
            'file_path'				=> 'js_composer/js_composer.php',
            'source'                => IRON_PARENT_DIR . '/includes/plugins/js_composer.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '4.11.2.1', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),       
        array(
            'name'                  => 'Slider Revolution', // The plugin name
            'slug'                  => 'revslider', // The plugin slug (typically the folder name)
            'file_path'				=> 'revslider/revslider.php',
            'source'                => IRON_PARENT_DIR . '/includes/plugins/revslider.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '5.2.5', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
        array(
            'name'                  => 'Essential Grid', // The plugin name
            'slug'                  => 'essential-grid', // The plugin slug (typically the folder name)
            'file_path'				=> 'essential-grid/essential-grid.php',
            'source'                => IRON_PARENT_DIR . '/includes/plugins/essential-grid.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.0.8', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),
        array(
            'name'                  => '4k VC Icon Shortcode', // The plugin name
            'slug'                  => '4k-icons', // The plugin slug (typically the folder name)
            'file_path'				=> '4k-vc-icon-shortcode/4k-vc-icon-shortcode.php',
            'source'                => IRON_PARENT_DIR . '/includes/plugins/4k-Icons-for-VC/plugin/4k-icons.zip', // The plugin source
            'required'              => true, // If false, the plugin is only 'recommended' instead of required
            'version'               => '2.9', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
            'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
            'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
        ),		
        	array(
		        'name'                  => '4k VC Icon Shortcode (Pact 1)', // The plugin name
		        'slug'                  => '4k-icons-pack01', // The plugin slug (typically the folder name)
		        'file_path'				=> '4k-icons-pack01/4k-icon-pack.php',
		        'source'                => IRON_PARENT_DIR . '/includes/plugins/4k-Icons-for-VC/plugin/4k-icons-pack01.zip', // The plugin source
		        'required'              => true, // If false, the plugin is only 'recommended' instead of required
		        'version'               => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		        'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		        'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		    ),
		    array(
		        'name'                  => '4k VC Icon Shortcode (Pact 2)', // The plugin name
		        'slug'                  => '4k-icons-pack02', // The plugin slug (typically the folder name)
		        'file_path'				=> '4k-icons-pack02/4k-icon-pack.php',
		        'source'                => IRON_PARENT_DIR . '/includes/plugins/4k-Icons-for-VC/plugin/4k-icons-pack02.zip', // The plugin source
		        'required'              => true, // If false, the plugin is only 'recommended' instead of required
		        'version'               => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		        'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		        'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		    ),
		    array(
		        'name'                  => '4k VC Icon Shortcode (Pact 3)', // The plugin name
		        'slug'                  => '4k-icons-pack03', // The plugin slug (typically the folder name)
		        'file_path'				=> '4k-icons-pack03/4k-icon-pack.php',
		        'source'                => IRON_PARENT_DIR . '/includes/plugins/4k-Icons-for-VC/plugin/4k-icons-pack03.zip', // The plugin source
		        'required'              => true, // If false, the plugin is only 'recommended' instead of required
		        'version'               => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		        'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		        'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		    ),
		    array(
		        'name'                  => '4k VC Icon Shortcode (Pact 4)', // The plugin name
		        'slug'                  => '4k-icons-pack04', // The plugin slug (typically the folder name)
		        'file_path'				=> '4k-icons-pack04/4k-icon-pack.php',
		        'source'                => IRON_PARENT_DIR . '/includes/plugins/4k-Icons-for-VC/plugin/4k-icons-pack04.zip', // The plugin source
		        'required'              => true, // If false, the plugin is only 'recommended' instead of required
		        'version'               => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		        'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		        'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		    ),
		    array(
		        'name'                  => '4k VC Icon Shortcode (Pact 5)', // The plugin name
		        'slug'                  => '4k-icons-pack05', // The plugin slug (typically the folder name)
		        'file_path'				=> '4k-icons-pack05/4k-icon-pack.php',
		        'source'                => IRON_PARENT_DIR . '/includes/plugins/4k-Icons-for-VC/plugin/4k-icons-pack05.zip', // The plugin source
		        'required'              => true, // If false, the plugin is only 'recommended' instead of required
		        'version'               => '1.0', // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
		        'force_activation'      => false, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
		        'force_deactivation'    => false, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
		    ),
	);

	$config = array(
		'domain'       => IRON_TEXT_DOMAIN,
		'has_notices'  => true, // Show admin notices or not
		'is_automatic' => true // Automatically activate plugins after installation or not
	);


	if(is_admin() && function_exists('get_plugin_data')) {

		foreach($plugins as $plugin) {
			if(!empty($plugin['file_path']) && is_plugin_active($plugin['file_path']) && !empty($plugin["version"])) {
				$version = $plugin["version"];
				$plugin_path = WP_PLUGIN_DIR.'/'.$plugin['slug'];
				$plugin_file = WP_PLUGIN_DIR.'/'.$plugin['file_path'];
				$plugin_source = $plugin['source'];
				$data = get_plugin_data($plugin_file);
				if(!empty($data["Version"]) && ($data["Version"] < $version) && empty($_GET["tgmpa-install"])) {
			
					deactivate_plugins($plugin_file);
					iron_delete_dir($plugin_path);

				}
			}
		}
	}
	
	tgmpa($plugins, $config);

}

add_action('tgmpa_register', 'iron_register_required_plugins');



function iron_delete_dir($dirname) {
     if (is_dir($dirname))
          $dir_handle = @opendir($dirname);
	 if (!$dir_handle)
	      return false;
	 while($file = readdir($dir_handle)) {
	       if ($file != "." && $file != "..") {
	            if (!is_dir($dirname."/".$file))
	                 @unlink($dirname."/".$file);
	            else
	                 iron_delete_dir($dirname.'/'.$file);
	       }
	 }
	 @closedir($dir_handle);
	 @rmdir($dirname);
	 return true;
}


/**
 *  iron_acf_helpers_get_dir
 *
 * If the theme is used as a symlinked folder, this should help.
 *
 *  @since: 1.6.0
 *  @see helpers_get_dir
 */

function iron_acf_helpers_get_dir ( $dir ) {

	if ( false === strpos($dir, WP_CONTENT_DIR) )
	{
		$output = IRON_PARENT_URL . '/includes/advanced-custom-fields/';

		if ( false !== strpos($dir, 'acf-addons/acf-repeater') )
			$output .= '../acf-addons/acf-repeater/';

		if ( false !== strpos($dir, 'acf-addons/acf-widget-area') )
			$output .= '../acf-addons/acf-widget-area/';

		$dir = $output;
	}

	return $dir;
}

add_filter('acf/helpers/get_dir', 'iron_acf_helpers_get_dir', 2, 1);

/**
 * Force Visual Composer to initialize as "built into the theme". This will hide certain tabs under the Settings->Visual Composer page
 */

function iron_vcSetAsTheme() {
    vc_set_as_theme();
}
add_action( 'vc_before_init', 'iron_vcSetAsTheme' );
