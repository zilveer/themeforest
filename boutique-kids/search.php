<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header(); ?>

<!-- boutique template: search.php -->
		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) : ?>

				<?php do_action( 'boutique_page_header_before' ); ?>
					<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'boutique-kids' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
				<?php do_action( 'boutique_page_header_after' ); ?>

				<?php // boutique_content_nav( 'nav-above' ); ?>

				<?php /* Start the Loop */ ?>
				<?php while ( have_posts() ) : the_post(); ?>

					<?php
						/*
					Include the Post-Format-specific template for the content.
						 * If you want to overload this in a child theme then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'content', get_post_format() );
					?>

				<?php endwhile; ?>

				<?php boutique_content_nav( 'nav-below' ); ?>

			<?php else : ?>

				<div id="post-0" class="post no-results not-found">
					<div class="entry-header">
						<h1 class="entry-title"><?php esc_html_e( 'Nothing Found', 'boutique-kids' ); ?></h1>
					</div><!-- .entry-header -->

					<div class="entry-content">
						<p><?php esc_html_e( 'Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'boutique-kids' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
