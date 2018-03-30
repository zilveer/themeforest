<?php

/*------------------------------------------------------------
 * Return Global Theme Settings
 *------------------------------------------------------------*/

function sleek_theme_settings_global($clear_cache = false){

	static $theme_settings;

	if( $theme_settings && !$clear_cache ){
		return $theme_settings;
	}

	$theme_settings = new StdClass;

	$theme_settings->general['logo']                = get_theme_mod( 'logo', THEME_IMG_URI . '/logo.png' );
	$theme_settings->general['favicon']             = get_theme_mod( 'favicon', THEME_IMG_URI . '/favicon.ico' );
	$theme_settings->general['touch']               = get_theme_mod( 'touch', THEME_IMG_URI . '/touch.png' );
	$theme_settings->general['header_search']       = get_theme_mod( 'header_search', true );
	$theme_settings->general['ajax_load_pages']     = get_theme_mod( 'ajax_load_pages', true );
	$theme_settings->general['init_load_animation'] = get_theme_mod( 'init_load_animation', true );
	$theme_settings->general['open_graph_use']      = get_theme_mod( 'open_graph_use', true );
	$theme_settings->general['copyright']           = get_theme_mod( 'copyright', 'Copyright, 2014' );
	$theme_settings->general['sidebar_title']       = get_theme_mod( 'sidebar_title', __('General', 'sleek') );

	$theme_settings->layout['header_width']        = get_theme_mod( 'header_width', '250' );
	$theme_settings->layout['use_sidebar']         = get_theme_mod( 'use_sidebar', true );
	$theme_settings->layout['independent_sidebar'] = get_theme_mod( 'independent_sidebar', true );
	$theme_settings->layout['comments_in_sidebar'] = get_theme_mod( 'comments_in_sidebar', true );
	$theme_settings->layout['sidebar_width']       = get_theme_mod( 'sidebar_width', '304' );
	$theme_settings->layout['sidebar_width_big']   = get_theme_mod( 'sidebar_width_big', '401' );

	$theme_settings->style['color']['color_primary']      = get_theme_mod( 'color_primary', '#FF4D4D' );
	$theme_settings->style['color']['color_white']        = get_theme_mod( 'color_white', '#FFFFFF' );
	$theme_settings->style['color']['color_grey_pale']    = get_theme_mod( 'color_grey_pale', '#f5f5f5' );
	$theme_settings->style['color']['color_grey_light']   = get_theme_mod( 'color_grey_light', '#cecece' );
	$theme_settings->style['color']['color_grey_sidebar'] = get_theme_mod( 'color_grey_sidebar', '#aaaaaa' );
	$theme_settings->style['color']['color_grey']         = get_theme_mod( 'color_grey', '#777777' );
	$theme_settings->style['color']['color_black']        = get_theme_mod( 'color_black', '#3F3F53' );

	$theme_settings->style['bg']['bg_header']       = get_theme_mod( 'bg_header', '#f5f5f5' );
	$theme_settings->style['bg']['bg_header_dark']  = get_theme_mod( 'bg_header_dark', false );
	$theme_settings->style['bg']['bg_content']      = get_theme_mod( 'bg_content', '#ffffff' );
	$theme_settings->style['bg']['bg_sidebar']      = get_theme_mod( 'bg_sidebar', '#23222d' );
	$theme_settings->style['bg']['bg_sidebar_dark'] = get_theme_mod( 'bg_sidebar_dark', true );
	$theme_settings->style['bg']['bg_masonry']      = get_theme_mod( 'bg_masonry', '#f5f5f5' );

	$theme_settings->typo['body']           = explode( '|',get_theme_mod( 'font_body', 'Source Sans Pro|300|16|1.4') );
	$theme_settings->typo['navigation']     = explode( '|',get_theme_mod( 'font_navigation', 'Montserrat|regular|16|1') );
	$theme_settings->typo['custom_heading'] = explode( '|',get_theme_mod( 'font_custom_heading', 'Montserrat|regular|20|1') );
	$theme_settings->typo['h1']             = explode( '|',get_theme_mod( 'font_h1', 'Source Sans Pro|200|52|1.05') );
	$theme_settings->typo['h2']             = explode( '|',get_theme_mod( 'font_h2', 'Source Sans Pro|200|42|1.3') );
	$theme_settings->typo['h3']             = explode( '|',get_theme_mod( 'font_h3', 'Source Sans Pro|300|32|1.4') );
	$theme_settings->typo['h4']             = explode( '|',get_theme_mod( 'font_h4', 'Source Sans Pro|300|28|1.4') );
	$theme_settings->typo['h5']             = explode( '|',get_theme_mod( 'font_h5', 'Source Sans Pro|300|22|1.4') );
	$theme_settings->typo['h6']             = explode( '|',get_theme_mod( 'font_h6', 'Source Sans Pro|300|18|1.4') );
	$theme_settings->character_sets = get_theme_mod( 'character_sets', 'latin');

	$theme_settings->posts['blog_home_sidebar_use']      = get_theme_mod( 'blog_home_sidebar_use', 'default' );
	$theme_settings->posts['blog_home_title_header_use'] = get_theme_mod( 'blog_home_title_header_use', true );
	$theme_settings->posts['blog_home_title']            = get_theme_mod( 'blog_home_title', 'Latest Posts' );
	$theme_settings->posts['blog_home_title_above']      = get_theme_mod( 'blog_home_title_above', '' );
	$theme_settings->posts['blog_home_description']      = get_theme_mod( 'blog_home_description', '' );
	$theme_settings->posts['blog_home_background']       = get_theme_mod( 'blog_home_background', false );
	$theme_settings->posts['blog_home_background_light'] = get_theme_mod( 'blog_home_background_light', false );

	$theme_settings->posts['blog_home_posts_title']       = get_theme_mod( 'blog_home_posts_title', '' );
	$theme_settings->posts['blog_home_posts_title_above'] = get_theme_mod( 'blog_home_posts_title_above', '' );
	$theme_settings->posts['blog_home_pagination']        = get_theme_mod( 'blog_home_pagination', false );
	$theme_settings->posts['blog_home_display_style']     = get_theme_mod( 'blog_home_display_style', 'list' );
	$theme_settings->posts['featured_category']           = get_theme_mod( 'featured_category', '0' );
	$theme_settings->posts['featured_count']              = get_theme_mod( 'featured_count', '4' );
	$theme_settings->posts['featured_style']              = get_theme_mod( 'featured_style', 'carousel' );
	$theme_settings->posts['featured_exclude']            = get_theme_mod( 'featured_exclude', true );

	$theme_settings->posts['archive_sidebar_use']   = get_theme_mod( 'archive_sidebar_use', 'default' );
	$theme_settings->posts['archive_pagination']    = get_theme_mod( 'archive_pagination', false );
	$theme_settings->posts['archive_display_style'] = get_theme_mod( 'archive_display_style', 'list' );

	$theme_settings->posts['post_navigation']  = get_theme_mod( 'post_navigation', true );
	$theme_settings->posts['post_navigation_category']  = get_theme_mod( 'post_navigation_category', false );
	$theme_settings->posts['post_tags']        = get_theme_mod( 'post_tags', true );
	$theme_settings->posts['post_share']       = get_theme_mod( 'post_share', true );
	$theme_settings->posts['post_author']      = get_theme_mod( 'post_author', true );
	$theme_settings->posts['post_related']     = get_theme_mod( 'post_related', true );
	$theme_settings->posts['post_centralized'] = get_theme_mod( 'post_centralized', false );

	$theme_settings->advanced['custom_css']     = get_theme_mod( 'custom_css', '' );
	$theme_settings->advanced['embed_gmaps_js'] = get_theme_mod( 'embed_gmaps_js', true );
	$theme_settings->advanced['display_pingbacks'] = get_theme_mod( 'display_pingbacks', false );
	$theme_settings->advanced['google_api'] = get_theme_mod( 'google_api', '' );

	// check for api key and add default
	$theme_settings->advanced['google_api'] = $theme_settings->advanced['google_api'] ? $theme_settings->advanced['google_api'] : 'AIzaSyAx7cyr9G4t5NajODtUfRfrJ-M8DULKC5o';




	return $theme_settings;
}



/*------------------------------------------------------------
 * Return Theme Settings modified by page specific settings
 *------------------------------------------------------------*/

function sleek_theme_settings(){

	static $theme_settings_global;
	static $theme_settings;

	if( $theme_settings ){
		return $theme_settings;
	}

	if(!$theme_settings_global){
		$theme_settings_global = sleek_theme_settings_global();
	}

	// check if $post has been defined or fallback to global settings
	global $post;
	if( !isset($post) ){
		return $theme_settings_global;
	}



	$theme_settings = $theme_settings_global;


	// Used to support live customizer
	global $wp_customize;



	/* Override Blog Home 'Use Sidebar' setting
	 *------------------------------------------------------------*/

	if( is_home() ){

		if ( isset( $wp_customize ) ) {
			$theme_settings = sleek_theme_settings_global(true);
		}

		if( $theme_settings->posts['blog_home_sidebar_use'] == 'true' ){
			$theme_settings->layout['use_sidebar'] = true;
		}
		if( $theme_settings->posts['blog_home_sidebar_use'] == 'false' ){
			$theme_settings->layout['use_sidebar'] = false;
		}

		if ( isset( $wp_customize ) ) {
			return $theme_settings;
		}

	}



	/* Override Archive's 'Use Sidebar' setting
	 *------------------------------------------------------------*/

	if( is_archive() ){

		if ( isset( $wp_customize ) ) {
			$theme_settings = sleek_theme_settings_global(true);
		}

		if( $theme_settings->posts['archive_sidebar_use'] == 'true' ){
			$theme_settings->layout['use_sidebar'] = true;
		}
		if( $theme_settings->posts['archive_sidebar_use'] == 'false' ){
			$theme_settings->layout['use_sidebar'] = false;
		}

		if ( isset( $wp_customize ) ) {
			return $theme_settings;
		}

	}



	/* Fresh Update of $theme_settings on WP Customize refresh
	 *------------------------------------------------------------*/

	if ( isset( $wp_customize ) ) {
		$theme_settings = sleek_theme_settings_global(true);
		return $theme_settings;
	}



	/* Modify $theme_settings per page specific settings
	 *------------------------------------------------------------*/

	if( is_singular() ){

		if( get_post_meta( get_the_ID(), 'use_sidebar', true ) == 'true' ){
			$theme_settings->layout['use_sidebar'] = true;
		}elseif( get_post_meta( get_the_ID(), 'use_sidebar', true ) == 'false' ){
			$theme_settings->layout['use_sidebar'] = false;
		}

		if( get_post_meta( get_the_ID(), 'comments_in_sidebar', true ) == 'true' ){
			$theme_settings->layout['comments_in_sidebar'] = true;
		}elseif( get_post_meta( get_the_ID(), 'comments_in_sidebar', true ) == 'false' ){
			$theme_settings->layout['comments_in_sidebar'] = false;
		}
	}

	if(
		is_singular()
		&& (
			!is_active_sidebar('sidebar-area')
			|| get_post_meta( get_the_ID(), 'sidebar_use_general_tab', true ) == '0'
		)
		&& (
			get_post_meta( get_the_ID(), 'comments_use', true ) == '0'
			|| !( comments_open() || get_comments_number() > 0 )
			|| !$theme_settings->layout['comments_in_sidebar']
		)
	){
		$theme_settings->layout['use_sidebar'] = false;
	}


	if( function_exists('bp_current_component') ){
		if( bp_current_component() ){
			$theme_settings->layout['use_sidebar'] = true;
		}
	}




	return $theme_settings;
}
