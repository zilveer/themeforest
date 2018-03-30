<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents: 
 * 
 * 1. Theme Options - related with module 
 * 2. Shortcodes
 * 3. Widgets     
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );


 
/* ----------------------------------------------------------------------------- */
/* ---------->>> THEME OPTIONS <<<---------------------------------------------- */
/* ----------------------------------------------------------------------------- */
btp_theme_add_option_group( 'feeds', array( 'label' => __( 'Feeds', 'btp_theme' ) ), 1500 );
btp_theme_add_option_subgroup( 'main', array( 'label' => __( 'Main', 'btp_theme' ) ), 'feeds', 100 );






/* ----------------------------------------------------------------------------- */
/* ---------->>> SHORTCODES <<<------------------------------------------------- */
/* ----------------------------------------------------------------------------- */




/* ----------------------------------------------------------------------------- */
/* ---------->>> WIDGETS <<<---------------------------------------------------- */
/* ----------------------------------------------------------------------------- */
require_once( dirname(__FILE__) . '/functions.php' );
require_once( dirname(__FILE__) . '/shortcodes.php' );
require_once( dirname(__FILE__) . '/widgets.php' );



foreach( btp_feeds_get_items() as $counter => $feed ) {
	btp_theme_add_option(  
	'feed_' . $feed,
	array(
		'view'			=> 'Feed',
		'label'     	=> $feed,
		'children'		=> array(
			'label'			=> array(
				'view'			=> 'String',
				'label'			=> __( 'Label', 'btp_theme' ),
				'i18n'			=> true,
			),
			'caption'		=> array(
				'view'			=> 'String',
				'label'			=> __( 'Caption', 'btp_theme' ),
				'i18n'			=> true,
			),
			'link'			=> array(
				'view'			=> 'String',
				'label'			=> __( 'Link', 'btp_theme' ),
			),
			'linking'		=> array(
				'view'			=> 'Choice',
				'label'			=> __( 'Linking', 'btp_theme' ),
				'choices'		=> array(
					'standard'		=> __( 'open in the same window', 'btp_theme' ),
					'new-window'	=> __( 'open in a new window', 'btp_theme' ),
				),
			),		
		),
		'icon'			=> get_template_directory_uri() . '/images/icons/' . $feed . '.png',
		'group'			=> 'feeds',
		'subgroup'		=> 'main',
		'position'		=> $counter*10
	));	
}
?>