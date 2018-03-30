<?php

class Base_admin {
	
	var $theme;
	
	function init( $theme ) {
		
		$this->theme = $theme;
		
		// Add admin functions
		$this->functions();

		// Add Admin Menu
		add_action('admin_menu', array(&$this,'add_option_menu') );
		
		// Add custom post types
		$this->theme_types();
		
		// Add custom metas
		$this->theme_metas();
		
		// Support Ajax call
		$this->ajax_call();
		
		// Theme Activate
		// add_action('admin_init', array(&$this,'theme_activate'));
	}
	
	// Admin functions
	function functions() {
		require_once( THEME_FUNCTIONS_DIR . '/admin-enque.php');
		require_once( THEME_FUNCTIONS_DIR . '/admin-functions.php');
		require_once( THEME_FUNCTIONS_DIR . '/input-tool.php' );
		require_once( THEME_FUNCTIONS_DIR . '/meta-tool.php' );
		require_once( THEME_FUNCTIONS_DIR . '/base-export.php' );
	}
	
	// Theme options menu
	function add_option_menu() {
		// Add theme options under Appearrence
		add_theme_page( __('Theme Options', 'theme_admin'), __('Theme Options', 'theme_admin'), 'edit_theme_options', 'theme_options', array(&$this, 'admin_option') );
	}

	function admin_option() {
		// Setting page
		$sections = $this->theme->options;
		
		include_once( THEME_FUNCTIONS_DIR.'/admin-options-template.php' );
	}

	// Custom Post Types
	function theme_types() {
		foreach( $this->theme->types as $type ) {
			require_once( THEME_TYPES_DIR.'/'.$type.'/register.php' );
			require_once( THEME_TYPES_DIR.'/'.$type.'/manage.php' );
			require_once( THEME_TYPES_DIR.'/'.$type.'/content.php' );
		}
	}
	
	// Custom Meta
	function theme_metas() {
		foreach( $this->theme->metas as $meta ) {
			require_once( THEME_TYPES_DIR.'/'.$meta.'/content.php' );
		}
	}
	
	// Theme Activate
	function theme_activate(){
		if ('themes.php' == basename($_SERVER['PHP_SELF']) && isset($_GET['activated']) && $_GET['activated']=='true' ) {
			wp_redirect( admin_url('admin.php?page=theme_options&save') );
		}
	}
	
	// Admin AJAX handlerer
	function ajax_call() {
		require_once( THEME_FUNCTIONS_DIR.'/admin-ajax.php' );
	}

}
?>