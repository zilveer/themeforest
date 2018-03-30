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
		global $screen_handle_canon_options_appearance;	  		//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_canon_options_appearance = add_submenu_page(
			'handle_canon_options',								//the handle of the parent options page. 
			__('Appearance Settings', 'loc_canon'),				//the submenu title that will appear in browser title area.
			__('Appearance', 'loc_canon'),						//the on screen name of the submenu
			'manage_options',									//privileges check
			'handle_canon_options_appearance',					//the handle of this submenu
			'display_options_appearance'						//the callback function to display the actual submenu page content.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_appearance');	
	
	function init_canon_options_appearance () {
		register_setting(
			'group_canon_options_appearance',					//group name. The group for the fields custom_options_group
			'canon_options_appearance',							//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_appearance'					//optional 3rd param. Callback /function to sanitize and validate
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
			
			'color_page_bg'						=> '#f1f1f1',
			'color_body_bg'						=> '#ffffff',
			'color_general_text'				=> '#222222',
	 		'color_body_link'					=> '#222222',
	 		'color_body_link_hover'				=> '#c3ad70',
	 		'color_body_headings'				=> '#222222',
	 		'color_general_text_2'				=> '#adadad',
			'color_logo_text'					=> '#222222',
			'color_prehead_bg'					=> '#4c565c',
			'color_prehead'						=> '#ffffff',
			'color_prehead_hover'				=> '#c3ad70',
			'color_third_prenav'				=> '#333d43',
			'color_head_bg'						=> '#ffffff',
			'color_head'						=> '#222222',
			'color_head_hover'					=> '#c3ad70',
			'color_header_menus_2nd'			=> '#fafafa',
			'color_header_menus'				=> '#f1f1f1',
			'color_posthead_bg'					=> '#1f272a',
			'color_posthead'					=> '#ffffff',
			'color_posthead_hover'				=> '#c3ad70',
			'color_third_postnav'				=> '#141312',
			'color_header_image'				=> '#ffffff',
			'color_sidr_block'					=> '#20272b',
			'color_menu_text_1'					=> '#ffffff',
			'color_block_headings'				=> '#20272b',
			'color_block_headings_2'			=> '#4c565c',
			'color_feat_text_1'					=> '#c3ad70',
			'color_quotes'						=> '#555f64',
			'color_white_text'					=> '#ffffff',
			'color_btn_1'						=> '#c3ad70',
			'color_btn_1_hover'					=> '#20272b',
			'color_block_light'					=> '#f6f6f6',
			'color_feat_title'					=> '#ffffff',
			'color_border_1'					=> '#2b363c',
			'color_border_2'					=> '#eaeaea',
			'color_forms_bg'					=> '#f4f4f4',
			'color_prefoot_bg'					=> '#eaeaea',
			'color_prefoot'						=> '#28292c',
			'color_prefoot_hover'				=> '#c3ad70',
			'color_foot_bg'						=> '#272f33',
			'color_foot'						=> '#ffffff',
			'color_foot_hover'					=> '#c3ad70',
			'color_foot_2'						=> '#ffffff',
			'color_border_3'					=> '#2b363c',
			'color_foot_bg_2'					=> '#3a464c',
			'color_baseline_bg'					=> '#171e20',
			'color_baseline'					=> '#b6b6b6',
			'color_baseline_hover'				=> '#c3ad70',


			'bg_img_url'						=> '',
			'bg_link'							=> '',
			'bg_repeat'							=> 'repeat',
			'bg_attachment'						=> 'fixed',


			'lightbox_overlay_color'			=> '#000000',
			'lightbox_overlay_opacity'			=> '0.7',


		 	'font_main'        					=> array('canon_default','',''),				 	
		 	'font_headings'        				=> array('canon_default','',''),
		 	'font_nav'        					=> array('canon_default','',''),
		 	'font_headings_meta'   				=> array('canon_default','',''),
		 	'font_bold'		   					=> array('canon_default','',''),
		 	'font_italic'	   					=> array('canon_default','',''),
		 	'font_strong'	   					=> array('canon_default','',''),
		 	'font_logo'		   					=> array('canon_default','',''),

		 	'font_size_root'					=> 100,

			'anim_img_slider_slideshow'			=> 'unchecked',
			'anim_img_slider_delay'				=> '5000',
			'anim_img_slider_anim_duration'		=> '800',
			'anim_quote_slider_slideshow'		=> 'unchecked',
			'anim_quote_slider_delay'			=> '5000',
			'anim_quote_slider_anim_duration'	=> '800',

			'lazy_load_on_pagebuilder_elements'	=> 'unchecked',
			'lazy_load_on_archive_posts'		=> 'unchecked',
			'lazy_load_on_widgets'				=> 'unchecked',
			'lazy_load_after'					=> 0.3,
			'lazy_load_enter'					=> 'bottom',
			'lazy_load_move'					=> 24,
			'lazy_load_over'					=> 0.56,
			'lazy_load_viewport_factor'			=> 0.2,

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