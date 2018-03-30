<?php
/**
 * Visual Composer Post Type Slider
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Not needed in admin ever
if ( is_admin() ) {
    return;
}

// Required VC functions
if ( ! function_exists( 'vc_map_get_attributes' ) || ! function_exists( 'vc_shortcode_custom_css_class' ) ) {
	vcex_function_needed_notice();
	return;
}

// Get and extract shortcode attributes
$atts = vc_map_get_attributes( 'vcex_post_type_flexslider', $atts );
extract( $atts );

// Query posts with thumbnails_only
if ( 'over-image' == $caption_location ) {
	$atts['thumbnail_query'] = 'true';
}

// Build the WordPress query
$wpex_query = vcex_build_wp_query( $atts );

//Output posts
if ( $wpex_query->have_posts() ) :

	// Load inline js
	vcex_inline_js( array( 'slider_pro' ) );

	// Sanitize data, declate main vars & fallbacks
	$wrap_data  = array();
	$slideshow  = wpex_vc_is_inline() ? 'false' : $slideshow;
	$caption    = $caption ? $caption : 'true';
	$title      = $title ? $title : 'true';

	// Slider attributes
	if ( in_array( $animation, array( 'fade', 'fade_slides' ) ) ) {
		$wrap_data[] = 'data-fade="true"';
	}
	if ( 'true' == $randomize ) {
		$wrap_data[] = 'data-shuffle="true"';
	}
	if ( 'true' == $loop ) {
		$wrap_data[] = 'data-loop="true"';
	}
	if ( 'true' == $loop ) {
		$wrap_data[] = ' data-loop="true"';
	}
	if ( 'false' == $slideshow ) {
		$wrap_data[] = 'data-auto-play="false"';
	}
	if ( $slideshow && $slideshow_speed ) {
		$wrap_data[] = 'data-auto-play-delay="'. $slideshow_speed .'"';
	}
	if ( 'false' == $direction_nav ) {
		$wrap_data[] = 'data-arrows="false"';
	}
	if ( 'false' == $control_nav ) {
		$wrap_data[] = 'data-buttons="false"';
	}
	if ( 'false' == $direction_nav_hover ) {
		$wrap_data[] = 'data-fade-arrows="false"';
	}
	if ( 'true' == $control_thumbs ) {
		$wrap_data[] = 'data-thumbnails="true"';
	}
	if ( 'true' == $control_thumbs && 'true' == $control_thumbs_pointer ) {
		$wrap_data[] = 'data-thumbnail-pointer="true"';
	}
	if ( $animation_speed ) {
		$wrap_data[] = 'data-animation-speed="'. intval( $animation_speed ) .'"';
	}
	if ( $height_animation ) {
		$height_animation = intval( $height_animation );
		$height_animation = 0 == $height_animation ? '0.0' : $height_animation;
		$wrap_data[] = 'data-height-animation-duration="'. $height_animation .'"';
	}
	if ( 'true' == $control_thumbs && $control_thumbs_height ) {
		$wrap_data[] = 'data-thumbnail-height="'. intval( $control_thumbs_height ) .'"';
	}
	if ( 'true' == $control_thumbs && $control_thumbs_width ) {
		$wrap_data[] = 'data-thumbnail-width="'. intval( $control_thumbs_width ) .'"';
	}

	// Caption attributes and classes
	$caption_data = '';
	$caption_classes = array( 'wpex-slider-caption', 'clr' );
	if ( 'over-image' == $caption_location ) {
		$caption_classes[] = 'sp-static sp-layer sp-black';
		$caption_data      = ' data-width="100%" data-position="bottomLeft"';
	}
	$caption_classes[] = $caption_location;
	if ( $caption_visibility ) {
		$caption_classes[] = $caption_visibility;
	}
	$caption_classes = implode( ' ', $caption_classes );

	// Main Classes
	$wrap_classes = array( 'vcex-posttypes-slider', 'wpex-slider', 'slider-pro', 'vcex-image-slider', 'clr' );
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}
	if ( 'under-image' == $caption_location ) {
		$wrap_classes[] = 'arrows-topright';
	}
	if ( $visibility ) {
		$wrap_classes[] = $visibility;
	}
	if ( 'true' == $excerpt && $excerpt_length ) {
		$wrap_classes[] = 'vcex-posttypes-slider-w-excerpt';
	}
	if ( 'true' == $control_thumbs ) {
		$wrap_classes[] = 'vcex-posttypes-slider-w-thumbnails';
	}

	// Convert arrays into strings
	$wrap_classes = implode( ' ', $wrap_classes );
	$wrap_data    = ' '. implode( ' ', $wrap_data ); ?>

	<?php
	// Open css wrapper
	if ( $css ) : ?>
		<div class="vcex-posttype-slider-css-wrap <?php echo apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, vc_shortcode_custom_css_class( $css ), 'vcex_image_flexslider', $atts ); ?>">
	<?php endif; ?>

	<?php
	// Display the first image of the slider as a "preloader"
	if ( $first_post = $wpex_query->posts[0]->ID ) : ?>

		<div class="wpex-slider-preloaderimg">

			<?php wpex_post_thumbnail( array(
				'attachment' => get_post_thumbnail_id( $first_post ),
				'size'       => $img_size,
				'crop'       => $img_crop,
				'width'      => $img_width,
				'height'     => $img_height,
			) ); ?>

		</div><!-- .wpex-slider-preloaderimg -->

	<?php endif; ?>

	<div class="<?php echo $wrap_classes; ?>"<?php vcex_unique_id( $unique_id ); ?><?php echo $wrap_data; ?>>

		<div class="wpex-slider-slides sp-slides">

				<?php
				// Store posts in an array for use with the thumbnails later
				$posts_cache = array();

				// Loop through posts
				while ( $wpex_query->have_posts() ) :

					// Get post from query
					$wpex_query->the_post();

					// Get post data
					$post_id   = get_the_ID();
					$post_type = get_post_type();

					// Store post ids
					$posts_cache[] = $post_id; ?>

					<div class="wpex-slider-slide sp-slide">

						<div class="wpex-slider-media">

							<?php if ( has_post_thumbnail() ) : ?>

									<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="wpex-slider-media-link">
										<?php wpex_post_thumbnail( array(
											'size'   => $img_size,
											'crop'   => $img_crop,
											'width'  => $img_width,
											'height' => $img_height,
											'alt'    => wpex_get_esc_title(),
										) ); ?>
									</a>

								<?php endif; ?>

							<?php
							// WooComerce Price
							if ( class_exists( 'Woocommerce' ) && 'product' == $post_type ) : ?>

								<div class="slider-woocommerce-price">
									<?php wpex_woo_product_price(); ?>
								</div><!-- .slider-woocommerce-price -->

							<?php endif; ?>

							<?php if ( 'true' == $caption ) : ?>

								<div class="<?php echo $caption_classes; ?>"<?php echo $caption_data ;?>>

									<?php if ( 'true' == $title || 'true' == $meta ) : ?>

										<header class="vcex-posttype-slider-header clr">

											<?php
											// Display title
											if ( 'true' == $title ) : ?>

													<div class="vcex-posttype-slider-title entry-title wpex-em-18px">
														<a href="<?php wpex_permalink(); ?>" title="<?php wpex_esc_title(); ?>" class="title"><?php the_title(); ?></a>
													</div><!-- .entry-title -->

											<?php endif; ?>

											<?php
											// Meta
											if ( 'true' == $meta ) : ?>

												<ul class="vcex-posttypes-slider-meta meta clr">

													<?php if ( 'staff' == $post_type && $postion = get_post_meta( $post_id, 'wpex_staff_position', true ) ) : ?>
														<div class="staff-position">
															<?php echo $postion; ?>
														</div>
													<?php endif; ?>

													<?php if ( 'staff' != $post_type ) : ?>

														<li class="meta-date"><span class="fa fa-clock-o"></span><span class="updated"><?php echo get_the_date(); ?></span></li>

														<li class="meta-author"><span class="fa fa-user"></span><span class="vcard author"><?php the_author_posts_link(); ?></span></li>

														<?php
														// Display category
														if ( 'yes' != $tax_query ) : ?>

															<?php $category = wpex_get_post_type_cat_tax( $post_type ); ?>

															<?php if ( $category ) { ?>
																<li class="meta-category"><span class="fa fa-folder-o"></span><?php wpex_list_post_terms( $category ); ?></li>
															<?php } ?>

														<?php endif; ?>

													<?php endif; ?>

												</ul><!-- .vcex-posttype-slider-meta -->

											<?php endif; ?>

										</header>

									<?php endif; ?>
									
									<?php
									// Display excerpt
									if ( 'true' == $excerpt && $excerpt_length ) : ?>

										<div class="excerpt clr">
											<?php wpex_excerpt( array (
												'length' => $excerpt_length,
											) ); ?>
										</div><!-- .excerpt -->

									<?php endif; ?>

								</div><!-- .vcex-img-flexslider-caption -->

							<?php endif; ?>

					</div><!-- .wpex-slider-media -->

				</div><!-- .wpex-slider-slide -->

			<?php endwhile; ?>
			
		</div><!-- .wpex-slider-slides -->

		<?php if ( 'true' == $control_thumbs ) : ?>

			<div class="wpex-slider-thumbnails sp-thumbnails">

				<?php foreach ( $posts_cache as $post_id ) : ?>

					<?php
					// Output thumbnail image
					wpex_post_thumbnail( array(
						'attachment' => get_post_thumbnail_id( $post_id ),
						'size'       => $img_size,
						'crop'       => $img_crop,
						'width'      => $img_width,
						'height'     => $img_height,
						'class'      => 'wpex-slider-thumbnail sp-thumbnail',
					) ); ?>

				<?php endforeach; ?>

			</div><!-- .wpex-slider-thumbnails -->

		<?php endif; ?>

	</div><!-- .<?php echo $wrap_classes; ?> -->

	<?php
	// Close css wrapper
	if ( $css ) echo '</div>'; ?>

	<?php
	// Reset the post data to prevent conflicts with WP globals
	wp_reset_postdata(); ?>

<?php
// If no posts are found display message
else : ?>

	<?php
	// Display no posts found error if function exists
	echo vcex_no_posts_found_message( $atts ); ?>

<?php
// End post check
endif; ?>