<?php
/**
 *  category Archive template page for bulk Gallery
 * 
 * @package Toranj
 * @author owwwlab
 */
 
$the_category = get_queried_object();
$t_id = $the_category->term_id;
$term_meta = get_option( "owlab_bulkgal_cat_$t_id" );

$childrens = get_term_children( $the_category->term_id, $the_category->taxonomy );
$the_category_childs = array();
foreach ($childrens as $child) {
	$the_category_childs[] = get_term_by( 'id', $child, $the_category->taxonomy );
}

$the_category = (object) array_merge((array) $the_category, (array) $term_meta);


get_header(); 
	
	$layout_type = isset ( $the_category->owlabbulkg_layout_type ) ?$the_category->owlabbulkg_layout_type: "" ;
	switch ( $layout_type ) {
		case 'grid':
			
			include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/taxonomy-grid.php'));
			break;

		case 'vertical':
			include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/taxonomy-vertical.php'));
			break;

		default:
			include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/taxonomy-grid.php'));
			break;
	} 


get_footer();
