<?php
/**
 *  Archive template page for bulk gallery
 * 
 * @package Toranj
 * @author owwwlab
 */

//which layout should we use here
$layout = ot_get_option('bulk_gallery_index_layout','horizontal-scroll');


get_header(); 

	switch ( $layout ) {
		case 'grid':
			include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/archive-grid.php'));
			break;

		case 'horizontal-scroll':
			include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/archive-horizontal.php'));
			break;

		default:
			include(locate_template(OWLAB_TEMPLATES . '/bulk-gallery/archive-grid.php'));
			break;
	} 


get_footer(); ?>