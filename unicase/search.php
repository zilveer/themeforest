<?php
/**
 * The template for displaying search results pages.
 *
 * @package unicase
 */

get_header(); 

	$page_layout_args = unicase_get_page_layout_args();

    ob_start();

    if( have_posts() ) {
    	?>
    	<header class="page-header">
			<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'unicase' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
		</header><!-- .page-header -->
		<?php

		get_template_part( 'loop' );

	} else {

		get_template_part( 'templates/contents/content', 'none' );
	}

	$output = ob_get_clean();

   $args = array( 'main_content' => $output );
   
   unicase_get_template( 'layouts/' . $page_layout_args['layout'] . '.php', $args );

get_footer();
