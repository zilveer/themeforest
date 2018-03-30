<?php
/*
Description: A simple shortcode generator. Add buttons, columns, tabs, toggles and alerts to your theme.
Version: 1.1
Author: ThemeUs_Zilla
Author URI: http://www.themeus_zilla.com
*/

class Us_ZillaShortcodes {

    function __construct() 
    {
    	define('US_ZILLA_TINYMCE_URI', get_template_directory_uri() .'/functions/zilla-shortcodes/tinymce');
		define('US_ZILLA_TINYMCE_DIR', get_template_directory() .'/tinymce');
		
        add_action('init', array(&$this, 'init'));
        add_action('admin_init', array(&$this, 'admin_init'));
	}
	
	/**
	 * Registers TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function init()
	{
		
		if ( ! current_user_can('edit_posts') && ! current_user_can('edit_pages') )
			return;
	
		if ( get_user_option('rich_editing') == 'true' )
		{
			add_filter( 'mce_external_plugins', array(&$this, 'add_rich_plugins') );
//			add_filter( 'mce_buttons', array(&$this, 'register_rich_buttons') );
		}
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Defins TinyMCE rich editor js plugin
	 *
	 * @return	void
	 */
	function add_rich_plugins( $plugin_array )
	{
		$plugin_array['us_zillaShortcodes'] = US_ZILLA_TINYMCE_URI . '/plugin.js';
		return $plugin_array;
	}
	
	// --------------------------------------------------------------------------
	
	/**
	 * Adds TinyMCE rich editor buttons
	 *
	 * @return	void
	 */
	function register_rich_buttons( $buttons )
	{
		array_push( $buttons, "|", 'us_zilla_button' );
		return $buttons;
	}
	
	/**
	 * Enqueue Scripts and Styles
	 *
	 * @return	void
	 */
	function admin_init()
	{
		// css
		wp_enqueue_style( 'us_zilla-popup', US_ZILLA_TINYMCE_URI . '/css/popup.css', false, '1.0', 'all' );
		
		// js
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-livequery', US_ZILLA_TINYMCE_URI . '/js/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'jquery-appendo', US_ZILLA_TINYMCE_URI . '/js/jquery.appendo.js', false, '1.0', false );
		wp_enqueue_script( 'base64', US_ZILLA_TINYMCE_URI . '/js/base64.js', false, '1.0', false );
		wp_enqueue_script( 'us_zilla-popup', US_ZILLA_TINYMCE_URI . '/js/popup.js', false, '1.0', false );

//		wp_enqueue_media();
//		wp_enqueue_script( 'custom-header' );
		
		wp_localize_script( 'jquery', 'Us_ZillaShortcodes', array('plugin_folder' => get_template_directory_uri() .'/functions/zilla-shortcodes') );
	}
    
}
$us_zilla_shortcodes = new Us_ZillaShortcodes();

?>