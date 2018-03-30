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

 			'blog_layout'					=> 'sidebar',
			'blog_sidebar'					=> 'canon_archive_sidebar_widget_area',
 			'blog_style'					=> 'classic',
 			'blog_excerpt_length'			=> 500,
 			'blog_masonry_columns'			=> 2,

 			'cat_layout'					=> 'sidebar',
			'cat_sidebar'					=> 'canon_archive_sidebar_widget_area',
 			'cat_style'						=> 'classic',
 			'cat_excerpt_length'			=> 500,
 			'cat_masonry_columns'			=> 2,

 			'archive_layout'				=> 'sidebar',
			'archive_sidebar'				=> 'canon_archive_sidebar_widget_area',
 			'archive_style'					=> 'classic',
 			'archive_excerpt_length'		=> 500,
 			'archive_masonry_columns'		=> 2,

 			'show_archive_title'			=> 'checked',
 			'show_cat_description'			=> 'checked',
 			'show_archive_author_box'		=> 'checked',
 			
 			'show_meta_date' 				=> 'checked',
 			'show_meta_comments' 			=> 'checked',

 			'show_post_meta' 				=> 'checked',
 			'show_post_nav' 				=> 'checked',
 			'show_comments' 				=> 'checked',

	 		'search_box_text'				=> __('What are you looking for?', "loc_canon"),
	 		'search_posts'					=> 'checked',
	 		'search_pages'					=> 'unchecked',
	 		'search_cpt'					=> 'unchecked',
	 		'search_cpt_source'				=> '',

 			'404_layout'					=> 'sidebar',
			'404_sidebar'					=> 'canon_archive_sidebar_widget_area',
	 		'404_title'						=> __('Error 404 Page', "loc_canon"),
	 		'404_msg'						=> __("Sorry, It seems we can't find what you're looking for. Perhaps searching can help.", "loc_canon"),

	 		'archive_ads'					=> array(
	 			0								=> array(
	 				'append_to_posts'				=> '3, 10',
	 				'ad_code'						=> '<a href="#" class="ads col-1-2">
<img src="'. get_template_directory_uri() .'/img/ads/468x60.png" alt="Ads" />
</a>
				
<a href="#" class="ads col-1-2 last">
<img src="'. get_template_directory_uri() .'/img/ads/468x60.png" alt="Ads" />
</a>',
					'show_ads_blog'					=> 'unchecked',
					'show_ads_category'				=> 'unchecked',
					'show_ads_archive'				=> 'unchecked',
	 			),
	 			1								=> array(
	 				'append_to_posts'				=> '3, 10',
	 				'ad_code'						=> '<a href="#" class="ads col-1-1">
<img src="'. get_template_directory_uri() .'/img/ads/468x60.png" alt="Ads" />
</a>',
					'show_ads_blog'					=> 'unchecked',
					'show_ads_category'				=> 'unchecked',
					'show_ads_archive'				=> 'unchecked',
	 			),
			),
			
			'use_woocommerce_sidebar'		=> 'checked',
			'woocommerce_sidebar'			=> 'canon_archive_sidebar_widget_area',

			'use_buddypress_sidebar'		=> 'checked',
			'buddypress_sidebar'			=> 'canon_archive_sidebar_widget_area',

			'use_bbpress_sidebar'			=> 'checked',
			'bbpress_sidebar'				=> 'canon_archive_sidebar_widget_area',

			'use_events_sidebar'			=> 'checked',
			'events_sidebar'				=> 'canon_archive_sidebar_widget_area',

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