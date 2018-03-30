<?php

/****************************************************
DESCRIPTION: 	HOOKS OPTIONS
OPTION HANDLE: 	inspire_options_hooks
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_inspire_options_hooks');

	function register_inspire_options_hooks () {
		global $screen_handle_inspire_options_hooks;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)


		// Use this instad if submenu
		$screen_handle_inspire_options_hooks = add_submenu_page(
			'handle_inspire_options',					//the handle of the parent options page. 
			'Hooks Settings',							//the submenu title that will appear in browser title area.
			'Hooks',									//the on screen name of the submenu
			'manage_options',							//privileges check
			'handle_inspire_options_hooks',				//the handle of this submenu
			'display_hooks_options'				//the callback function to display the actual submenu page content.
		);

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_inspire_options_hooks');	
	
	function init_inspire_options_hooks () {
		register_setting(
			'group_inspire_options_hooks',				//group name. The group for the fields custom_options_group
			'inspire_options_hooks',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_inspire_options_hooks'				//optional 3rd param. Callback /function to sanitize and validate
		);

		//if this is first runthrough set default values
		if (get_option('inspire_options_hooks') == FALSE) {		//trying to get options 'inspire_options_hooks' which doesn't yet exist results in FALSE
		 	$options = array (
		 			// 'show_header_banner' 		=> 'checked'
				);

			update_option('inspire_options_hooks', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_inspire_options_hooks ($new_instance) {				
		//$old_instance = get_option('inspire_options_hooks');
		return $new_instance;
	}

	//display the menus
	function display_hooks_options () {
		require "hooks_options.php";
	}