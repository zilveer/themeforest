<?php
/**
 * This file is part of the BTP_FaderTheme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 * 1. Theme Options - related with module 
 * 2. Post options - meta fields related with page
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



add_theme_support( 'post-thumbnails', array( 'page' ) );


/* ----------------------------------------------------------------------------- */
/* ---------->>> THEME OPTIONS <<<---------------------------------------------- */
/* ----------------------------------------------------------------------------- */

btp_theme_add_option_group( 'page', array( 'label' => __( 'Pages', 'btp_theme' ) ), 500 );
btp_theme_add_option_subgroup( 
	'home', 
	array( 
		'label' => __( 'Home', 'btp_theme' ),
	), 
	'page', 
	100 
);

btp_theme_add_option_subgroup( 
	'search', 
	array( 
		'label' => __( 'Search', 'btp_theme' ),
	), 
	'page', 
	700 
);
btp_theme_add_option_subgroup( 
	'error404', 
	array( 
		'label' => __( 'Error 404', 'btp_theme' ),
	), 
	'page', 
	800 
);

// ----------------------------------------------------------------------
// Pages > Search
// ----------------------------------------------------------------------
btp_theme_add_option( 'page_home_page', array(
	'view'			=> 'Choice',
	'label' 		=> __('Home Page', 'btp_theme'),
	'default'		=> '',
	'null'			=> '',
	'choices_cb'	=> 'btp_page_get_choices',
	'help'			=> 
		'<p>' . __( 'If you want to set the Blog Page as the Home Page, leave this option blank or select the Blog Page.', 'btp_theme' ) . '</p>' ,
	'hint'			=> __( 'Which page should be the home page?', 'btp_theme' ),	
	'group'			=> 'page',
	'subgroup'		=> 'home',
	'position'		=> 100,
));

btp_theme_add_option( 'page_search_page', array(
	'view'			=> 'Choice',
	'label' 		=> __('Search Page', 'btp_theme'),
	'default'		=> '',
	'null'			=> '',
	'choices_cb'	=> 'btp_page_get_choices',
	'help'			=> 
		'<p>' . __( 'Few points about this page:', 'btp_theme' ) . '</p>' .
		'<ul>' .			
			'<li>' . __( 'Any content will be ignored.', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'All other elements ( like title, sidebar, background, etc.  ) should work fine.', 'btp_theme' ) . '</li>' .
		'</ul>',
	'hint'			=> __( 'Which page should be the search results page?', 'btp_theme' ),	
	'group'			=> 'page',
	'subgroup'		=> 'search',
	'position'		=> 100,
));

btp_theme_add_option( 'page_error404_page', array(
	'view'			=> 'Choice',
	'label' 		=> __('Error 404 Page', 'btp_theme'),
	'default'		=> '',
	'null'			=> '',
	'choices_cb'	=> 'btp_page_get_choices',
	'help'			=> 
		'<p>' . __( 'Few points about this page:', 'btp_theme' ) . '</p>' .
		'<ul>' .
			'<li>' . __( 'Any content will be ignored.', 'btp_theme' ) . '</li>' .
			'<li>' . __( 'All other elements ( like title, sidebar, background, etc.  ) should work fine.', 'btp_theme' ) . '</li>' .
		'</ul>',
	'hint'			=> __( 'Which page should be the error 404 page?', 'btp_theme' ),	
	'group'			=> 'page',
	'subgroup'		=> 'error404',
	'position'		=> 100,
));

/* ----------------------------------------------------------------------------- */
/* ---------->>> ENTRY OPTIONS <<<---------------------------------------------- */
/* ----------------------------------------------------------------------------- */

add_post_type_support( 'page', 'excerpt' );
add_post_type_support( 'page', 'btp-backgrounds' );
add_post_type_support( 'page', 'btp-sliders' );
add_post_type_support( 'page', 'btp-relations' );


btp_entry_add_option( 'subtitle', array( 'apply' => array( 'page' => true ) ) );
btp_entry_add_option( 'elem_sidebar_1', array( 'apply' => array( 'page' => true ) ) );
btp_entry_add_option( 'elem_title', array( 'apply' => array( 'page' => true ) ) );
btp_entry_add_option( 'elem_breadcrumbs', array( 'apply' => array( 'page' => true ) ) );


require_once( dirname(__FILE__) . '/functions.php' );
require_once( dirname(__FILE__) . '/shortcodes.php' );
require_once( dirname(__FILE__) . '/widgets.php' );
?>