<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package Pile
 * @since   Pile 1.0
 */

get_header();

// Let there be heroes
// we add the "page" param so that one can create a template-parts/hero-page.php in a child theme and to use that instead
get_template_part( 'template-parts/hero', 'page' );

// ensure we have the right postdata
wp_reset_postdata();

do_action( 'pile_djax_container_start' ); ?>

<?php if ( ! class_exists( 'WooCommerce' ) || ( ! is_cart() && ( ! is_checkout() || is_order_received_page() ) ) ): ?>
	<div class="site-content wrapper">
		<div class="content-width">
			<div id="primary" class="content-area">
				<div id="main" class="site-main" role="main">
<?php endif; ?>

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

<?php if ( ! class_exists( 'WooCommerce' ) || ( ! is_cart() && ( ! is_checkout() || is_order_received_page() ) ) ): ?>
				</div><!-- .site-main -->
			</div><!-- .content-area -->
		</div><!-- .content-width -->
	</div><!-- .site-content -->
<?php endif; ?>

<?php
if ( get_post_meta( get_the_ID(), '_pile_page_enabled_social_share', true ) ) {
	get_template_part( 'template-parts/addthis-social-popup' );
}

do_action( 'pile_djax_container_end' );

get_footer(); ?>