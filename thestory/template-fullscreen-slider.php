<?php
/**
 * Template Name: Fullscreen slider page
 */
get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		//get all the page meta data (settings) needed (function located in unctions/meta.php)
		$pexeto_page=pexeto_get_post_meta( $post->ID, array( 'sidebar' ) );

		$pexeto_page['layout'] = 'full';
		$pexeto_page['header_display'] = array(
				'show_title'=>false
			);
		$pexeto_page['show_footer'] = false;

		//include the before content template
		locate_template( array( 'includes/html-before-content.php' ), true, true );

		//display the page content
		
		pexeto_print_fullpage_slider($post->ID);

	}
}

//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();
?>
