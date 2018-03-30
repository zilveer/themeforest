<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Output static assets needed for theme backend end pages.
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1.2
 * @package     artbees
 */


class Mk_Theme_Backend_Assets{

	var $theme_version;
	var $is_js_min;
	var $is_css_min;
	var $assets_css_path;

	function __construct() {

		//Get the current version of theme from database.
		global $mk_options;
		$this->theme_version = get_option('mk_jupiter_theme_current_version');

		// Check if MK_DEV constant is set for debudding purposes.
		$this->is_js_min = !(defined('MK_DEV') ? constant("MK_DEV") : true);
     	$this->is_css_min = !(defined('MK_DEV') ? constant("MK_DEV") : true);

     	// Paths for assets.
     	$this->assets_css_path = THEME_ADMIN_ASSETS_URI . '/stylesheet/css'. ($this->is_css_min ? '/min' : '');
     	$this->assets_js_path = THEME_ADMIN_ASSETS_URI . '/js'. ($this->is_js_min ? '/min' : '');


     	// Get methods hooked up to admin_enqueue_scripts
     	add_action('admin_enqueue_scripts', array(&$this,'wp_libs'));
     	add_action('admin_enqueue_scripts', array(&$this,'select2_assets'));
     	add_action('admin_enqueue_scripts', array(&$this,'widgets_assets'));
     	add_action('admin_enqueue_scripts', array(&$this,'icon_library'));
     	add_action('admin_enqueue_scripts', array(&$this,'backend_core_assets'));
     	add_action('admin_init', 			array(&$this,'wp_enqueue_media'));
     	

	}




	/**
     * Enqueue core styles and scripts that will be loaded in almost all pages including
     * Theme options, add new post/page and editing, theme control panel pages 
     *
     */
	function backend_core_assets() {
		if(mk_theme_is_masterkey() || mk_theme_is_post_type() || mk_is_control_panel()) {

			wp_enqueue_script('attrchange', 			$this->assets_js_path . '/attrchange.js', 			array('jquery'), $this->theme_version, true);
	     	wp_enqueue_script('mk-options-dependency', 	$this->assets_js_path . '/options-dependency.js', 	array('jquery'), $this->theme_version, true);
	     	wp_enqueue_script('progress-circle', 		$this->assets_js_path . '/progress-circle.js', 		array('jquery'), $this->theme_version, true);
	     	wp_enqueue_script('attrchange', 			$this->assets_js_path . '/attrchange.js', 			array('jquery'), $this->theme_version, true);
	     	wp_enqueue_script('theme-backend-scripts', 	$this->assets_js_path . '/backend-scripts.js', 		array('jquery'), $this->theme_version, true);
	     	wp_enqueue_style('theme-backend-styles', $this->assets_css_path .'/theme-backend-styles.css', false, $this->theme_version);

     	}
	}

	/**
     * Enqueue some of WP built-in libraries.
     *
     */
	function wp_libs() {
		wp_enqueue_script('jquery-ui-tabs');
	    wp_enqueue_script('jquery-ui-slider');
	    wp_enqueue_script('wp-color-picker');
     	wp_enqueue_style('wp-color-picker');
	}



	/**
     * Enqueue WordPress media assets for theme options. It will be used for upload options.
     *
     */
	function wp_enqueue_media() {

		if(!mk_theme_is_masterkey()) return false;

		if (function_exists('wp_enqueue_media')) {
			wp_enqueue_media();
		}
	}



	/**
     * Enqueue select2 assets to be used in multiselect dropdowns. its widely used library in the theme.
     * @link https://select2.github.io/
     *
     */
	function select2_assets() {

		wp_enqueue_style('mk-select2', 	$this->assets_css_path .'/select2.css', false, $this->theme_version);
		wp_enqueue_script('mk-select2', $this->assets_js_path .	'/select2.js', array('jquery'), $this->theme_version, true);

	}



	/**
     * Enqueues assets specifically for widgets.php
     *
     */
	function widgets_assets() {
		
		if(!mk_theme_is_widgets()) return false;

		wp_enqueue_script('widget-scripts', $this->assets_js_path .'/widgets.js', array('jquery'), $this->theme_version, true);
     	wp_enqueue_style('theme-style', $this->assets_css_path .'/widgets.css', false, $this->theme_version);
	}



	/**
     * Assets required for Theme control panel > icon library
     *
     */
	function icon_library() {

		if(!mk_theme_is_icon_library()) return false;

		wp_enqueue_script('icon-libs-filter', $this->assets_js_path .'/icon-libs-filter.js', array('jquery'), $this->theme_version, true);
		wp_enqueue_style('mk-icon-libs', $this->assets_css_path .'/icon-library.css', false, $this->theme_version);
	}


}


new Mk_Theme_Backend_Assets();