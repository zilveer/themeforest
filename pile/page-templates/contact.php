<?php
/**
 * Template Name: Contact
 *
 * @package Pile
 * @since   Pile 1.0
 */

get_header();

get_template_part( 'template-parts/hero-gmap' ); // let there be heroes

// ensure we have the right postdata
wp_reset_postdata();

do_action( 'pile_djax_container_start' ); ?>

	<div class="site-content  wrapper">
		<div class="content-width">

			<div id="primary" class="content-area">
				<div id="main" class="site-main" role="main">

					<?php

					do_action('pile_page_custom_css');

					// Start the loop.
					while ( have_posts() ) : the_post();

						// Include the page content template.
						get_template_part( 'template-parts/content', 'page' );

						// If comments are open or we have at least one comment, load up the comment template.
						if ( comments_open() || get_comments_number() ) {
							comments_template();
						}

						// End of the loop.
					endwhile; ?>

				</div><!-- .site-main -->
			</div><!-- .content-area -->
		</div><!-- .container +- .sidebar-wrapper -->
	</div><!-- .site-content -->

<?php
if ( get_post_meta( get_the_ID(), '_pile_gmap_enabled_social_share', true ) ) {
	get_template_part( 'template-parts/addthis-social-popup' );
}

do_action('pile_djax_container_end' );

get_footer(); ?>