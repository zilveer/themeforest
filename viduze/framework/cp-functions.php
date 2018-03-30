<?php

	/*	
	*	Crunchpress Function Registered File
	*	---------------------------------------------------------------------
	* 	@version	1.0
	* 	@author		Crunchpress
	* 	@link		http://crunchpress.com
	* 	@copyright	Copyright (c) Crunchpress
	*	---------------------------------------------------------------------
	*	This file use to register the wordpress function to the framework,
	*	and also use filter to hook some necessary events.
	*	---------------------------------------------------------------------
	*/
	
	// enable and register custom sidebar
	if ( function_exists('register_sidebar')){	
	
		// default sidebar array
		$sidebar_attr = array(
			'name' => '',
			'before_widget' => '',
			'after_widget' => '</div>',
			'before_title' => '<header class="header-style"><h2 class="h-style">',
			'after_title' => '</h2></header><div class="widget-bg">'
		);
		
		
	    $sidebar_id = 0;
		$cp_sidebar = array("Footer 1", "Footer 2", "Footer 3", "Footer 4", );
		$sidebar_attr['before_title'] = '<header class="header-style"><h2 class="h-style">';
		$sidebar_attr['after_title'] = '</h2></header>';
		$sidebar_attr['before_widget'] = '<div class="footer-widget">';
		$sidebar_attr['after_widget'] = '</div>';
		
		foreach( $cp_sidebar as $sidebar_name ){
			$sidebar_attr['name'] = $sidebar_name;
			$sidebar_slug = strtolower(str_replace(' ','-',$sidebar_name));
			$sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
			$sidebar_attr['description'] = 'Please place widget here' ;
			register_sidebar($sidebar_attr);
		 }

		
		$cp_sidebar = array("Shop Left Sidebar", "Shop Right Sidebar", "Buddypress Left Sidebar", "Buddypress Right Sidebar", "Search-Archive Left Sidebar", "Search-Archive Right Sidebar");
		$sidebar_attr['before_title'] = '<header class="header-style"><h2 class="h-style">';
		$sidebar_attr['after_title'] = '</h2></header><div class="widget-bg">';
		foreach( $cp_sidebar as $sidebar_name ){
			$sidebar_attr['name'] = $sidebar_name;
			$sidebar_slug = strtolower(str_replace(' ','-',$sidebar_name));
			$sidebar_attr['id'] = 'sidebar-' . $sidebar_slug ;
			$sidebar_attr['description'] = 'Please place widget here' ;
			register_sidebar($sidebar_attr);
		}
		
		
		$cp_sidebar = get_option( THEME_NAME_S.'_create_sidebar' );
		$sidebar_attr['before_title'] = '<header class="header-style"><h2 class="h-style">';
		$sidebar_attr['after_title'] = '</h2></header><div class="widget-bg">';
		
		if(!empty($cp_sidebar)){
			$xml = new DOMDocument();
			$xml->loadXML($cp_sidebar);
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
	
	// enable editor style
	//add_editor_style('custom-editor-style.css');
	
	
	
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
	add_action('init', 'cp_word_translation');
	function cp_word_translation(){
		
		global $cp_admin_translator;
		
		if( $cp_admin_translator == 'disable' ){
			load_theme_textdomain( 'crunchpress', get_template_directory() . '/languages/' );
			load_theme_textdomain( 'cp_front_end', get_template_directory() . '/languages/' );
		}
		
	}

	// excerpt filter
	add_filter('excerpt_length','cp_excerpt_length');
	function cp_excerpt_length(){
		return 1000;
	}
	
	// Google Analytics
	$cp_enable_analytics = get_option(THEME_NAME_S.'_enable_analytics','disable');
	if( $cp_enable_analytics == 'enable' ){
		add_action('wp_footer', 'add_google_analytics_code');
	}
	function add_google_analytics_code(){
		
		echo get_option(THEME_NAME_S.'_analytics_code','');
	
	}
	
	// Custom Post type Feed
	add_filter('request', 'myfeed_request');
	function myfeed_request($qv) {
		if (isset($qv['feed']) && !isset($qv['post_type']))
		$qv['post_type'] = array('post', 'portfolio');
		return $qv;
	}

	// Translate the wpml shortcode
	// [wpml_translate lang=es]LANG 1[/wpml_translate]
	// [wpml_translate lang=en]LANG 2[/wpml_translate]

	function webtreats_lang_test( $atts, $content = null ) {
		extract(shortcode_atts(array( 'lang' => '' ), $atts));
		
		$lang_active = ICL_LANGUAGE_CODE;
		
		if($lang == $lang_active){
			return $content;
		}
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
	
	// Add Another theme support
	add_filter('widget_text', 'do_shortcode');
	add_theme_support( 'automatic-feed-links' );	
	
	if ( ! isset( $content_width ) ){ $content_width = 980; }
	
	/* Flush rewrite rules for custom post types. */
	add_action( 'load-themes.php', 'cp_flush_rewrite_rules' );
	function cp_flush_rewrite_rules() {
		global $pagenow, $wp_rewrite;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) )
			$wp_rewrite->flush_rules();
	}

   //Funtion to display feedburner subscription in footer
		
	function themeple_ajax_dummy_data(){
			require_once TH_FW_BE_SER . '/extensions/importer/dummy_data.inc.php';
			die('themeple_dummy');
	}
		add_action('wp_ajax_themeple_ajax_dummy_data', 'themeple_ajax_dummy_data');
		
   // Display Missing Plugin Message
	function miss_plugin_msg(){	
   		echo __('<div class="error-msg"><p>'.'Error: This Element Requires Cp Custom Posts Plugin.'.'</p></div>','crunchpress');
	}