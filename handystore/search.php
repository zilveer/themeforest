<?php /* The template for displaying Search Results pages */
get_header(); ?>

	<main class="site-content<?php if (function_exists('pt_main_content_class')) pt_main_content_class(); ?>" itemscope="itemscope" itemprop="mainContentOfPage"><!-- Main content -->

		<?php if ( function_exists('pt_output_page_title') ) pt_output_page_title(); ?>

			<?php if ( have_posts() ) {
					global $query_string;
					query_posts( $query_string . "&s=$s" . '&posts_per_page=5' . '&post_type=post' ); ?>

				<?php get_search_form(); ?>

				<?php
					// Start the Loop.
					while ( have_posts() ) : the_post();

						get_template_part( 'content', get_post_format() );

					endwhile;

					// Pagination
					if (handy_get_option('blog_frontend_layout')!=='isotope') {
						get_template_part( 'partials/pagination' );
					}

				} else {
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );
				} ?>

	</main><!-- #content -->

	<?php get_sidebar(); ?>

<?php get_footer(); ?>
