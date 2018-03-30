<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package unicase
 */

get_header(); 

	$page_layout_args = unicase_get_page_layout_args();

    ob_start();

    if( have_posts() ) {

	  get_template_part( 'loop' );

	} else {

		get_template_part( 'templates/contents/content', 'none' );
	}

	$output = ob_get_clean();

   $args = array( 'main_content' => $output );
   
   unicase_get_template( 'layouts/' . $page_layout_args['layout'] . '.php', $args );

get_footer();