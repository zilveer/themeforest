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
		global $screen_handle_canon_options;	  		//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		$screen_handle_canon_options = add_menu_page(
			'Kause Settings', 							//page title (appears in the browser title area / on the tab)
			'Kause Settings', 							//on screen name of options page (appears in left-hand menu)
			'manage_options', 							//capability (user-level) minimum level for access to this page.
			'handle_canon_options',						//handle of this options page
			'display_options_general', 					//the function / callback that runs the whole admin page
			'',											//optional icon url 16x16px
			200											//optional position in the menu. The higher the number the lower down on the menu list it appears.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options');	

	function init_canon_options () {
		register_setting(
			'group_canon_options',						//group name. The group for the fields custom_options_group
			'canon_options',							//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options'					//optional 3rd param. Callback /function to sanitize and validate
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
	 		'use_construction_mode'			=> 'unchecked',
	 		'construction_msg'				=> 'This site is under construction!',

 			'logo_text_size'				=> 28,
 			'logo_max_width'				=> 99,
 			'header_padding_top'			=> 0,
 			'header_padding_bottom'			=> 0,
 			'pos_logo_top'					=> 0,
 			'pos_logo_left'					=> 0,
 			'pos_nav_top'					=> 0,
 			'pos_nav_right'					=> 0,
 			'use_sticky_header'				=> 'unchecked',
 			'highlight_last_menu_item'		=> 'unchecked',
 			'highlight_as_button'			=> 'unchecked',
 			'sticky_turn_off_width'			=> '768',

			'show_widgetized_footer'		=> 'checked',
			'show_social_footer'			=> 'checked',
			'footer_text'					=> '© Copyright Kause by <a href="http://www.themecanon.com" target="_blank">Theme Canon</a>',
			
			'show_social_icons'				=> 'checked',
 			'social_links'					=> array(
 				'0' => array('fa-facebook-square','https://www.facebook.com/pages/Theme-Canon/117307468468269'),
 				'1' => array('fa-twitter-square','https://twitter.com/ThemeCanon'),
 				'2' => array('fa-rss-square', get_bloginfo('rss2_url')),
 			),

			'hide_theme_meta_description'	=> 'unchecked',
			'hide_theme_og'					=> 'unchecked',

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