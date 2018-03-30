<?php
/**
 * Template Name: Front Page
 *
 * @package Listable
 * @since Listable 1.0
 */

get_header();

global $post; ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
			while ( have_posts() ) : the_post();
				// we'll return a random attachment from image and videos background lists, if one is present
				$the_random_hero = listable_get_random_hero_object();
				$has_image       = false; ?>

				<?php if ( ( empty( $the_random_hero ) || property_exists( $the_random_hero, 'post_mime_type' ) || strpos( $the_random_hero->post_mime_type, 'video' ) !== false ) && is_object( $the_random_hero ) && property_exists( $the_random_hero, 'post_mime_type' ) && strpos( $the_random_hero->post_mime_type, 'image' ) !== false ) {
					$has_image = wp_get_attachment_url( $the_random_hero->ID );
				} ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<header class="entry-header has-image">
						<div class="entry-featured"<?php if ( ! empty( $has_image ) ) {
							echo ' style="background-image: url(' . listable_get_inline_background_image( $has_image ) . ');"';
						} ?>>
							<?php if ( ! empty( $the_random_hero ) && property_exists( $the_random_hero, 'post_mime_type' ) && strpos( $the_random_hero->post_mime_type, 'video' ) !== false ) {
								$mimetype = str_replace( 'video/', '', $the_random_hero->post_mime_type );
								if ( has_post_thumbnail( $the_random_hero->ID ) ) {
									$image = wp_get_attachment_url( get_post_thumbnail_id( $the_random_hero->ID ) );
									$poster = ' poster="' . $image . '" ';
								} else {
									$poster = ' ';
								}
								echo do_shortcode( '[video ' . $mimetype . '="' . wp_get_attachment_url( $the_random_hero->ID ) . '"' . $poster . 'loop="true" autoplay="true"][/video]' );
							} ?>
						</div>
						<div class="header-content">
							<h1 class="page-title"><?php the_title(); ?></h1>

							<div class="entry-subtitle">
								<?php if ( $post->post_excerpt ) {
									the_excerpt();
								} ?>
							</div>

							<?php get_template_part( 'job_manager/job-filters-hero' ); ?>

						</div>

						<div class="top-categories">
							<?php listable_display_frontpage_listing_categories(); ?>
						</div>

					</header>

					<?php if ( $post->post_content ): ?>
						<div class="entry-content">
							<?php the_content(); ?>
						</div>
					<?php endif; ?>
					<!-- .entry-content -->

					<?php if ( is_active_sidebar( 'front_page_sections' ) ) { ?>
						<div class="widgets_area">
							<?php dynamic_sidebar( 'front_page_sections' ); ?>
						</div>
					<?php } ?>

				</article><!-- #post-## -->

			<?php endwhile; // End of the loop. ?>

		</main>
		<!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();