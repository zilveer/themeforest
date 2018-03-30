<?php

/****************************************************
DESCRIPTION: 	POST OPTIONS
OPTION HANDLE: 	inspire_options_post
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_inspire_options_post');

	function register_inspire_options_post () {
		global $screen_handle_inspire_options_post;	  	//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_inspire_options_post = add_submenu_page(
			'handle_inspire_options',					//the handle of the parent options page. 
			'Post & Page Settings',							//the submenu title that will appear in browser title area.
			'Post & Page',										//the on screen name of the submenu
			'manage_options',							//privileges check
			'handle_inspire_options_post',				//the handle of this submenu
			'display_inspire_options_post'				//the callback function to display the actual submenu page content.
		);
	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_inspire_options_post');	
	
	function init_inspire_options_post () {
		register_setting(
			'group_inspire_options_post',				//group name. The group for the fields custom_options_group
			'inspire_options_post',						//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_inspire_options_post'				//optional 3rd param. Callback /function to sanitize and validate
		);

		//if this is first runthrough set default values
		if (get_option('inspire_options_post') == FALSE) {		//trying to get options 'inspire_options_post' which doesn't yet exist results in FALSE
		 	$options = array (

		 			'post_style' 					=> 'single',
		 			'show_featured' 				=> 'checked',
		 			'show_pagination' 				=> 'checked',
		 			'show_share' 					=> 'checked',
		 			'show_comments' 				=> 'checked',
		 			'share_buttons_closed_default'	=> 'checked',
					'page_show_byline'				=> 'checked',
					'page_show_share'				=> 'checked'
				);

			update_option('inspire_options_post', $options);
		}
	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_inspire_options_post ($new_instance) {				
		$old_instance = get_option('inspire_options_post');

		return $new_instance;
	}

	//display the menus
	function display_inspire_options_post () {
		require "post_options.php";
	}