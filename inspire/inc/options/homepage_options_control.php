<?php

/****************************************************
DESCRIPTION: 	HOMEPAGE OPTIONS
OPTION HANDLE: 	inspire_options_hp
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_inspire_options_hp');

	function register_inspire_options_hp () {
		global $screen_handle_inspire_options_hp;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_inspire_options_hp = add_submenu_page(
			'handle_inspire_options',					//the handle of the parent options page
			'Homepage Settings',						//the submenu title that will appear in browser title area.
			'Homepage',									//the on screen name of the submenu
			'manage_options',							//privileges check
			'handle_inspire_options_hp',				//the handle of this submenu
			'display_inspire_options_hp'				//the callback function to display the actual submenu page content.
		);

		//changing the name of the first submenu
		global $submenu;	
		$submenu['handle_inspire_options'][0][0] = "General";

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_inspire_options_hp');	
	
	function init_inspire_options_hp () {
		register_setting(
			'group_inspire_options_hp',					//group name. The group for the fields custom_options_group
			'inspire_options_hp',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_inspire_options_hp'				//optional 3rd param. Callback /function to sanitize and validate
		);

		//if this is first runthrough set default values
		if (get_option('inspire_options_hp') == FALSE) {		//trying to get options 'inspire_options_hp' which doesn't yet exist results in FALSE
		 	$options = array (

		 			'hp_style' 					=> '4-column',
		 			'show_slider' 				=> 'checked',
		 			'subfilter_show_latest' 	=> 'checked',
		 			'subfilter_show_likes' 		=> 'checked',
		 			'subfilter_show_comments' 	=> 'checked',
		 			'subfilter_show_random' 	=> 'checked',
				);

			update_option('inspire_options_hp', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	function validate_inspire_options_hp ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_inspire_options_hp () {
		require "homepage_options.php";
	}