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
			
			'color_body'						=> '#f1f1f1',
			'color_plate'						=> '#ffffff',
			'color_general_text'				=> '#3d4942',
			'color_links'						=> '#3d4942',
			'color_links_hover'					=> '#ffba00',
			'color_headings'					=> '#004720',
			'color_text_2'						=> '#1c2721',
			'color_text_3'						=> '#bdbdbd',
			'color_text_logo'					=> '#ffffff',
			'color_feat_text_1'					=> '#14934d',
			'color_feat_text_2'					=> '#ffba00',
			'color_white_text'					=> '#ffffff',
			'color_preheader_bg'				=> '#1c2721',
			'color_preheader'					=> '#ffffff',
			'color_preheader_hover'				=> '#ffba00',
			'color_header_bg'					=> '#00632c',
			'color_header'						=> '#ffffff',
			'color_header_hover'				=> '#ffba00',
			'color_postheader_bg'				=> '#004720',
			'color_postheader'					=> '#ffffff',
			'color_postheader_hover'			=> '#ffba00',
			'color_third_prenav'				=> '#003919',
			'color_third_nav'					=> '#003919',
			'color_third_postnav'				=> '#003919',
			'color_sidr_bg'						=> '#1c2721',
			'color_sidr'						=> '#ffffff',
			'color_sidr_hover'					=> '#ffba00',
			'color_sidr_line'					=> '#2d3a33',
			
			'color_btn_1_bg'					=> '#00632c',
			'color_btn_1_hover_bg'				=> '#1c2721',
			'color_btn_1'						=> '#ffffff',
			'color_btn_2_bg'					=> '#ffba00',
			'color_btn_2_hover_bg'				=> '#00632c',
			'color_btn_2'						=> '#ffffff',
			'color_btn_3_bg'					=> '#eaeaea',
			'color_btn_3_hover_bg'				=> '#ffba00',
			'color_btn_3'						=> '#505a54',
			'color_feat_block_1'				=> '#f4f4f4',
			'color_feat_block_2'				=> '#ececec',
			'color_lite_block'					=> '#f7f7f7',
			'color_form_fields_bg'				=> '#f2f2f2',
			'color_form_fields_text'			=> '#969ca5',
			'color_lines'						=> '#eaeaea',
			'color_footer_block'				=> '#004720',
			'color_footer_headings'				=> '#ffffff',
			'color_footer_text'					=> '#f0f6f3',
			'color_footer_text_hover'			=> '#ffba00',
			'color_footlines'					=> '#255f3f',
			'color_footer_button'				=> '#ffba00',
			'color_footer_form_fields_bg'		=> '#003919',
			'color_footer_form_fields_text'		=> '#f0f6f3',
			'color_footer_alt_block'			=> '#1c2721',
			'color_footer_base'					=> '#1c2721',
			'color_footer_base_text'			=> '#ffffff',
			'color_footer_base_text_hover'		=> '#ffba00',
			

			'bg_img_url'						=> '',
			'bg_link'							=> '',
			'bg_repeat'							=> 'repeat',
			'bg_attachment'						=> 'fixed',

			'lightbox_overlay_color'			=> '#000000',
			'lightbox_overlay_opacity'			=> '0.7',

		 	'font_main'        					=> array('canon_default','',''),				 	
		 	'font_quote'        				=> array('canon_default','',''),
		 	'font_lead'        				=> array('canon_default','',''),
		 	'font_logotext'	        			=> array('canon_default','',''),
		 	'font_bold'        					=> array('canon_default','',''),
		 	'font_button'      					=> array('canon_default','',''),
		 	'font_italic'        				=> array('canon_default','',''),
		 	'font_heading'        				=> array('canon_default','',''),
		 	'font_heading2'        				=> array('canon_default','',''),
		 	'font_nav'        					=> array('canon_default','',''),
		 	'font_widget_footer'				=> array('canon_default','',''),

			'anim_img_slider_slideshow'			=> 'unchecked',
			'anim_img_slider_delay'				=> '5000',
			'anim_img_slider_anim_duration'		=> '800',
			'anim_quote_slider_slideshow'		=> 'unchecked',
			'anim_quote_slider_delay'			=> '5000',
			'anim_quote_slider_anim_duration'	=> '800',
			'anim_menu_slider_slideshow'		=> 'unchecked',
			'anim_menu_slider_delay'			=> '5000',
			'anim_menu_slider_anim_duration'	=> '800',

			'lazy_load_on_pagebuilder_blocks'	=> 'checked',
			'lazy_load_on_blog'					=> 'checked',
			'lazy_load_on_widgets'				=> 'checked',
			'lazy_load_after'					=> 0.3,
			'lazy_load_enter'					=> 'bottom',
			'lazy_load_move'					=> 24,
			'lazy_load_over'					=> 0.56,
			'lazy_load_viewport_factor'			=> 0.2,

			'anim_menus'						=> '.nav',
			'anim_menus_enter'					=> 'left',
			'anim_menus_move'					=> 40,
			'anim_menus_duration'				=> 600,
			'anim_menus_delay'					=> 150,

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