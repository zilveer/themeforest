<?php
/**
 * The template for displaying Portfolio Category archives
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Total WordPress Theme
 * @subpackage Templates
 * @version 3.3.0
 */

get_header(); ?>

	<div id="content-wrap" class="container clr">

		<?php wpex_hook_primary_before(); ?>

			<div id="primary" class="content-area clr">

				<?php wpex_hook_content_before(); ?>

				<div id="content" class="site-content clr">

					<?php wpex_hook_content_top(); ?>

					<?php if ( have_posts( ) ) : ?>

						<div id="portfolio-entries" class="<?php echo wpex_get_portfolio_wrap_classes(); ?>">

							<?php $wpex_count = 0; ?>

							<?php while ( have_posts() ) : the_post(); ?>

								<?php $wpex_count++; ?>

									<?php get_template_part( 'partials/portfolio/portfolio-entry' ); ?>

								<?php if ( $wpex_count == wpex_portfolio_archive_columns() ) $wpex_count=0; ?>

							<?php endwhile; ?>

						</div><!-- #portfolio-entries -->

						<?php wpex_pagination(); ?>

					<?php else : ?>

						<article class="clr"><?php esc_html_e( 'No Posts found.', 'total' ); ?></article>

					<?php endif; ?>

					<?php wpex_hook_content_bottom(); ?>

				</div><!-- #content -->

				<?php wpex_hook_content_after(); ?>

			</div><!-- #primary -->

			<?php wpex_hook_primary_after(); ?>

	</div><!-- #content-wrap -->

<?php get_footer(); ?>