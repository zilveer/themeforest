<?php

/****************************************************
DESCRIPTION: 	GENERAL OPTIONS
OPTION HANDLE: 	INSPIRE_OPTIONS
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_INSPIRE_OPTIONS');

	function register_INSPIRE_OPTIONS () {
		global $screen_handle_INSPIRE_OPTIONS;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		$screen_handle_INSPIRE_OPTIONS = add_menu_page(
			'INSPIRE SETTINGS', 					//page title (appears in the browser title area / on the tab)
			'INSPIRE', 								//on screen name of options page (appears in left-hand menu)
			'manage_options', 						//capability (user-level) minimum level for access to this page.
			'handle_INSPIRE_OPTIONS',				//handle of this options page
			'display_TEMPLATE_OPTIONS', 			//the function / callback that runs the whole admin page
			'',										//optional icon url 16x16px
			200										//optional position in the menu. The higher the number the lower down on the menu list it appears.
		);

		// Use this instad if submenu
		// $screen_handle_INSPIRE_OPTIONS = add_submenu_page(
		// 	'handle_PARENT_OPTIONS',				//the handle of the parent options page. 
		// 	'Homepage Settings',					//the submenu title that will appear in browser title area.
		// 	'Homepage',								//the on screen name of the submenu
		// 	'manage_options',						//privileges check
		// 	'handle_INSPIRE_OPTIONS',				//the handle of this submenu
		// 	'display_INSPIRE_OPTIONS'				//the callback function to display the actual submenu page content.
		// );

		//changing the name of the first submenu which has duplicate name (there are global variables $menu and $submenu which can be used. var_dump them to see content)
		// Put this in the submenu controller. NB: Not in the first add_menu_page controller, but in the first submenu controller with add_submenu_page. It is not defined until then. 
		//global $submenu;	
		//$submenu['handle_INSPIRE_OPTIONS'][0][0] = "General";

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_INSPIRE_OPTIONS');	
	
	function init_INSPIRE_OPTIONS () {
		register_setting(
			'group_INSPIRE_OPTIONS',				//group name. The group for the fields custom_options_group
			'INSPIRE_OPTIONS',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_INSPIRE_OPTIONS'				//optional 3rd param. Callback /function to sanitize and validate
		);

		//if this is first runthrough set default values
		if (get_option('INSPIRE_OPTIONS') == FALSE) {		//trying to get options 'INSPIRE_OPTIONS' which doesn't yet exist results in FALSE
		 	$options = array (

			 		'reset_all'					=> '',
		 			'header_banner_code' 		=> '',
		 			'show_header_banner' 		=> 'checked'
				);

			update_option('INSPIRE_OPTIONS', $options);
		}
	}


	/****************************************************
	CONTEXTUAL HELP (REMOVE IF UNUSED, UNCOMMENT IF USED)
	****************************************************/

	// add_action('load-'.$screen_handle_INSPIRE_OPTIONS, 'add_help_INSPIRE_OPTIONS');		

	//register tabs in contextual help
	function add_help_INSPIRE_OPTIONS() {					//adds a contextual help menu for the screen with the $custom_admin_menu_screen_handle
		$screen = get_current_screen();

		$screen->add_help_tab( array( 
		   'id' => 'inspire_help',            		//unique id for the tab
		   'title' => 'General',      						//unique visible title for the tab
			'callback' => 'display_help'			//optional function to callback
		) );

		$screen->add_help_tab( array( 
		   'id' => 'inspire_help_accounts',            		//unique id for the tab
		   'title' => 'Accounts',      						//unique visible title for the tab
			'callback' => 'display_help_accounts'			//optional function to callback
		) );

		$screen->add_help_tab( array( 
		   'id' => 'inspire_help_footer',            		//unique id for the tab
		   'title' => 'Footer',      						//unique visible title for the tab
			'callback' => 'display_help_footer'			//optional function to callback
		) );
	}

	//display context help
	function display_help () {
		require "help/contextual_help.php";
	}

	function display_help_accounts () {
		require "help/contextual_help_accounts.php";
	}

	function display_help_footer () {
		require "help/contextual_help_footer.php";
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_INSPIRE_OPTIONS ($new_instance) {				
		$old_instance = get_option('INSPIRE_OPTIONS');
		if ($new_instance['main_fb_page'] != $old_instance['main_fb_page']) delete_transient('facebook_count');
		if ($new_instance['main_twitter_screen_name'] != $old_instance['main_twitter_screen_name']) delete_transient('twitter_count');
		if ($new_instance['main_feedburner_account'] != $old_instance['main_feedburner_account']) delete_transient('rss_count');

		return $new_instance;
	}

	//display the menus
	function display_TEMPLATE_OPTIONS () {
		require "TEMPLATE_OPTIONS.php";
	}