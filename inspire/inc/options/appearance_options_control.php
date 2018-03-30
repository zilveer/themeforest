<?php

/****************************************************
DESCRIPTION: 	APPEARANCE OPTIONS
OPTION HANDLE: 	inspire_options_appearance
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_inspire_options_appearance');

	function register_inspire_options_appearance () {
		global $screen_handle_inspire_options_appearance;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_inspire_options_appearance = add_submenu_page(
			'handle_inspire_options',							//the handle of the parent options page. 
			'Appearance Settings',								//the submenu title that will appear in browser title area.
			'Appearance',											//the on screen name of the submenu
			'manage_options',									//privileges check
			'handle_inspire_options_appearance',				//the handle of this submenu
			'display_inspire_options_appearance'				//the callback function to display the actual submenu page content.
		);
	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_inspire_options_appearance');	
	
	function init_inspire_options_appearance () {
		register_setting(
			'group_inspire_options_appearance',				//group name. The group for the fields custom_options_group
			'inspire_options_appearance',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_inspire_options_appearance'				//optional 3rd param. Callback /function to sanitize and validate
		);

		//if this is first runthrough set default values
		if (get_option('inspire_options_appearance') == FALSE) {		//trying to get options 'inspire_options_appearance' which doesn't yet exist results in FALSE
		 	$options = array (

		 			'grayscale'								=> 'grayscale',
		 			'color_main' 							=> '#d71a06',
		 			'color_bg' 								=> '#ffffff',
				 	'lightbox_overlay_opacity'				=> '0.7',
				 	'color_lightbox_overlay'				=> '#000000',
		 			
		 			'bg_link'								=> '',

		 			'font_main'								=> array('inspire_default','regular','latin'),
		 			'font_secondary'						=> array('inspire_default','regular','latin'),

				 	'anim_loadposts_fade_speed'				=> 2000,
				 	'anim_loadposts_fade_outspeed'			=> 1000,
				 	'anim_loadposts_async_speed'			=> 900,
				 	'anim_loadposts_async_outspeed'			=> 900,
				 	'anim_loadposts_async_container_speed'	=> 1000,
				 	'anim_loadposts_async_max_delay'		=> 900,
				 	'anim_postslider_slideshow_speed'		=> 7000,
				 	'anim_postslider_anim_speed'			=> 600,
				);

			update_option('inspire_options_appearance', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_inspire_options_appearance ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_inspire_options_appearance () {
		require "appearance_options.php";
	}