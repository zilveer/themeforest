<?php

/****************************************************
DESCRIPTION: 	FRAME OPTIONS
OPTION HANDLE: 	canon_options_frame
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_frame');

	function register_canon_options_frame () {
		global $screen_handle_canon_options_frame;	  			//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)
		$theme_name = wp_get_theme()->Name;						//get theme name

		// Use this instad if submenu
		$screen_handle_canon_options_frame = add_submenu_page(
			'handle_canon_options',								//the handle of the parent options page. 
			__('Header & Footer Settings', 'loc_canon'),		//the submenu title that will appear in browser title area.
			__('Header & Footer', 'loc_canon'),					//the on screen name of the submenu
			'manage_options',									//privileges check
			'handle_canon_options_frame',						//the handle of this submenu
			'display_options_frame'								//the callback function to display the actual submenu page content.
		);

		//changing the name of the first submenu which has duplicate name (there are global variables $menu and $submenu which can be used. var_dump them to see content)
		// Put this in the submenu controller. NB: Not in the first add_menu_page controller, but in the first submenu controller with add_submenu_page. It is not defined until then. 
		global $submenu;	
		$submenu['handle_canon_options'][0][0] = __("General", "loc_canon");

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_frame');	
	
	function init_canon_options_frame () {
		register_setting(
			'group_canon_options_frame',						//group name. The group for the fields custom_options_group
			'canon_options_frame',								//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_frame'						//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options_frame');	

	function default_canon_options_frame () {

	 	// SET DEFAULTS
	 	$default_options = array (

 			'header_padding_top'			=> 10,
 			'header_padding_bottom'			=> 10,
 			'pos_left_element_top'			=> 0,
 			'pos_left_element_left'			=> 0,
 			'pos_right_element_top'			=> 30,
 			'pos_right_element_right'		=> 0,

 			'use_sticky_preheader'			=> 'unchecked',
 			'use_sticky_header'				=> 'unchecked',
 			'use_sticky_postheader'			=> 'unchecked',
 			'sticky_turn_off_width'			=> '768',
 			'add_search_btn_to_primary'		=> 'unchecked',
 			'add_search_btn_to_secondary'	=> 'unchecked',
 			'status_of_scroll_to_menu_items'=> 'normal',

 			'pre_header_layout'				=> 'off',
 			'main_header_layout'			=> 'main_custom_left_right',
 			'main_custom_left'				=> 'logo',
 			'main_custom_right'				=> 'primary',
 			'post_header_layout'			=> 'off',

 			'logo_url'						=> '',
 			'logo_text_size'				=> 28,
 			'logo_max_width'				=> 151,

 			'header_img_homepage_only'		=> 'unchecked',
 			'header_img_url'				=> '',
			'header_img_bg_color'			=> '#252525',
 			'header_img_height'				=> 300,
 			'header_img_use_parallax'		=> 'checked',
 			'header_img_parallax_ratio'		=> '0.5',
 			'header_img_text'				=> "<h3>Header Image With Parallax Scrolling - What's Not To Like!</h3>[button]Buy Sport Today[/button]",
 			'header_img_text_alignment'		=> 'centered',
 			'header_img_text_margin_top'	=> 150,

 			'header_banner_code'			=> "<a href='http://www.themeforest.com/?ref=themecanon' target='_blank'><img src='".get_template_directory_uri()."/img/banner_468x60.gif'></a>",
 			
 			'header_text'					=> 'Phone: 555 555  1234',

			'toolbar_search_button'			=> 'checked',

			'countdown_datetime_string'		=> 'December 31, 2023 23:59:59',
			'countdown_gmt_offset'			=> '+10',
			'countdown_description'			=> 'Next Match: ',


			'show_social_icons'				=> 'checked',
			'social_in_new'					=> 'checked',
 			'social_links'					=> array(
 				'0' => array('fa-facebook-square','https://www.facebook.com/themecanon'),
 				'1' => array('fa-twitter-square','https://twitter.com/ThemeCanon'),
 				'2' => array('fa-rss-square', get_bloginfo('rss2_url')),
 			),

			'show_pre_footer'				=> 'checked',
			'show_main_footer'				=> 'checked',
			'show_post_footer'				=> 'checked',
			'footer_text'					=> '© Copyright Sport by <a href="http://www.themecanon.com" target="_blank">Theme Canon</a>',

		);

		// GET EXISTING OPTIONS IF ANY
		$canon_options_frame = (get_option('canon_options_frame')) ? get_option('canon_options_frame') : array();

		// MERGE ARRAYS. EXISTING OPTIONS WILL OVERWRITE DEFAULTS.
		$canon_options_frame = array_merge($default_options, $canon_options_frame);

		// SAVE OPTIONS
		update_option('canon_options_frame', $canon_options_frame);

	}

	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options_frame ($new_instance) {				
		$old_instance = get_option('canon_options_frame');
		return $new_instance;
	}

	//display the menus
	function display_options_frame () {
		require "options_frame.php";
	}