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

	// Include the shortcode support for the text widget
	add_filter('widget_text', 'do_shortcode');
	
	// Add support to post and comment RSS feed links to head
	add_theme_support( 'automatic-feed-links' );	
	
	// Set the max content width
	if ( ! isset( $content_width ) ){ $content_width = 960; }		
	
	// enable featured image
	if(function_exists('add_theme_support')){
		add_theme_support('post-thumbnails');
	}
	
	// enable navigation menu
	if(function_exists('add_theme_support')){
		add_theme_support('menus');
		register_nav_menus(array('main_menu' =>'Main Navigation Menu'));
	}	
	
	// Enable and register custom sidebar
	if (function_exists('register_sidebar')){	
	
		// default sidebar array
		$sidebar_attr = array(
			'name' => '',
			'before_widget' => '<div class="custom-sidebar %2$s" id="%1$s" >',
			'after_widget' => '</div>',
			'before_title' => '<h3 class="custom-sidebar-title">',
			'after_title' => '</h3>'
		);
		
		$sidebar_id = 0;
		$gdl_sidebar = array("Footer 1", "Footer 2", "Footer 3", "Footer 4");
		
		foreach( $gdl_sidebar as $sidebar_name ){
			$sidebar_attr['name'] = $sidebar_name;
			//$sidebar_attr['id'] = sanitize_title('gdl-' . $sidebar_name);
			$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
			register_sidebar($sidebar_attr);
		}

		$gdl_sidebar = array("Site Map 1", "Site Map 2", "Site Map 3");
		$sidebar_attr['before_title'] = '<div class="custom-sidebar-title-wrapper"><h3 class="custom-sidebar-title gdl-border-x bottom">';
		$sidebar_attr['after_title'] = '</h3></div>';		
		
		foreach( $gdl_sidebar as $sidebar_name ){
			$sidebar_attr['name'] = $sidebar_name;
			//$sidebar_attr['id'] = sanitize_title($sidebar_name);
			$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
			register_sidebar($sidebar_attr);
		}
		
		$gdl_sidebar = get_option( THEME_SHORT_NAME.'_create_sidebar' );
		
		if(!empty($gdl_sidebar)){
			$xml = new DOMDocument();
			$xml->loadXML($gdl_sidebar);
			foreach( $xml->documentElement->childNodes as $sidebar_name ){
				$sidebar_attr['name'] = $sidebar_name->nodeValue;
				//$sidebar_attr['id'] = sanitize_title($sidebar_name->nodeValue);
				$sidebar_attr['id'] = 'custom-sidebar' . $sidebar_id++ ;
				register_sidebar($sidebar_attr);
			}
		}
		
	}
	
	// Flush rewrite rules for custom post types.
	add_action( 'load-themes.php', 'gdl_flush_rewrite_rules' );
	function gdl_flush_rewrite_rules() {
		global $pagenow, $wp_rewrite;
		if ( 'themes.php' == $pagenow && isset( $_GET['activated'] ) ){
			$wp_rewrite->flush_rules();
		}
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
			load_theme_textdomain( 'gdl_back_office', SERVER_PATH . '/include/languages/' );
			load_theme_textdomain( 'gdl_front_end', SERVER_PATH . '/include/languages/' );
		}
		
	}

	// excerpt filter
	add_filter('excerpt_length','gdl_excerpt_length');
	function gdl_excerpt_length(){ return 1000; }
	
	// feed excerpt filter
	add_filter('the_excerpt_rss', 'gdl_excerpt_rss');
	function gdl_excerpt_rss($excerpt) {
		return mb_substr($excerpt, 0, 300) . '...';
	}		

	// Translate the wpml shortcode -> [wpml_translate lang=en]LANG EN[/wpml_translate]
	add_shortcode('wpml_translate', 'webtreats_lang_test');	
	function webtreats_lang_test( $atts, $content = null ) {
		extract(shortcode_atts(array( 'lang' => '' ), $atts));
		
		$lang_active = ICL_LANGUAGE_CODE;
		if($lang == $lang_active){
			return $content;
		}
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
	
?>