<?php
/**
 *  Archive template page for portfolio
 * 
 * @package Toranj
 * @author owwwlab
 */


//which layout should we use here
$layout = ot_get_option('portfolio_index_layout');


get_header(); 


	
	switch ( $layout ) {
		case 'grid':
			$owlabpfl_groups = get_terms( 'owlabpfl_group', 'orderby=count' );
			include(locate_template(OWLAB_TEMPLATES . '/portfolio/archive-grid.php'));
			break;

		case 'vertical':
			include(locate_template(OWLAB_TEMPLATES . '/portfolio/archive-vertical.php'));
			break;

		case 'horizontal':
			include(locate_template(OWLAB_TEMPLATES . '/portfolio/archive-horizontal.php'));
			break;

		default:
			include(locate_template(OWLAB_TEMPLATES . '/portfolio/archive-horizontal.php'));
			break;
	} 


get_footer(); 

?>