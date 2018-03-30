<?php

/****************************************************
GENERAL OPTIONS
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_inspire_options');

	function register_inspire_options () {
		global $screen_handle_inspire_options;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		$screen_handle_inspire_options = add_menu_page(
			'Inspire settings', 					//page title (appears in the browser title area / on the tab)
			'Inspire settings', 					//on screen name of options page (appears in left-hand menu)
			'manage_options', 						//capability (user-level) minimum level for access to this page.
			'handle_inspire_options',				//handle of this options page
			'display_general_options', 				//the function / callback that runs the whole admin page
			'',										//optional icon url 16x16px
			200										//optional position in the menu. The higher the number the lower down on the menu list it appears.
		);

		//changing the name of the first submenu which has duplicate name (there are global variables $menu and $submenu which can be used. var_dump them to see content)
		// Put this in the main menu controller
		//global $submenu;	
		//var_dump($submenu);
		//$submenu['handle_inspire_options'][0][0] = "General";

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_inspire_options');	
	
	function init_inspire_options () {
		register_setting(
			'group_inspire_options',				//group name. The group for the fields custom_options_group
			'inspire_options',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_inspire_options'				//optional 3rd param. Callback /function to sanitize and validate
		);

		//if this is first runthrough set default values
		if (get_option('inspire_options') == FALSE) {		//trying to get options 'inspire_options' which doesn't yet exist results in FALSE
		 	$options = array (

		 			'reset_all'					=> '',
		 			'use_responsive_design'		=> 'checked',
		 			'social_icons_size'			=> 'small',
		 			'rss_url'					=> get_bloginfo('rss2_url'),
		 			'header_height'				=> 150,
		 			'pos_logo_top'				=> 61,
		 			'pos_logo_left'				=> 0,
		 			'pos_nav_top'				=> 67,
		 			'pos_nav_right'				=> 0,
		 			'archive_style'				=> 'classic',
					'load_posts_by'				=> 'button',
					'load_posts_animation'		=> 'fade',
					'to_top_style'				=> 'onoff',
					'search_box_default'		=> 'closed',
		 			'check_for_updates'			=> 'checked',
		 			'footer_layout'				=> 'text_footer',
		 			'footer_text_left' 			=> 'COPYRIGHT (C) 2013 - ALL RIGHTS RESERVED - BOOSTDEVELOPERS.COM',
		 			'footer_text_right' 		=> 'POWERED BY WORDPRESS, DEVELOPED BY BOOSTDEVELOPERS',
					'footer_shows'				=> 'random',
		 			'footer_default'			=> 'closed',
		 			'footer_num_posts'			=>	15,
		 			'footer_num_posts_scroll'	=>	5,
		 			'footer_autoscroll_sec'		=>	5,
		 			'footer_animation_speed'	=> 2000

				);

			update_option('inspire_options', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	function validate_inspire_options ($new_instance) {				

		return $new_instance;
	}

	//display the menus
	function display_general_options () {
		require "general_options.php";
	}