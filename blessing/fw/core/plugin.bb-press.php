<?php
/* BB Press support functions
------------------------------------------------------------------------------- */

// Theme init
if (!function_exists('ancora_bbpress_theme_setup')) {
	add_action( 'ancora_action_before_init_theme', 'ancora_bbpress_theme_setup' );
	function ancora_bbpress_theme_setup() {
		if (ancora_is_bbpress_page()) {
			add_action( 'ancora_action_add_styles', 'ancora_bbpress_frontend_scripts' );

			// Detect current page type, taxonomy and title (for custom post_types use priority < 10 to fire it handles early, than for standard post types)
			add_filter('ancora_filter_get_blog_type',				'ancora_bbpress_get_blog_type', 9, 2);
			add_filter('ancora_filter_get_blog_title',			'ancora_bbpress_get_blog_title', 9, 2);
			add_filter('ancora_filter_get_stream_page_title',		'ancora_bbpress_get_stream_page_title', 9, 2);
			add_filter('ancora_filter_get_stream_page_link',		'ancora_bbpress_get_stream_page_link', 9, 2);
			add_filter('ancora_filter_get_stream_page_id',		'ancora_bbpress_get_stream_page_id', 9, 2);
			add_filter('ancora_filter_detect_inheritance_key',	'ancora_bbpress_detect_inheritance_key', 9, 1);
		}
	}
}
if ( !function_exists( 'ancora_bbpress_settings_theme_setup2' ) ) {
	add_action( 'ancora_action_before_init_theme', 'ancora_bbpress_settings_theme_setup2', 3 );
	function ancora_bbpress_settings_theme_setup2() {
		if (ancora_exists_bbpress()) {
			ancora_add_theme_inheritance( array('bbpress' => array(
				'stream_template' => 'bbpress',
				'single_template' => '',
				'taxonomy' => array(),
				'taxonomy_tags' => array(),
				'post_type' => array('forum', 'topic'),
				'override' => 'page'
				) )
			);
		}
	}
}


// Check if BB Press installed and activated
if ( !function_exists( 'ancora_exists_bbpress' ) ) {
	function ancora_exists_bbpress() {
		return class_exists( 'bbPress' );
	}
}

// Check if current page is BB Press page
if ( !function_exists( 'ancora_is_bbpress_page' ) ) {
	function ancora_is_bbpress_page() {
		return function_exists('is_bbpress') && is_bbpress();
	}
}

// Filter to detect current page inheritance key
if ( !function_exists( 'ancora_bbpress_detect_inheritance_key' ) ) {
	//add_filter('ancora_filter_detect_inheritance_key',	'ancora_bbpress_detect_inheritance_key', 9, 1);
	function ancora_bbpress_detect_inheritance_key($key) {
		if (!empty($key)) return $key;
		return ancora_is_bbpress_page() ? 'bbpress' : '';
	}
}

// Filter to detect current page slug
if ( !function_exists( 'ancora_bbpress_get_blog_type' ) ) {
	//add_filter('ancora_filter_get_blog_type',	'ancora_bbpress_get_blog_type', 9, 2);
	function ancora_bbpress_get_blog_type($page, $query=null) {
		if (!empty($page)) return $page;
		if ($query && $query->get('post_type')=='forum' || get_query_var('post_type')=='forum')
			$page = 'bbpress_forum';
		else if ($query && $query->get('post_type')=='topic' || get_query_var('post_type')=='topic')
			$page = 'bbpress_topic';
		return $page;
	}
}

// Filter to detect current page title
if ( !function_exists( 'ancora_bbpress_get_blog_title' ) ) {
	//add_filter('ancora_filter_get_blog_title',	'ancora_bbpress_get_blog_title', 9, 2);
	function ancora_bbpress_get_blog_title($title, $page) {
		if (!empty($title)) return $title;
		if ( ancora_strpos($page, 'bbpress')!==false ) {
			if ( $page == 'bbpress_forum' || $page == 'bbpress_topic' ) {
				$title = ancora_get_post_title();
			} else {
				$title = __('Forums', 'ancora');
			}
		}
		return $title;
	}
}

// Filter to detect stream page title
if ( !function_exists( 'ancora_bbpress_get_stream_page_title' ) ) {
	//add_filter('ancora_filter_get_stream_page_title',	'ancora_bbpress_get_stream_page_title', 9, 2);
	function ancora_bbpress_get_stream_page_title($title, $page) {
		if (!empty($title)) return $title;
		if (ancora_strpos($page, 'bbpress')!==false) {
			/*
			if (($page_id = ancora_bbpress_get_stream_page_id(0, $page)) > 0) {
				$title = ancora_get_post_title($page_id);
			} else
				$title = __('Forums', 'ancora');
			*/
			// Page exists at root slug path, so use its permalink
			$page = bbp_get_page_by_path( bbp_get_root_slug() );
			if ( !empty( $page ) )
				$title = get_the_title( $page->ID );
			else
				$title = __('Forums', 'ancora');
		}
		return $title;
	}
}

// Filter to detect stream page ID
if ( !function_exists( 'ancora_bbpress_get_stream_page_id' ) ) {
	//add_filter('ancora_filter_get_stream_page_id',	'ancora_bbpress_get_stream_page_id', 9, 2);
	function ancora_bbpress_get_stream_page_id($id, $page) {
		if (!empty($id)) return $id;
		if (ancora_strpos($page, 'bbpress')!==false) {
			//$id = ancora_get_template_page_id('bbpress');
			// Page exists at root slug path, so use its permalink
			$page = bbp_get_page_by_path( bbp_get_root_slug() );
			if ( !empty( $page ) ) $id = $page->ID;
		}
		return $id;
	}
}

// Filter to detect stream page URL
if ( !function_exists( 'ancora_bbpress_get_stream_page_link' ) ) {
	//add_filter('ancora_filter_get_stream_page_link', 'ancora_bbpress_get_stream_page_link', 9, 2);
	function ancora_bbpress_get_stream_page_link($url, $page) {
		if (!empty($url)) return $url;
		if (ancora_strpos($page, 'bbpress')!==false) {
			/*
			$id = ancora_get_template_page_id('bbpress');
			$url = get_permalink($id);
			*/
			// Page exists at root slug path, so use its permalink
			$page = bbp_get_page_by_path( bbp_get_root_slug() );
			if ( !empty( $page ) )
				$url = get_permalink( $page->ID );
			else
				$url = get_post_type_archive_link( bbp_get_forum_post_type() );
		}
		return $url;
	}
}

// Enqueue BB Press custom styles
if ( !function_exists( 'ancora_bbpress_frontend_scripts' ) ) {
	//add_action( 'ancora_action_add_styles', 'ancora_bbpress_frontend_scripts' );
	function ancora_bbpress_frontend_scripts() {
		ancora_enqueue_style( 'bbpress-style',  ancora_get_file_url('css/bbpress-style.css'), array(), null );
	}
}
?>