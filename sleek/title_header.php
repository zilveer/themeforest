<?php
$theme_settings = sleek_theme_settings();



// Defaults
$title 				= '';
$title_above 		= '';
$title_description 	= '';
$bg 				= '';
$bg_light 			= '';




// Archive - Fallback
if( is_archive() ){
	$title = __('Archives', 'sleek');
}

// Day
if( is_day() ){
	$title 			= get_the_date();
	$title_above 	= __('Daily Archives', 'sleek');
}

// Month
if( is_month() ){
	$title 			= get_the_date( _x( 'F Y', 'monthly archives date format', 'sleek' ) );
	$title_above 	= __('Monthly Archives', 'sleek');
}

// Year
if( is_year() ){
	$title 			= get_the_date( _x( 'Y', 'yearly archives date format', 'sleek' ) );
	$title_above 	= __('Yearly Archives', 'sleek');
}

// Format - Tax
if( is_tax() ){
	$title 			= single_cat_title( '' ,false );
	$title_above 	= __('Format', 'sleek');
}

// Category & Tag
if( is_category() || is_tag() ){

	$queried_object = get_queried_object();

	$title 				= single_cat_title( '' ,false );
	$title_above 		= is_category() ? __('Category', 'sleek') : __('Tag','sleek');
	$title_description 	= category_description();
	if( function_exists('get_field') ){
		$bg 			= get_field( 'featured_image', $queried_object);
		$bg_light 		= get_field( 'featured_image_is_light', $queried_object);
	}
}

// Blog Home - Index
if( is_home() ){

	if( !$theme_settings->posts['blog_home_title_header_use'] ){
		return;
	}

	$title 				= $theme_settings->posts['blog_home_title'];
	$title_above 		= $theme_settings->posts['blog_home_title_above'];
	$title_description 	= $theme_settings->posts['blog_home_description'];
	$bg 				= $theme_settings->posts['blog_home_background'];
	$bg_light 			= $theme_settings->posts['blog_home_background_light'];
}

// Page
if( is_page() ){

	if( get_post_meta( get_the_ID(), 'title_header_use', true ) == '0' ){
		return;
	}

	$title = get_the_title();
	$title_above = get_post_meta( get_the_ID(), 'title_above', true );
	$title_description = get_post_meta( get_the_ID(), 'title_description', true );
	$bg = get_post_meta( get_the_ID(), 'title_header_background', true );
	$bg_light = get_post_meta( get_the_ID(), 'title_header_background_light', true );

	// fallback to featured image
	if( !$bg ){
		$bg = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'xl' );
		$bg = "url('{$bg[0]}') 50% 50% / auto no-repeat local transparent;";
	}
}

// Search
if( is_search() ){
	$title = get_search_query();
	$title_above = __('Search Results', 'sleek');
}


/*------------------------------------------------------------
* Process data and output html
*------------------------------------------------------------*/

$title_header_class = '';
$style = '';

if( $title_description ){
	$title_description = wpautop( $title_description );
}

if( $title_description || $bg ){
	$title_header_class .= ' title-header--big';
}

if( $bg ){
	$style = ' style="background:'.$bg.';"';
	$title_header_class .= ' title-header--bg';
	$title_header_class .= $bg_light ? ' title-header--light' : ' title-header--dark';
}

echo '<div class="title-header' . $title_header_class . '"' . $style . '>';
echo '<div class="title-header__inwrap">';

	echo '<h1>';
		if( $title_above ){
			echo '<span class="above">' . $title_above . '</span>';
		}
		echo $title;
	echo '</h1>';

	if( $title_description ){
		echo '<div class="separator"></div>';
		echo '<div class="title-header__description">';
			echo $title_description;
		echo '</div>';
	}

echo '</div>';
echo '</div>';
