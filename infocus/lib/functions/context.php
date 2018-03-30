<?php
/**
 *
 */
function mysite_get_context() {
	global $wp_query, $post, $mysite;
	$blog_page = mysite_blog_page();
	
	# If $mysite->context has been set, don't run through the conditionals again. Just return the variable.
	if ( !empty( $mysite->context ) )
		if ( is_array( $mysite->context ) )
			return $mysite->context;

	$mysite->context = array();

	# Front page of the site.
	if ( is_front_page() )
		$mysite->context[] = 'home';

	# Blog page.
	if ( is_home() )
		$mysite->context[] = 'blog';
		
	# Mysite blog.
	if( !empty( $post->ID ) && $blog_page == $post->ID )
		$mysite->context[] = 'blog';

	# Singular views.
	elseif ( is_singular() ) {
		$mysite->context[] = 'singular';
		$mysite->context[] = "singular-{$wp_query->post->post_type}";
		$mysite->context[] = "singular-{$wp_query->post->post_type}-{$wp_query->post->ID}";
	}

	# Archive views.
	elseif ( is_archive() ) {
		$mysite->context[] = 'archive';

		# Taxonomy archives.
		if ( is_tax() || is_category() || is_tag() ) {
			$term = $wp_query->get_queried_object();
			$mysite->context[] = 'taxonomy';
			$mysite->context[] = $term->taxonomy;
			$mysite->context[] = "{$term->taxonomy}-" . sanitize_html_class( $term->slug, $term->term_id );
		}

		# User/author archives.
		elseif ( is_author() ) {
			$mysite->context[] = 'user';
			$mysite->context[] = 'user-' . sanitize_html_class( get_the_author_meta( 'user_nicename', get_query_var( 'author' ) ), $wp_query->get_queried_object_id() );
		}

		# Time/Date archives.
		else {
			if ( is_date() ) {
				$mysite->context[] = 'date';
				if ( is_year() )
					$mysite->context[] = 'year';
				if ( is_month() )
					$mysite->context[] = 'month';
				if ( get_query_var( 'w' ) )
					$mysite->context[] = 'week';
				if ( is_day() )
					$mysite->context[] = 'day';
			}
			if ( is_time() ) {
				$mysite->context[] = 'time';
				if ( get_query_var( 'hour' ) )
					$mysite->context[] = 'hour';
				if ( get_query_var( 'minute' ) )
					$mysite->context[] = 'minute';
			}
		}
	}

	# Search results.
	elseif ( is_search() )
		$mysite->context[] = 'search';

	# Error 404 pages.
	elseif ( is_404() )
		$mysite->context[] = 'error-404';

	return $mysite->context;
}


if ( !function_exists( 'mysite_body_class' ) ) :
/**
 *
 */
function mysite_body_class( $class = array() ) {
	global $wp_query, $post, $mysite;

	$classes = array();

	# Make site responsive
	if( isset( $mysite->responsive ) )
		$classes[] = 'mysite_responsive';

	# Add mobile device class	
	if( isset( $mysite->mobile ) )
		$classes[] = $mysite->mobile;

	# Has breadcrumbs
	if( ( !apply_atomic( 'disable_breadcrumb', mysite_get_setting( 'disable_breadcrumbs' ) ) ) && ( !is_front_page() ) && ( !empty( $post->ID ) && !get_post_meta( $post->ID, '_disable_breadcrumbs', true ) ) )
		$classes[] = 'has_breadcrumbs';
	
	# Has full resize background option in skin	
	$custom_background = apply_filters( 'mysite_active_skin', get_option( MYSITE_ACTIVE_SKIN ) );
	if( isset( $custom_background['full_bg'] ) && is_array( $custom_background['full_bg'] ) && in_array( 'fullbg', $custom_background['full_bg'] ) )
		$classes[] = 'has_fullbg';

	# Search, Archive & 404 sidebar	& background
	if( is_archive() ) {
		$archive_layout = mysite_get_setting( 'archive_layout' );
		if( !empty( $archive_layout ) )
			$classes[] = $archive_layout;
		else
			$classes[] = 'right_sidebar';

		$custom_background = mysite_get_setting( 'archive_custom_background' );
		if( !empty( $custom_background['url'] ) )
			$classes[] = 'has_fullbg';
	}

	if( is_search() ) {
		$search_layout = mysite_get_setting( 'search_layout' );
		if( !empty( $search_layout ) )
			$classes[] = $search_layout;
		else
			$classes[] = 'right_sidebar';

		$custom_background = mysite_get_setting( 'search_custom_background' );
		if( !empty( $custom_background['url'] ) )
			$classes[] = 'has_fullbg';
	}

	if( is_404() ) {
		$four_04_layout = mysite_get_setting( 'four_04_layout' );
		if( !empty( $four_04_layout ) )
			$classes[] = $four_04_layout;
		else
			$classes[] = 'full_width';

		$custom_background = mysite_get_setting( 'four_04_custom_background' );
		if( !empty( $custom_background['url'] ) )
			$classes[] = 'has_fullbg';
	}

	# Slider
	if( is_front_page() || mysite_get_setting( 'slider_page' ) ) {
		if( !mysite_get_setting( 'home_slider_disable' ) ) {
			$classes[] = 'has_slider';
			
			$slider_type = apply_filters( 'mysite_slider_type', mysite_get_setting( 'homepage_slider' ) );
			if( $slider_type )
				$classes[] = $slider_type;
				
			if( $slider_type == 'responsive_slider' ) {
				$get_responsive_direction_nav = mysite_get_setting( 'responsive_direction_nav' );
				$get_responsive_dots_nav = mysite_get_setting( 'responsive_dots_nav' );
				
				$responsive_nav_defaults = array(
					'responsive_direction_nav' => ( !empty( $get_responsive_direction_nav ) ? '' : 'slider_nav_arrows' ),
					'responsive_dots_nav' => ( !empty( $get_responsive_dots_nav ) ? '' : 'slider_nav_dots' )
				);

				$responsive_nav = wp_parse_args( apply_filters( 'mysite_responsive_options', '' ), $responsive_nav_defaults );
				$classes = array_merge( $classes, $responsive_nav );
				
				$responsive_slider_content = trim( apply_filters('mysite_responsive_slider_content', mysite_get_setting( 'static_slider_content_text' ) ) );
				$responsive_content_float = apply_filters('mysite_responsive_content_float', mysite_get_setting( 'static_slider_content' ) );
				if( !empty( $responsive_slider_content ) )
					$classes[] = 'slider_' . $responsive_content_float;
				
			} else {
				$classes[] = 'slider_nav_' . mysite_get_setting( 'slider_nav' );
			}
		}
	}

	# Header extras
	$sociable = mysite_get_setting( 'sociable' );
	$header_text = mysite_get_setting( 'extra_header' );

	if( $sociable['keys'] != '#' )
		$classes[] = 'has_header_social';

	if( !empty( $header_text ) )
		$classes[] = 'has_header_text';

	if( has_nav_menu( 'header-links' ) )
		$classes[] = 'has_header_links';

	# Homepage
	if( is_front_page() ) {
		$classes[] = 'is_home';

		$classes[] = ( mysite_get_setting( 'homepage_layout' ) )
		? mysite_get_setting( 'homepage_layout' ): 'full_width';

		if( mysite_get_setting( 'homepage_teaser_text' ) )
			$classes[] = 'has_intro';

		if( mysite_get_setting( 'homepage_footer_teaser' ) )
			$classes[] = 'has_outro';
	}

	# Is singluar post
	if( is_singular() ) {
		$type = get_post_type();
		$dependencies = get_post_meta( $post->ID, '_dependencies', true );
		$dependencies = ( empty( $dependencies ) ) ? get_post_meta( $post->ID, '_' . THEME_SLUG .'_dependencies', true ) : $dependencies;
		$template = get_post_meta( $post->ID, '_wp_page_template', true );
		$custom_background = get_post_meta( $post->ID, '_custom_background', true );
		$intro_custom_banner = get_post_meta( $post->ID, '_intro_custom_banner', true );
		$_intro_text = get_post_meta( $post->ID, '_intro_text', true );
		$_layout = get_post_meta( $post->ID, '_layout', true );
		
		if( $type == 'portfolio' )
			$classes[] = 'portfolio_single';
			
		if( ( strpos( $dependencies, 'fancy_portfolio' ) !== false || apply_atomic( 'fancy_portfolio', false ) == true ) && ( $template != 'template-featuretour.php' ) && ( !isset( $mysite->responsive ) ) )
			$classes[] = 'fancy_portfolio';
		
		if( $template == 'template-sitemap.php' )
			$classes[] = 'sitemap';
			
		if( $template == 'template-squeeze-page.php' )
			$classes[] = 'squeeze_page';
			
		if( $template == 'template-featuretour.php' )
			$classes[] = 'feature_tour';
			
		if( !empty( $custom_background['url'] ) )
			$classes[] = 'has_custombg';
			
		if( isset( $custom_background['full_bg'] ) && !in_array( 'fullbg', $classes ) )
			$classes[] = 'has_fullbg';
			
		if( $_intro_text == 'banner' && !empty( $intro_custom_banner['url'] ) )
			$classes[] = 'has_image_banner';
			
		if( has_post_thumbnail( $post->ID ) )
			$classes[] = 'has_featured_image';

		if( $template == 'template-featuretour.php' || $template == 'template-squeeze-page.php' || strpos( $dependencies, 'fancy_portfolio' ) !== false || apply_atomic( 'fancy_portfolio', false ) == true && !isset( $mysite->responsive ) )
			$classes[] = 'full_width';

		elseif( !empty( $_layout ) )
			$classes[] = $_layout;

		elseif( strpos( $post->post_content, '[portfolio' ) !== false )
			$classes[] = 'full_width';

		elseif( $type == 'portfolio' )
			$classes[] = 'full_width';
			
		elseif( $type == 'page' && empty( $_layout ) ) {
			$page_layout = mysite_get_setting( 'page_layout' );
			if( !empty( $page_layout ) )
				$classes[] = $page_layout;
			else
				$classes[] = 'right_sidebar';
				
		} elseif ( $type == 'post' && empty( $_layout ) ) {
			$post_layout = mysite_get_setting( 'post_layout' );
			if( !empty( $post_layout ) )
				$classes[] = $post_layout;
			else
				$classes[] = 'right_sidebar';
				
		} else {
			$classes[] = 'right_sidebar';
		}
			
	}

	# Intro
	if( is_singular() || is_archive() || is_search() ) {
		$_intro_text = get_post_meta( $post->ID, '_intro_text', true );
		$intro_options = mysite_get_setting( 'intro_options' );

		if ( empty( $_intro_text ) || is_archive() || is_search() )
			$_intro_text = 'default';

		if( ( $_intro_text == 'default' ) && ( $intro_options != 'disable' ) && ( $intro_options != 'custom' ) )
			$classes[] = 'has_intro';

		if( ( $_intro_text == 'default' ) && ( $intro_options == 'custom' ) && ( mysite_get_setting( '_intro_custom_html' ) ) )
			$classes[] = 'has_intro';

		if( ( $_intro_text != 'disable' ) && ( $_intro_text != 'default' ) && ( $_intro_text != 'custom' ) )
			$classes[] = 'has_intro';

		if( ( $_intro_text != 'disable' ) && ( $_intro_text == 'custom' ) && ( get_post_meta( $post->ID, '_intro_custom_html', true ) ) )
			$classes[] = 'has_intro';
	}
	
	# Outro
	if( ( mysite_get_setting( 'footer_teaser' ) ) && ( !is_front_page() ) )
		$classes[] = 'has_outro';

	# Footer
	foreach ( array( 'footer1', 'footer2', 'footer3', 'footer4', 'footer5', 'footer6' ) as $footer )
		$footer_sidebar[] = ( is_active_sidebar( $footer ) ) ? 'active' : 'inactive';

	if ( !in_array( 'active', $footer_sidebar ) || mysite_get_setting( 'footer_disable' ) )
		$classes[] = 'no_footer';
	
	# Merge any custom classes
	if( is_array( $class ) )
		$classes = array_merge( $classes, $class );

	# Merge any filtered body classes
	$filter_classes = apply_atomic( 'filter_body_class', '' );

	if( is_array( $filter_classes ) )
		$classes = array_merge( $classes, $filter_classes );

	# Join all the classes into one string
	$class = join( ' ', $classes );

	# Print the body class
	echo apply_atomic( 'body_class', $class );
}
endif;

?>