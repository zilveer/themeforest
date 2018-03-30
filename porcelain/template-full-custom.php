<?php
/**
 * Template Name: Full-width custom page
 */
get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

		// $page_content = pexeto_a

		//get all the page meta data (settings) needed (function located in unctions/meta.php)
		$pexeto_page=pexeto_get_post_meta( $post->ID, array( 'slider', 'show_title', 'sidebar' ) );

		$pexeto_page['layout'] = 'full';

		//include the before content template
		locate_template( array( 'includes/html-before-content.php' ), true, true );

		//display the page content
		
		$content = '<div class="custom-page-content">'.pexeto_filter_home_content(get_the_content()).'</div>';
		$content = do_shortcode($content );
		echo $content;
		
		wp_link_pages();

		$share_btns = pexeto_get_share_btns_html( $post->ID, 'page' );
		$box_section = ( pexeto_option( 'page_comments' ) && $share_btns);

		if($box_section){
			//open a boxed section
			?><div class="section-boxed"><?php
		}

		//print sharing
		echo $share_btns;

		if ( pexeto_option( 'page_comments' ) ) {
			//include the comments template
			comments_template();
		}

		if($box_section){
			?></div><?php
		}

	}
}

//include the after content template
locate_template( array( 'includes/html-after-content.php' ), true, true );

get_footer();
?>
