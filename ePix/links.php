<?php
/**
 * @package WordPress
 * @subpackage Themeva
 */

/*
Template Name: Links
*/
	global $NV_layout;
	 
	$columns = '';
		
	if( $NV_layout == "layout_one" ) 		$columns = 'twelve';
	elseif( $NV_layout == "layout_two" )	$columns = 'eight last';
	elseif( $NV_layout == "layout_three" )	$columns = 'six last';
	elseif( $NV_layout == "layout_four" )	$columns = 'eight';
	elseif( $NV_layout == "layout_five" )   $columns = 'six';
	elseif( $NV_layout == "layout_six" )  	$columns = 'six';
	else $columns = 'eight';	
		
	echo "\n\t". '<div id="content" class="columns '. $columns .' '. $NV_layout .'">';
	
	wp_list_bookmarks();
		
	echo "\n\t". '</div><!-- #content -->';
		
	get_sidebar();  
	get_footer();