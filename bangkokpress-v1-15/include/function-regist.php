<?php

	/*	
	*	Goodlayers Function Registered File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Goodlayers
	* 	@link		http://goodlayers.com
	* 	@copyright	Copyright (c) Goodlayers
	*	---------------------------------------------------------------------
	*	This file use to register the wordpress function to the framework,
	*	and also use filter to hook some necessary events.
	*	---------------------------------------------------------------------
	*/

	// enable and register custom sidebar
	if (function_exists('register_sidebar')){	
	
		// default sidebar array
		$sidebar_attr = array(
			'name' => '',
			'before_widget' => '<div class="custom-sidebar gdl-divider">',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="custom-sidebar-title">',
			'after_title' => '</h3>'
		);
		
		// Footer widget
		$sidebar_id = 0;
		$gdl_sidebar = array("Footer 1", "Footer 2", "Footer 3", "Footer 4");
		$sidebar_attr['before_title'] = '<h3 class="custom-sidebar-title footer-title-color gdl-title">';
		
		foreach( $gdl_sidebar as $sidebar_name ){
			$sidebar_attr['name'] = $sidebar_name;
			$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
			register_sidebar($sidebar_attr);
		}
		
		// Sitemap widget
		$gdl_sidebar = array("Site Map 1", "Site Map 2", "Site Map 3", "Search/Archive Left Sidebar", "Search/Archive Right Sidebar");
		$sidebar_attr['before_title'] = '<div class="sidebar-header-wrapper"><h3 class="sidebar-header-title title-color gdl-title">';
		$sidebar_attr['after_title'] = '</h3><div class="sidebar-header-gimmick mr0"></div><div class="clear"></div></div><div class="bkp-frame-wrapper"><div class="bkp-frame sidebar-padding gdl-divider">';
		$sidebar_attr['before_widget'] = '<div class="custom-sidebar">';
		$sidebar_attr['after_widget'] = '</div></div></div>';
		
		foreach( $gdl_sidebar as $sidebar_name ){
			$sidebar_attr['name'] = $sidebar_name;
			$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
			register_sidebar($sidebar_attr);
		}
		
		$gdl_sidebar = get_option( THEME_SHORT_NAME.'_create_sidebar' );
		
		if(!empty($gdl_sidebar)){
			$xml = new DOMDocument();
			$xml->loadXML($gdl_sidebar);
			foreach( $xml->documentElement->childNodes as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name->nodeValue;
				$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
				register_sidebar($sidebar_attr);
			}
		}
		
	}
	
	// enable featured image
	if(function_exists('add_theme_support')){
	
		add_theme_support('post-thumbnails');
		
	}
	
	// enable navigation menu
	if(function_exists('add_theme_support')){
	
		add_theme_support('menus');
		register_nav_menus(array('main_menu' =>'Main Navigation Menu', 'top_menu' => 'Top Navigation Menu'));
		
	}
	
	// add filter to hook when user press "insert into post" to include the attachment id
	add_filter('media_send_to_editor', 'add_para_media_to_editor', 20, 2);
	function add_para_media_to_editor($html, $id){

		if(strpos($html, 'href')){
			$pos = strpos($html, '<a') + 2;
			$html = substr($html, 0, $pos) . ' attid="' . $id . '" ' . substr($html, $pos);
		}
		
		return $html ;
		
	}
	
	// enable theme to support the localization
	add_action('init', 'gdl_word_translation');
	function gdl_word_translation(){
		
		global $gdl_admin_translator;
		
		if( $gdl_admin_translator == 'disable' ){
			load_theme_textdomain( 'gdl_back_office', TEMPLATEPATH . '/include/languages/' );
			load_theme_textdomain( 'gdl_front_end', TEMPLATEPATH . '/include/languages/' );
		}
		
	}

	// excerpt filter
	add_filter('excerpt_length','gdl_excerpt_length');
	function gdl_excerpt_length(){
		return 1000;
	}
	
	// Google Analytics
	$gdl_enable_analytics = get_option(THEME_SHORT_NAME.'_enable_analytics','disable');
	if( $gdl_enable_analytics == 'enable' ){
		add_action('wp_head', 'add_google_analytics_code');
	}
	function add_google_analytics_code(){
		
		echo get_option(THEME_SHORT_NAME.'_analytics_code','');
	
	}
	
	// Custom Post type Feed
	add_filter('request', 'myfeed_request');
	function myfeed_request($qv) {
		if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'portfolio');
		return $qv;
	}
	
	//Get custom post type shown in archive
	/* function include_custom_post_types( $query ) { 
		global $wp_query;
		if ( is_category() || is_tag() || is_date()	) {
			$query->set( 'post_type' , 'portfolio' );
		}
		return $query;
	}
	add_filter( 'pre_get_posts' , 'include_custom_post_types' ); */
	
	add_filter('widget_text', 'do_shortcode');
	
	/* Flush rewrite rules for custom post types. */
	add_action( 'load-themes.php', 'gdl_flush_rewrite_rules' );
	function gdl_flush_rewrite_rules() {
		global $pagenow, $wp_rewrite;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
			$wp_rewrite->flush_rules();
	}	
	
?>