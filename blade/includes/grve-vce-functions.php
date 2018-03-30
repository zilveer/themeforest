<?php

/*
*	Visual Composer Extension Plugin Hooks
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/

/**
 * Translation function returning the theme translations
 */

/* All */
function blade_grve_theme_vce_get_string_all() {
    return esc_html__( 'All', 'blade' );
}
/* Read more */
function blade_grve_theme_vce_get_string_read_more() {
    return esc_html__( 'read more', 'blade' );
}
/* In Categories */
function blade_grve_theme_vce_get_string_categories_in() {
    return esc_html__( 'in', 'blade' );
}

/* Author By */
function blade_grve_theme_vce_get_string_by_author() {
    return esc_html__( 'By:', 'blade' );
}

/* E-mail */
function blade_grve_theme_vce_get_string_email() {
    return esc_html__( 'E-mail', 'blade' );
}

/**
 * Hooks for portfolio translations
 */

add_filter( 'blade_grve_vce_portfolio_string_all_categories', 'blade_grve_theme_vce_get_string_all' );

 /**
 * Hooks for blog translations
 */

add_filter( 'blade_grve_vce_string_read_more', 'blade_grve_theme_vce_get_string_read_more' );
add_filter( 'blade_grve_vce_blog_string_all_categories', 'blade_grve_theme_vce_get_string_all' );
add_filter( 'blade_grve_vce_blog_string_categories_in', 'blade_grve_theme_vce_get_string_categories_in' );
add_filter( 'blade_grve_vce_blog_string_by_author', 'blade_grve_theme_vce_get_string_by_author' );

 /**
 * Hooks for general translations
 */
 
 add_filter( 'blade_grve_vce_string_email', 'blade_grve_theme_vce_get_string_email' );

//Omit closing PHP tag to avoid accidental whitespace output errors.
