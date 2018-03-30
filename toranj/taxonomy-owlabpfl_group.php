<?php
/**
 *  Group Archive template page for portfolio
 * 
 * @package Toranj
 * @author owwwlab
 */
 


$the_group = get_queried_object();
$t_id = $the_group->term_id;
$term_meta = get_option( "owlab_group_$t_id" );

$childrens = get_term_children( $the_group->term_id, $the_group->taxonomy );
$the_group_childs = array();
foreach ($childrens as $child) {
	$the_group_childs[] = get_term_by( 'id', $child, $the_group->taxonomy );
}

$the_group = (object) array_merge((array) $the_group, (array) $term_meta);


get_header(); 
	
	switch ( isset($the_group->owlabpfl_layout_type)?$the_group->owlabpfl_layout_type:'' ) {
		case 'grid':
			
			include(locate_template(OWLAB_TEMPLATES . '/portfolio/taxonomy-grid.php'));
			break;

		case 'vertical':
			include(locate_template(OWLAB_TEMPLATES . '/portfolio/taxonomy-vertical.php'));
			break;

		case 'horizontal':
			include(locate_template(OWLAB_TEMPLATES . '/portfolio/taxonomy-horizontal.php'));
			break;

		default:
			include(locate_template(OWLAB_TEMPLATES . '/portfolio/taxonomy-horizontal.php'));
			break;
	} 


get_footer();

?>

