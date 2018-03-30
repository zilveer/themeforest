<?php
/**
 * The main template file for the blog page
 *
 */

get_header(); ?>

<div class="row content_row">

	<div class="large-9 columns">

		<div id="page" class="hfeed site">

			<div id="content" class="site-content">

				<div id="primary" class="content-area">

					<main id="main" class="site-main" role="main">

					<?php if ( have_posts() ) : ?>

					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>

							<?php
								/* Include the Post-Format-specific template for the content.
								 * If you want to override this in a child theme, then include a file
								 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
								 */
								get_template_part( 'template-parts/content', get_post_format() );
							?>

					<?php endwhile; ?>

						<?php heartfelt_paging_nav(); ?>

					<?php else : ?>

						<?php get_template_part( 'content', 'none' ); ?>

					<?php endif; ?>

					</main><!-- #main -->

				</div><!-- #primary -->

			</div><!-- #content -->

		</div><!-- #page -->

	</div><!-- .large-9 -->

	<div id="secondary" class="widget-area large-3 columns" role="complementary">
			
		<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>

			<aside id="search" class="widget">
				<h3 class="widget-title"><?php _e( 'No Widgets Yet', 'heartfelt' ); ?></h3>
				<p>Add widgets to the sidebar in Appearance > Widgets > Inner Sidebar</p>
			</aside>

		<?php endif; // end sidebar widget area ?>

	</div><!-- #secondary -->

</div><!-- .row .content_row -->

<?php get_footer(); ?>
