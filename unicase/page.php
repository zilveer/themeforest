<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package unicase
 */


get_header();

	$page_layout_args = unicase_get_page_layout_args();

	ob_start();

	while ( have_posts() ) : the_post(); 

		do_action( 'unicase_page_before' );

		get_template_part( 'templates/contents/content', 'page' );

		/**
		 * @hooked unicase_display_comments - 10
		 */
		do_action( 'unicase_page_after' );

	endwhile; // end of the loop.
	
	$output = ob_get_clean();

	$layout_args = array( 'main_content' => $output );

	unicase_get_template( 'layouts/' . $page_layout_args['layout'] . '.php', $layout_args );

get_footer();