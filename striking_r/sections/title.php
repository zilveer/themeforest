<?php
if(!function_exists('theme_section_title')){
/**
 * The default template for displaying title in the pages
 */
function theme_section_title(){
	global $page, $paged, $wp_version;
	if ( function_exists( '_wp_render_title_tag' ) && version_compare(preg_replace("/[^0-9\.]/","",$wp_version), '4.4', '>=')  ) return;
	if(defined('WPSEO_FILE')){
		return '<title>'.wp_title('',false).'</title>';
	}

	$output =  wp_title( '|', false, 'right' );

	// Add the blog name.
	$output .=  get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( !empty($site_description) && is_front_page() )
		$output .=  " | $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$output .= ' | ' . sprintf( __( 'Page %s', 'striking-r' ), max( $paged, $page ) );

	return '<title>'.$output.'</title>';
}
}