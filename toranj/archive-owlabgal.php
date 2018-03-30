<?php
/**
 *  Archive template page for gallery
 * 
 * @package Toranj
 * @author owwwlab
 */

//which layout should we use here
$layout = ot_get_option('gallery_index_layout');

//d(get_terms( 'owlabpfl_group', 'orderby=count' ),true);

get_header(); 

	switch ( $layout ) {
		case 'grid':
			
			include(locate_template(OWLAB_TEMPLATES . '/gallery/archive-grid.php'));
			break;

		case 'horizontal':
			include(locate_template(OWLAB_TEMPLATES . '/gallery/archive-horizontal.php'));
			break;

		case 'inpage':
			$owlabgal_albums = get_terms( 'owlabgal_album', 'orderby=count' );
			include(locate_template(OWLAB_TEMPLATES . '/gallery/archive-inpage.php'));
			break;

		case 'minimal':
			include(locate_template(OWLAB_TEMPLATES . '/gallery/archive-minimal.php'));
			break;

		default:
			include(locate_template(OWLAB_TEMPLATES . '/gallery/archive-horizontal.php'));
			break;
	} 


get_footer(); ?>