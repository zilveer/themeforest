<?php 
class PulpFrameWorkShortCodes {
	
	function __construct() {		
		require( get_template_directory() . '/inc/shortcodes/shortcodes.php' );	
		add_action('init', array(&$this,'init'));
		add_action('admin_init', array(&$this, 'admin_init'));			
	}
	
	/*
	 * create the buttons only if the user has editing privs.
	 * If so we create the button and add it to the tinymce button array
	 */
	function init() {
		if ( current_user_can('edit_posts') &&  current_user_can('edit_pages') )
			{
				if ( get_user_option('rich_editing') == 'true' ) {					
					add_filter('mce_external_plugins', array(&$this,'add_tinymce_button_plugin'));
					 //adds the button to the tinymce button array
					 add_filter('mce_buttons', array(&$this,'register_button')); 
				}
			}
	}
		
	/*
	 * Call the javascript file that loads the 
	 * instructions for the new button
	 */
	function add_tinymce_button_plugin($plugin_array) {
		$plugin_array['pulpFrameWorkShortCodes'] =  $this->framework_url() . '/inc/shortcodes/tinymce/customcodes.js'; // map shortcode to specific js file		
		return $plugin_array;		
	}
	
	/*
	 * add the new button to the tinymce array
	 */
	function register_button($buttons) {
	   array_push($buttons, "|", "pulp_framework_button", "|", "clear");	   	   
	   return $buttons;
	}
	
	/*
	 * Enqueue Scripts and Styles	  
	 */
	function admin_init() {
		// css
		wp_enqueue_style( 'pulp-popup', $this->framework_url() . '/inc/shortcodes/tinymce/css/popup.css', false, '1.0', 'all' );
		
		// js
		wp_enqueue_script( 'jquery-ui-sortable' );
		wp_enqueue_script( 'jquery-livequery', $this->framework_url() . '/inc/shortcodes/tinymce/js/jquery.livequery.js', false, '1.1.1', false );
		wp_enqueue_script( 'jquery-appendo', $this->framework_url() . '/inc/shortcodes/tinymce/js/jquery.appendo.js', false, '1.0', false );
		wp_enqueue_script( 'base64', $this->framework_url() . '/inc/shortcodes/tinymce/js/base64.js', false, '1.0', false );
		wp_enqueue_script( 'pulp-popup', $this->framework_url() . '/inc/shortcodes/tinymce/js/popup.js', false, '1.0', false );
		
		
		wp_localize_script( 'jquery', 'PulpShortcodes', array('tinymce_folder' => get_template_directory_uri().'/inc/shortcodes/tinymce') );
	}		
	
	/*
	 * Enqueue Scripts and Styles	  
	 */
	function framework_url() {
		
		return trailingslashit( get_template_directory_uri() );
	
	}
	
}

$pulp_shortcodes = new PulpFrameWorkShortCodes();
?>