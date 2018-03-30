<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage boutique
 * @since boutique 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;


get_header(); ?>

<!-- boutique template: archive.php -->
		<div id="primary">
			<div id="content" role="main">

			<?php if ( have_posts() ) :
				?>

				<?php do_action( 'boutique_page_header_before' ); ?>
				<div class="page-header">
					<h1 class="page-title">
						<?php if ( is_day() ) : ?>
							<?php printf( esc_html__( 'Daily Archives: %s', 'boutique-kids' ), '<span>' . get_the_date() . '</span>' ); ?>
						<?php elseif ( is_month() ) : ?>
							<?php printf( esc_html__( 'Monthly Archives: %s', 'boutique-kids' ), '<span>' . get_the_date( 'F Y' ) . '</span>' ); ?>
						<?php elseif ( is_year() ) : ?>
							<?php printf( esc_html__( 'Yearly Archives: %s', 'boutique-kids' ), '<span>' . get_the_date( 'Y' ) . '</span>' ); ?>
						<?php elseif ( is_category() || is_tag() ) : ?>
							<?php single_cat_title( is_category() ? esc_html__( 'Category: ', 'boutique-kids' ) : esc_html__( 'Tag: ', 'boutique-kids' ) ); ?>
						<?php else : ?>
							<?php esc_html_e( 'Blog Archives', 'boutique-kids' ); ?>
						<?php endif; ?>
					</h1>
				</div>
				<?php do_action( 'boutique_page_header_after' ); ?>

				<?php
				// boutique_content_nav( 'nav-above' );
				?>

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
						<p><?php esc_html_e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'boutique-kids' ); ?></p>
						<?php get_search_form(); ?>
					</div><!-- .entry-content -->
				</div><!-- #post-0 -->

			<?php endif; ?>

			</div><!-- #content -->
		</div><!-- #primary -->

<?php get_footer(); ?>
