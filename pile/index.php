<?php
/**
 * The main template file.
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Pile
 * @since   Pile 1.0
 */

get_header(); ?>

<div id="djaxHero" <?php pile_hero_classes( 'djax-updatable djax--hidden' ); ?>></div>

<?php do_action( 'pile_djax_container_start' ); ?>

	<div class="site-content  wrapper">
		<div class="content-width">

			<div class="page__header">
				<?php pile_the_archive_title(); ?>

				<?php if ( pile_categorized_blog() ) : ?>
				<div class="page__subtitle"><?php get_template_part( 'template-parts/all-categories' ); ?></div>
				<?php endif; ?>

			</div>

			<div class="blog">

			<?php if ( have_posts() ) { ?>

				<div class="masonry" id="content">

					<?php
					// Start the loop.
					$is_infinite = class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' );
					while ( have_posts() ) : the_post();

						/*
						 * Include the Post-Format-specific template for the content.
						 * If you want to override this in a child theme, then include a file
						 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
						 */
						get_template_part( 'template-parts/content', get_post_format() );

						// End the loop.
					endwhile; ?>

					<?php
					//only display the load more button when Infinite Scroll is active
					if ( true === $is_infinite ) { ?>

						<div id="infinite-handle">
							<button class="btn">Load more</button>
						</div>

					<?php } ?>

				</div><!-- .masonry#content -->

				<?php
				// Previous/next page navigation.
				pile_the_older_newer_nav();

				// If no content, include the "No posts found" template.
			} else {
				get_template_part( 'template-parts/content', 'none' );
			}
			?>

			</div>

		</div><!--.content-width -->
	</div>
<?php
do_action( 'pile_djax_container_end' );

get_footer();