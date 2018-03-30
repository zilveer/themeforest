<?php
/**
 * The template for displaying all pages, single posts and attachments
 *
 * This is a new template file that WordPress introduced in
 * version 4.3. Note that it uses conditional logic to display
 * different content based on the post type.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 3.5.0
 */

get_header(); ?>

	<div id="content-wrap" class="container clr">

		<?php wpex_hook_primary_before(); ?>

		<div id="primary" class="content-area clr">

			<?php wpex_hook_content_before(); ?>

			<div id="content" class="site-content clr">

				<?php wpex_hook_content_top(); ?>

				<?php
				// Start loop
				while ( have_posts() ) : the_post();

					// Single Page
					if ( is_singular( 'page' ) ) {

						get_template_part( 'partials/page-single-layout' );

					}

					// Single posts
    				elseif ( is_singular( 'post' ) ) {

    					get_template_part( 'partials/blog/blog-single-layout' );

    				}

					// Portfolio Posts
					elseif ( is_singular( 'portfolio' ) && WPEX_PORTFOLIO_IS_ACTIVE ) {

						get_template_part( 'partials/portfolio/portfolio-single-layout' );

					}

					// Staff Posts
					elseif ( is_singular( 'staff' ) && WPEX_STAFF_IS_ACTIVE ) {

						get_template_part( 'partials/staff/staff-single-layout' );

					}

					// Testimonials Posts
					elseif ( is_singular( 'testimonials' ) && WPEX_TESTIMONIALS_IS_ACTIVE ) {

						get_template_part( 'partials/testimonials/testimonials-single-layout' );

					}

					// bbPress
					elseif ( function_exists( 'is_bbPress' ) && is_bbPress() ) {

						get_template_part( 'partials/page-single-layout' );

					}

					// All other post types - when customizing your custom post types it's best to create
					// a new singular-{post_type}.php file to prevent any possible conflicts in the future
					// rather then altering the template part.
					else {

    					get_template_part( 'partials/cpt/cpt-single', get_post_type() );

  					}

				endwhile; ?>

				<?php wpex_hook_content_bottom(); ?>

			</div><!-- #content -->

			<?php wpex_hook_content_after(); ?>

		</div><!-- #primary -->

		<?php wpex_hook_primary_after(); ?>

	</div><!-- .container -->

<?php get_footer(); ?>