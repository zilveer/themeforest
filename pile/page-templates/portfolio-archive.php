<?php
/**
 * Template Name: Portfolio Archive
 * @package Pile
 * @since   Pile 1.0
 */

global $post;

get_header();

// Let there be heroes
// we add the "portfolio-archive" param so that one can create a template-parts/hero-portfolio-archive.php in a child theme and to use that instead
get_template_part( 'template-parts/hero', 'portfolio-archive' );

do_action( 'pile_djax_container_start' ); ?>

	<div class="site-content  wrapper">
		<div class="content-width">

			<?php
			do_action('pile_page_custom_css');

			// The Loop
			if( have_posts() ) {
				// get the current page content, the_post will bring us the custom loop
				setup_postdata( $post );

				$infinite_scroll = get_post_meta( get_the_ID(), '_pile_portfolio_infinite_scroll', true );
				$the_content = pile_get_the_content(); ?>
				<div class="content-area entry-content clearfix <?php echo empty( $the_content ) ? ' empty ' : '';?>">
					<?php echo $the_content; ?>
				</div><!-- .entry-content -->

				<?php
					$aspect_ratio_class = '';
					$aspect_ratio = pile_option( 'archive_thumbnails_aspect_ratio' );
					if ( $aspect_ratio !== 'original' ) {
						$aspect_ratio_class = 'pile-aspect-ratio--' . $aspect_ratio;
					}
				?>
				<div id="content" <?php pile_portfolio_classes( 'pile  pile--portfolio-archive  ' . $aspect_ratio_class ); ?> data-pageid="<?php the_ID(); ?>">

					<?php
					//The Loop - actually a fake loop
					while ( have_posts() ):
						the_post();
						//do nothing here as we will do it via hooks (see extras.php class PreGetPostsForPages)
					endwhile; ?>

				</div><!-- #content -->

				<?php if ( ! pile_toBool( $infinite_scroll ) ) {
					pile_the_next_prev_nav( );
				}

			} else {
				get_template_part( 'template-parts/content-none' );
			} ?>
		</div><!-- .content-width -->
	</div><!-- .site-content.wrapper -->

<?php

do_action( 'pile_djax_container_end' );

get_footer();
