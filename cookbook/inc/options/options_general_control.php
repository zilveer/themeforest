<?php

/****************************************************
DESCRIPTION: 	GENERAL OPTIONS
OPTION HANDLE: 	canon_options
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options');

	function register_canon_options () {
		global $screen_handle_canon_options;	  									//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)
		$theme_name = wp_get_theme()->Name;											//get theme name

		$screen_handle_canon_options = add_menu_page(
			sprintf("%s %s", esc_attr($theme_name), __("Settings", "loc_canon")), 	//page title (appears in the browser title area / on the tab)
			sprintf("%s %s", esc_attr($theme_name), __("Settings", "loc_canon")), 	//on screen name of options page (appears in left-hand menu)
			'manage_options', 														//capability (user-level) minimum level for access to this page.
			'handle_canon_options',													//handle of this options page
			'display_options_general', 												//the function / callback that runs the whole admin page
			'',																		//optional icon url 16x16px
			200																		//optional position in the menu. The higher the number the lower down on the menu list it appears.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options');	

	function init_canon_options () {
		register_setting(
			'group_canon_options',													//group name. The group for the fields custom_options_group
			'canon_options',														//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options'												//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options');	

	function default_canon_options () {

	 	// SET DEFAULTS
	 	$default_options = array (

	 		'reset_all'						=> '',
	 		'reset_basic'					=> '',
 			'use_responsive_design'			=> 'checked',
	 		'use_boxed_design'				=> 'unchecked',
	 		'use_maintenance_mode'			=> 'unchecked',
	 		'maintenance_title'				=> __('We are doing maintenance work!', 'loc_canon'),
	 		'maintenance_msg'				=> __("Don't worry we will be back soon -- in the meantime why don't you visit <a href='http://www.google.com'><strong><u>Google</u></strong></a>.", "loc_canon"),
			'sidebars_alignment'			=> 'right',
	 		'dev_mode'						=> 'unchecked',

	 		'autocomplete_words'			=> 'c++, jquery, I like jQuery, java, php, coldfusion, javascript, asp, ruby',
			
			'hide_theme_meta_description'	=> 'unchecked',
			'hide_theme_og'					=> 'unchecked',
			'fontface_fix'					=> 'unchecked',

		);

		// GET EXISTING OPTIONS IF ANY
		$canon_options = (get_option('canon_options')) ? get_option('canon_options') : array();

		// IF OPTIONS DO NOT EXIST (FIRST INSTALL OR AFTER RESET)
		if (empty($canon_options)) {
				
			// WORDPRESS OPTIONS DEFAULTS
			update_option('image_default_link_type','file');	//none, file, post

		}

		// MERGE ARRAYS. EXISTING OPTIONS WILL OVERWRITE DEFAULTS.
		$canon_options = array_merge($default_options, $canon_options);

		// SAVE OPTIONS
		update_option('canon_options', $canon_options);

	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_options_general () {
		require "options_general.php";
	}