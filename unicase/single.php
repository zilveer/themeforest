<?php 

get_header();

	$page_layout_args = unicase_get_page_layout_args();

	ob_start();

	while ( have_posts() ) : the_post();
	
	do_action( 'unicase_single_post_before' );
	
	get_template_part( 'templates/contents/content', 'single' );

	/**
	 * @hooked unicase_post_nav - 10
	 * @hooked unicase_display_comments - 10
	 */
	do_action( 'unicase_single_post_after' );

	endwhile; // end of the loop. 

	$output = ob_get_clean();

	$layout_args = array( 'main_content' => $output );

	unicase_get_template( 'layouts/' . $page_layout_args['layout'] . '.php', $layout_args );

get_footer();