<?php
/**
 *  Album Archive template page for Gallery
 * 
 * @package Toranj
 * @author owwwlab
 */
 
$the_album = get_queried_object();
$t_id = $the_album->term_id;
$term_meta = get_option( "owlab_album_$t_id" );

$childrens = get_term_children( $the_album->term_id, $the_album->taxonomy );
$the_album_childs = array();
foreach ($childrens as $child) {
	$the_album_childs[] = get_term_by( 'id', $child, $the_album->taxonomy );
}

$the_album = (object) array_merge((array) $the_album, (array) $term_meta);


get_header(); 
	
	$layout_type = isset ( $the_album->owlabgal_layout_type ) ?$the_album->owlabgal_layout_type: "" ;
	switch ( $layout_type ) {
		case 'grid':
			
			include(locate_template(OWLAB_TEMPLATES . '/gallery/taxonomy-grid.php'));
			break;

		case 'vertical':
			include(locate_template(OWLAB_TEMPLATES . '/gallery/taxonomy-vertical.php'));
			break;

		default:
			include(locate_template(OWLAB_TEMPLATES . '/gallery/taxonomy-grid.php'));
			break;
	} 


get_footer();

