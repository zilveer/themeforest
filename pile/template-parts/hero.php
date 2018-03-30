<?php
/**
 * The template for the hero area (the top area) of portfolio archive page.
 *
 * The first slide will be the hero of the static page (if there is one)
 * Then we will show the projects that have been chosen as featured from the archive page edit
 * - The Hero image for each project or the first image in the Hero gallery if that is the case.
 *
 * @package Pile
 * @since   Pile 1.0
 */

global $post;

$classes = array( 'djax-updatable' );

// We need to know how high should the hero/header area be
$header_height = '';
if ( is_page() ) {
	$header_height = trim( get_post_meta( get_the_ID(), '_pile_page_header_height', true ) );
} elseif ( is_singular( 'pile_portfolio' ) ) {
	$header_height = trim( get_post_meta( get_the_ID(), '_pile_project_header_height', true ) );
}
//by default we show a full-height hero/header
if ( empty( $header_height ) ) {
	$header_height = 'full-height';
}
//add the header height class
$classes[] = $header_height;

// get all the images/videos/featured projects ids that we will use as slides (we also cover for when there are none)
$slides = pile_get_hero_slides_ids();

// determine if we need a hero at all
$hero_needed = ! empty( $slides ) ;
if ( ! $hero_needed ) {
	$classes[] = 'djax--hidden';
} ?>

<div id="djaxHero" <?php pile_hero_classes( $classes ); ?>>

	<?php if ( $hero_needed ) : ?>

	<div class="hero js-hero bigger-fonts">

		<?php
		// Should we autoplay the slideshow?
		$slider_autoplay = get_post_meta( get_the_ID(), '_pile_post_slider_autoplay', true ); ?>

		<div class="hero-slider  js-pixslider"
		     data-imagealigncenter
		     data-imagescale="fill"
		     data-slidertransition="fade"
		     data-slidertransitionspeed=""
		     data-bullets
		     data-customArrows
			<?php
			if ( $slider_autoplay ) {
				echo 'data-sliderautoplay="" ' . PHP_EOL;
				echo 'data-sliderdelay="' . get_post_meta( get_the_ID(), '_pile_post_slider_delay', true ) . '" ' . PHP_EOL;
			} ?>>
		<?php

		$featured_projects_IDs = array();

		// If we are on a page, we might have some featured projects
		if ( is_page() ) {
			// Get the featured projects list (comma separated string) and extract them into an array
			$featured_projects = trim( get_post_meta( get_the_ID(), '_pile_portfolio_featured_projects', true ) );
			if ( ! empty( $featured_projects ) ) {
				$featured_projects_IDs = explode( ',', $featured_projects );
			}
		}

		//subtract from the overall slides list, the featured projects, so we can treat them separately
		$slides = array_diff( $slides, $featured_projects_IDs );

		// First go through all the attachments (images and/or videos) and add them as slides
		if ( ! empty( $slides ) ) {
			//the first slide we encounter is obviously the first one
			$first_slide = true;

			// Loop through each slide ( the first one is kinda special )
			foreach ( $slides as $key => $attachment_id ) : ?>

				<div class="rsContent" <?php pile_the_background_color_style(); ?>>

					<?php
					$hero_opacity = get_post_meta( get_the_ID(), '_hero_image_opacity', true );
					pile_the_hero_slide_background( $attachment_id, $hero_opacity ); // Output the background image of the slide ?>

					<?php //we only show the hero description on the first slide
					if ( true === $first_slide ) : ?>

						<div class="hero">
							<?php pile_the_hero_description(); ?>
						</div><!-- .hero -->

						<?php
						//remember that we are done with the first slide
						$first_slide = false;
					endif; ?>

				</div><!-- .rsContent -->

			<?php endforeach;
		}

		// Secondly, handle the featured projects, if there are any
		if ( ! empty( $featured_projects_IDs ) ) {
			// get rid of the action added by Simple Custom Post Order - naughty naughty
			// it breaks our ordering
			global $scporder;
			if( isset( $scporder ) ) {
				remove_action( 'pre_get_posts', array( $scporder, 'scporder_pre_get_posts' ) );
			}

			// Get the custom text for the view project button
			$link_project = get_post_meta( get_the_ID(), '_pile_portfolio_featured_view_more_label', true );

			$query_args  = array(
				'post_type'      => 'pile_portfolio',
				'post__in'       => $featured_projects_IDs, // pass array of ids into `include` parameter
				'orderby'        => 'post__in',
				'posts_per_page' => - 1, //get all featured projects
			);
			$query_posts = get_posts( $query_args );

			foreach ( $query_posts as $post ) :
				setup_postdata( $post );

				/* Now we need to determine what background image/video to use - it's first come, first served */
				/* This is the order: first are the hero background images, then hero background videos, and finally the featured image */
				$thumbnail_ID = false;

				// First try the hero background images - we are after a valid attachment id
				// get the hero background images
				$image_ids = trim( get_post_meta( get_the_ID(), '_pile_second_image', true ) );
				if ( ! empty( $image_ids ) ) {
					$ids = explode( ',', $image_ids );
					if ( ! empty( $ids ) && is_numeric( $ids[0] ) ) {
						$thumbnail_ID = (int) $ids[0];
					}
				}

				// If still no id, try the videos
				if ( empty( $thumbnail_ID ) ) {
					// get the hero background videos
					$video_ids = trim( get_post_meta( get_the_ID(), '_videos_backgrounds', true ) );
					if ( ! empty( $video_ids ) ) {
						$ids = explode( ',', $video_ids );
						if ( ! empty( $ids ) && is_numeric( $ids[0] ) ) {
							$thumbnail_ID = (int) $ids[0];
						}
					}
				} ?>

				<div class="rsContent" <?php pile_the_background_color_style(); ?>>

					<?php
					$hero_opacity = get_post_meta( get_the_ID(), '_hero_image_opacity', true );
					pile_the_hero_slide_background( $thumbnail_ID, $hero_opacity ); ?>

					<div class="hero">
						<?php pile_the_hero_description( $post, $link_project ); ?>
					</div><!-- .hero -->
				</div><!-- .rsContent -->

			<?php
			endforeach;

			//restore peace to the loop
			wp_reset_postdata();

		} // if ( ! empty( $featured_projects_IDs ) ) ?>

		</div><!-- .hero-slider or .hero-container -->

		<?php get_template_part( 'template-parts/scroll-down-arrow' ); ?>

	</div><!-- .hero -->

	<?php endif; // if ( $hero_needed ) ?>

</div><!-- #djaxHero -->