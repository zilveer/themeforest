<?php

// -----------------------------------------------------------------------------
// String to Slug
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_string_to_slug' ) ) :
function getbowtied_string_to_slug($str) {
	$str = strtolower(trim($str));
	$str = preg_replace('/[^a-z0-9-]/', '_', $str);
	$str = preg_replace('/-+/', "_", $str);
	return $str;
}
endif;

// -----------------------------------------------------------------------------
// Theme Name
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_name' ) ) :
function getbowtied_theme_name() {
	$getbowtied_theme = wp_get_theme();
	return $getbowtied_theme->get('Name');
}
endif;

// -----------------------------------------------------------------------------
// Theme Slug
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_slug' ) ) :
function getbowtied_theme_slug() {
	$getbowtied_theme = wp_get_theme();
	return getbowtied_string_to_slug( $getbowtied_theme->get('Name') );
}
endif;


// -----------------------------------------------------------------------------
// Theme Author
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_author' ) ) :
function getbowtied_theme_author() {
	$getbowtied_theme = wp_get_theme();
	return $getbowtied_theme->get('Author');
}
endif;

// -----------------------------------------------------------------------------
// Theme Description
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_description' ) ) :
function getbowtied_theme_description() {
	$getbowtied_theme = wp_get_theme();
	return $getbowtied_theme->get('Description');
}
endif;


// -----------------------------------------------------------------------------
// Theme Version
// -----------------------------------------------------------------------------

if ( ! function_exists( 'getbowtied_theme_version' ) ) :
function getbowtied_theme_version() {
	$getbowtied_theme = wp_get_theme(get_template());
	return $getbowtied_theme->get('Version');
}
endif;