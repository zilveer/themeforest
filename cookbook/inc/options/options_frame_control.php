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

 			'header_pre_layout'				=> 'header_pre_custom_left_right',
 			'header_pre_custom_left'		=> 'primary',
 			'header_pre_custom_right'		=> 'social',
 			'header_main_layout'			=> 'header_main_custom_center',
 			'header_main_custom_center'		=> 'logo',
 			'header_post_layout'			=> 'off',

 			'homepage_feature_layout'		=> 'off',

 			'footer_pre_layout'				=> 'footer_pre_custom_left_right',
 			'footer_pre_custom_left'		=> 'breadcrumbs',
 			'footer_pre_custom_right'		=> 'off',
 			'footer_main_layout'			=> 'block_widgetized_footer',
 			'footer_post_layout'			=> 'footer_post_custom_left_right',
 			'footer_post_custom_left'		=> 'footer_text',
 			'footer_post_custom_right'		=> 'social',

 			'header_padding_top'			=> 25,
 			'header_padding_bottom'			=> 25,
 			'pos_left_element_top'			=> 0,
 			'pos_left_element_left'			=> 0,
 			'pos_right_element_top'			=> 10,
 			'pos_right_element_right'		=> 0,

 			'use_sticky_preheader'			=> 'unchecked',
 			'use_sticky_header'				=> 'unchecked',
 			'use_sticky_postheader'			=> 'unchecked',
 			'sticky_turn_off_width'			=> '768',
 			'add_search_btn_to_primary'		=> 'unchecked',
 			'add_search_btn_to_secondary'	=> 'unchecked',

 			'logo_url'						=> '',
 			'logo_text_size'				=> 48,
 			'logo_max_width'				=> 223,

 			'header_img_homepage_only'		=> 'unchecked',
 			'header_img_url'				=> '',
			'header_img_bg_color'			=> '#141312',
 			'header_img_height'				=> 450,
 			'header_img_parallax_amount'	=> 100,
 			'header_img_parallax_yoffset'	=> 0,
 			'header_img_text'				=> "<h2>Background Header Image With Parallax Scrolling</h2>
<p style='margin-top: -10px;' class='lead'>Also add your own HTML and shortcodes</p>
[button]Buy Cookbook Today[/button]",
 			'header_img_text_alignment'		=> 'centered',
 			'header_img_text_margin_top'	=> 170,

 			'header_banner_code'			=> "<a href='#'><img src='" . get_template_directory_uri() . "/img/ads/468x60.png' alt='Ad' /></a>",
 			
 			'header_text'					=> '<em class="fa fa-heart"></em> Eat Well, Be Happy, Love Food',
			'footer_text'					=> '© Copyright Cookbook by <a href="http://www.themecanon.com" target="_blank">Theme Canon</a>',

			'toolbar_search_button'			=> 'checked',

			'countdown_datetime_string'		=> 'December 31, 2023 23:59:59',
			'countdown_gmt_offset'			=> '+10',
			'countdown_description'			=> 'Next Event: ',

			'social_in_new'					=> 'checked',
 			'social_links'					=> array(
 				'0' => array('fa-facebook-square','https://www.facebook.com/themecanon'),
 				'1' => array('fa-twitter-square','https://twitter.com/ThemeCanon'),
 				'2' => array('fa-rss-square', get_bloginfo('rss2_url')),
 			),

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