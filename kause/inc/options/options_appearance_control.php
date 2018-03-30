<?php

/****************************************************
DESCRIPTION: 	GENERAL OPTIONS
OPTION HANDLE: 	canon_options_appearance
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_appearance');

	function register_canon_options_appearance () {
		global $screen_handle_canon_options_appearance;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_canon_options_appearance = add_submenu_page(
			'handle_canon_options',							//the handle of the parent options page. 
			'Appearance Settings',							//the submenu title that will appear in browser title area.
			'Appearance',									//the on screen name of the submenu
			'manage_options',								//privileges check
			'handle_canon_options_appearance',				//the handle of this submenu
			'display_options_appearance'					//the callback function to display the actual submenu page content.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_appearance');	
	
	function init_canon_options_appearance () {
		register_setting(
			'group_canon_options_appearance',				//group name. The group for the fields custom_options_group
			'canon_options_appearance',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_appearance'				//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options_appearance');	

	function default_canon_options_appearance () {

	 	// SET DEFAULTS
	 	$default_options = array (

	 		'body_skin_class'					=> '',

	 		'color_feature_1'					=> '#4ec6e9',
	 		'color_feature_2'					=> '#ff6666',
	 		'color_plate'						=> '#fff',
	 		'color_body'						=> '#242931',
	 		'color_general_text'				=> '#4b525d',
	 		'color_headings'					=> '#2f353f',
	 		'color_white_text'					=> '#fff',
	 		'color_meta'						=> '#b2b8bd',

	 		'color_menu_nav'					=> '#ff6666',
	 		'color_header_nav'					=> '#2f353f',
	 		'color_third_nav'					=> '#242931',
	 		'color_feature_button'				=> '#ff6666',
	 		'color_feature_button_2'			=> '#4ec6e9',
	 		'color_feature_button_3'			=> '#7cbf09',
	 		'color_feature_button_4'			=> '#7cbf09',
	 		'color_feature_block'				=> '#4ec6e9',
	 		'color_feature_block_2'				=> '#e1f5fb',
	 		'color_light_button'				=> '#E8E8E8',
	 		'color_white_button'				=> '#ffffff',
	 		'color_dark_button'					=> '#344158',
	 		'color_form_fields_bg'				=> '#f2f2f2',
	 		'color_form_fields_text'			=> '#969ca5',
	 		'color_price_table'					=> '#f7f7f7',
	 		'color_elements'					=> '#fbfbfb',
	 		'color_lines'						=> '#eaeaea',
	 		
	 		'color_footer_block'				=> '#2f353f',
	 		'color_footer_base'					=> '#242931',
	 		'color_footer_headings'				=> '#808b9c',
	 		'color_footer_text'					=> '#808b9c',
	 		'color_footer_button'				=> '#4ec6e9',
	 		'color_footer_form_fields_bg'		=> '#828995',
	 		'color_footer_form_fields_text'		=> '#fff',
	 		'color_footer_form_fields_focus'	=> '#6d7482',
	 		'color_footlines'					=> '#4B525D', 
	 		'color_responsive_menu'				=> '#282D36',

			'bg_img_url'						=> '',
			'bg_link'							=> '',
			'bg_repeat'							=> 'repeat',
			'bg_attachment'						=> 'fixed',

			'lightbox_overlay_color'			=> '#000000',
			'lightbox_overlay_opacity'			=> '0.7',

		 	'font_main'        					=> array('canon_default','',''),				 	
		 	'font_quote'        				=> array('canon_default','',''),
		 	'font_logotext'	        			=> array('canon_default','',''),
		 	'font_bold'        					=> array('canon_default','',''),
		 	'font_button'      					=> array('canon_default','',''),
		 	'font_italic'        				=> array('canon_default','',''),
		 	'font_heading'        				=> array('canon_default','',''),
		 	'font_nav'        					=> array('canon_default','',''),
		 	'font_widget_footer'				=> array('canon_default','',''),

			'anim_img_slider_slideshow'			=> 'unchecked',
			'anim_img_slider_delay'				=> '5000',
			'anim_img_slider_anim_duration'		=> '800',
			'anim_quote_slider_slideshow'		=> 'unchecked',
			'anim_quote_slider_delay'			=> '5000',
			'anim_quote_slider_anim_duration'	=> '800',

		);

		// GET EXISTING OPTIONS IF ANY
		$canon_options_appearance = (get_option('canon_options_appearance')) ? get_option('canon_options_appearance') : array();

		// MERGE ARRAYS. EXISTING OPTIONS WILL OVERWRITE DEFAULTS.
		$canon_options_appearance = array_merge($default_options, $canon_options_appearance);

		// SAVE OPTIONS
		update_option('canon_options_appearance', $canon_options_appearance);

	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options_appearance ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_options_appearance () {
		require "options_appearance.php";
	}