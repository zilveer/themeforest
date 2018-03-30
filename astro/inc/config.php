<?php
	//EDIT THE THEME NAME HERE IF NEEDED
	define('PRK_THEME_NAME', 'Astro');
	//NO MORE EDITING PLEASE
	// returns WordPress subdirectory if applicable
		function wp_base_dir() {
		  preg_match('!(https?://[^/|"]+)([^"]+)?!', site_url(), $matches);
		  if (count($matches) === 3) {
			return end($matches);
		  } else {
			return '';
		  }
		}
		
		// opposite of built in WP functions for trailing slashes
		function leadingslashit($string) {
		  return '/' . unleadingslashit($string);
		}
		
		function unleadingslashit($string) {
		  return ltrim($string, '/');
		}
		
		function add_filters($tags, $function) {
		  foreach($tags as $tag) {
			add_filter($tag, $function);
		  }
		}
	
	// Set the content width based on the theme's design and stylesheet
	if (!isset($content_width)) { $content_width = 1920; }
	
	define('POST_EXCERPT_LENGTH',       40);
	define('SIDEBAR_CLASSES',           'columns');	
	define('WP_BASE',                   wp_base_dir());
	define('THEME_NAME',                wp_get_theme());
	define('RELATIVE_PLUGIN_PATH',      str_replace(site_url() . '/', '', plugins_url()));
	define('FULL_RELATIVE_PLUGIN_PATH', WP_BASE . '/' . RELATIVE_PLUGIN_PATH);
	define('RELATIVE_CONTENT_PATH',     str_replace(site_url() . '/', '', content_url()));
	define('THEME_PATH',                RELATIVE_CONTENT_PATH . '/themes/' . THEME_NAME);
	define('PRK_BACKEND_THEME_NAME',		'astro');
	define('ACF_LITE',false);
	
	$remote_version_url=ABSPATH . 'wp-content/plugins/color-manager-astro/style_header.php';
	define('INJECT_STYLE',				@fopen($remote_version_url, "r"));

	// Make theme available for translation
    load_theme_textdomain('astro', get_template_directory() . '/lang');

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if (is_plugin_active('astro_framework/astro_framework.php')) 
	{
    	define('PRK_ASTRO_FRAMEWORK',"true");
    }
    else
    {
    	define('PRK_ASTRO_FRAMEWORK',"false");
	}
	if (is_plugin_active('js_composer/js_composer.php') || is_plugin_active('js_composer-4111/js_composer.php')) {
    	define('PRK_ASTRO_COMPOSER',true);
    }
    else {
    	define('PRK_ASTRO_COMPOSER',false);
	}
    if (is_plugin_active('woocommerce/woocommerce.php') || is_plugin_active('woocommerce-astro/woocommerce.php')) 
    {
    	define('PRK_WOO',"true");
    }
    else
    {
    	define('PRK_WOO',"false");
	}
	if (is_plugin_active('revslider/revslider.php')) 
	{
    	define('PRK_RVSLIDER',"true");
    }
    else
    {
    	define('PRK_RVSLIDER',"false");
	}
	if (is_plugin_active('sitepress-multilingual-cms/sitepress.php')) 
	{
    	define('PRK_WPML',"true");
    }
    else
    {
    	define('PRK_WPML',"false");
	}

