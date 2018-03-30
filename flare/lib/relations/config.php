<?php
/**
 * This file is part of the BTP_Flare_Theme package.
 *
 * For the full license information, please view the Licensing folder
 * that was distributed with this source code.
 * 
 * Table of contents:
 *  
 * 1. Custom Taxonomies - btp_relation_tag   
 */



/* Prevent direct script access */
if ( !defined( 'BTP_FRAMEWORK_VERSION' ) ) exit( 'No direct script access allowed' );



/* ----------------------------------------------------------------------------- */
/* ---------->>> CUSTOM TAXONOMIES <<<------------------------------------------ */
/* ----------------------------------------------------------------------------- */



/**
 * Registers custom taxonomy "btp_relation_tags"
 * 
 * If you want to modify some paremeters, hook into the btp_pre_register_custonomy custom filter.
 */
function btp_relations_register_taxonomy() {
	$args = array(     		
    	'hierarchical' 			=> false,  
       	'label' 				=> __('Relation Tag', 'btp_theme'),
     	'labels'				=> array(
     		'name' 					=> __( 'Relation Tags', 'btp_theme' ),
    		'singular_name' 		=> __( 'Relation Tag', 'btp_theme' ),
    		'search_items' 			=> __( 'Search Relation Tags', 'btp_theme' ),
    		'all_items' 			=> __( 'All Relation Tags', 'btp_theme' ),
    		'parent_item' 			=> __( 'Parent Relation Tag', 'btp_theme' ),
    		'parent_item_colon' 	=> __( 'Parent Relation Tag:', 'btp_theme' ),
    		'edit_item' 			=> __( 'Edit Relation Tag', 'btp_theme' ), 
    		'update_item' 			=> __( 'Update Relation Tag', 'btp_theme' ),
    		'add_new_item' 			=> __( 'Add New Relation Tag', 'btp_theme' ),
    		'new_item_name' 		=> __( 'New Relation Tag', 'btp_theme' ),
		),
        'query_var' 			=> false,  
        'rewrite' 				=> false,
     	'show_tagcloud'			=> false,
     	'show_in_nav_menus'		=> false
	);  
	
	/* Apply custom filters (this way Child Themes can change some arguments) */
	$args = apply_filters( 'btp_pre_register_custonomy', $args, 'btp_relation_tag' );
	
	register_taxonomy( 'btp_relation_tag', null, $args );
}
add_action( 'init', 'btp_relations_register_taxonomy', 5 );


require_once( dirname(__FILE__) . '/functions.php' );
?>