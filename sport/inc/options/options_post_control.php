<?php

/****************************************************
DESCRIPTION: 	POST & PAGE OPTIONS
OPTION HANDLE: 	canon_options_post
****************************************************/


	/****************************************************
	REGISTER MENU
	****************************************************/

	add_action('admin_menu', 'register_canon_options_post');

	function register_canon_options_post () {
		global $screen_handle_canon_options_post;	  			//this is the SCREEN handle used to identify the new admin menu page (notice: different than the add_menu_page handle)

		// Use this instad if submenu
		$screen_handle_canon_options_post = add_submenu_page(
			'handle_canon_options',								//the handle of the parent options page. 
			__('Posts & Pages Settings', 'loc_canon'),			//the submenu title that will appear in browser title area.
			__('Posts & Pages', 'loc_canon'),					//the on screen name of the submenu
			'manage_options',									//privileges check
			'handle_canon_options_post',						//the handle of this submenu
			'display_options_post'								//the callback function to display the actual submenu page content.
		);

		//changing the name of the first submenu which has duplicate name (there are global variables $menu and $submenu which can be used. var_dump them to see content)
		// Put this in the submenu controller. NB: Not in the first add_menu_page controller, but in the first submenu controller with add_submenu_page. It is not defined until then. 
		// global $submenu;	
		// $submenu['handle_canon_options'][0][0] = __("General", "loc_canon");

	}

	/****************************************************
	INITIALIZE MENU
	****************************************************/

	add_action('admin_init', 'init_canon_options_post');	
	
	function init_canon_options_post () {
		register_setting(
			'group_canon_options_post',							//group name. The group for the fields custom_options_group
			'canon_options_post',								//the options variabel. THIS IS WEHERE YOUR OPTIONS ARE STORED.
			'validate_canon_options_post'						//optional 3rd param. Callback /function to sanitize and validate
		);
	}

	/****************************************************
	SET DEFAULTS
	****************************************************/

	add_action('after_setup_theme', 'default_canon_options_post');	

	function default_canon_options_post () {

	 	// SET DEFAULTS
	 	$default_options = array (

 			'show_tags' 				=> 'checked',
 			'show_post_nav' 			=> 'checked',
 			'post_nav_same_cat' 		=> 'unchecked',
 			'show_comments' 			=> 'checked',
 			
 			'show_person_position' 		=> 'checked',
 			'show_person_info' 			=> 'checked',
 			'show_person_nav' 			=> 'checked',
 			'person_nav_same_cat' 		=> 'unchecked',
 			
 			'show_meta_author' 			=> 'checked',
 			'show_meta_date' 			=> 'checked',
 			'show_meta_comments' 		=> 'checked',


 			'homepage_blog_style'		=> 'full',
 			'blog_style'				=> 'full',
 			'cat_style'					=> 'full',
 			'archive_excerpt_length'	=>	325,
 			'show_cat_title'			=> 'unchecked',
 			'show_cat_description'		=> 'unchecked',

	 		'search_box_text'			=> __('What are you looking for?', "loc_canon"),
	 		'search_posts'				=> 'checked',
	 		'search_pages'				=> 'unchecked',
	 		'search_cpt'				=> 'unchecked',
	 		'search_cpt_source'			=> 'cpt_people, cpt_project',


	 		'404_title'					=> __('Page not found', "loc_canon"),
	 		'404_msg'					=> __("Sorry, you're lost my friend, the page you're looking for does not exist anymore. Take your luck at searching for a new one.", "loc_canon"),
			
			'use_woocommerce_sidebar'	=> 'checked',
			'woocommerce_sidebar'		=> 'canon_woocommerce_widget_area',

			'use_buddypress_sidebar'	=> 'checked',
			'buddypress_sidebar'		=> 'canon_buddypress_widget_area',

			'use_bbpress_sidebar'		=> 'checked',
			'bbpress_sidebar'			=> 'canon_bbpress_widget_area',

			'use_events_sidebar'		=> 'checked',
			'events_sidebar'			=> 'canon_events_widget_area',

		);

		// GET EXISTING OPTIONS IF ANY
		$canon_options_post = (get_option('canon_options_post')) ? get_option('canon_options_post') : array();

		// MERGE ARRAYS. EXISTING OPTIONS WILL OVERWRITE DEFAULTS.
		$canon_options_post = array_merge($default_options, $canon_options_post);

		// SAVE OPTIONS
		update_option('canon_options_post', $canon_options_post);

	}


	/****************************************************
	VALIDATE INPUT AND DISPLAY MENU
	****************************************************/

	//remember this will strip all html php tags, strip slashes and convert quotation marks. This is not always what you want (maybe you want a field for HTML?) why you might want to modify this part.	
	function validate_canon_options_post ($new_instance) {				
		return $new_instance;
	}

	//display the menus
	function display_options_post () {
		require "options_post.php";
	}