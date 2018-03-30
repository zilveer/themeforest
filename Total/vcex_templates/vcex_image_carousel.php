<?php
/**
 * Visual Composer Image Carousel
 *
 * @package Total WordPress Theme
 * @subpackage VC Templates
 * @version 3.5.3
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

// Define output var
$output = '';

// Get and extract shortcode attributes
extract( vc_map_get_attributes( 'vcex_image_carousel', $atts ) );

// Output var
$output = '';

// Set image ids
$image_ids = ( 'true' == $post_gallery ) ? wpex_get_gallery_ids() : $image_ids;

// If there aren't any images lets display a notice
if ( empty( $image_ids ) ) {
	return;
}

// Otherwise if there are images lets turn it into an array
else {

	// Get image ID's
	if ( ! is_array( $image_ids ) ) {
		$attachment_ids = explode( ',', $image_ids );
	} else {
		$attachment_ids = $image_ids;
	}

}

// Remove duplicate images
$attachment_ids = array_unique( $attachment_ids );

// Turn links into array
if ( $custom_links ) {
	$custom_links = explode( ',', $custom_links );
} else {
	$custom_links = array();
}

// Count items
$attachment_ids_count = count( $attachment_ids );
$custom_links_count   = count( $custom_links );

// Add empty values to custom_links array for images without links
if ( $attachment_ids_count > $custom_links_count ) {
	$count = 0;
	foreach( $attachment_ids as $val ) {
		$count++;
		if ( ! isset( $custom_links[$count] ) ) {
			$custom_links[$count] = '#';
		}
	}
}

// New custom links count
$custom_links_count = count( $custom_links );

// Remove extra custom links
if ( $custom_links_count > $attachment_ids_count ) {
	$count = 0;
	foreach( $custom_links as $key => $val ) {
		$count ++;
		if ( $count > $attachment_ids_count ) {
			unset( $custom_links[$key] );
		}
	}
}

// Set links as the keys for the images
$images_links_array = array_combine( $attachment_ids, $custom_links );

// Return if no images
if ( ! $images_links_array ) {
	return;
}

// Randomize images
if ( 'true' == $randomize_images ) {
	$orderby = 'rand';
} else {
	$orderby = 'post__in';
}

// Lets create a new Query so the image grid can be paginated
$my_query = new WP_Query( array(
	'post_type'      => 'attachment',
	//'post_mime_type'    => 'image/jpeg,image/gif,image/jpg,image/png',
	'post_status'    => 'any',
	'posts_per_page' => -1,
	'paged'          => NULL,
	'no_found_rows'  => true,
	'post__in'       => $attachment_ids,
	'orderby'        => $orderby,
) );


// Display carousel if there are images
if ( $my_query->have_posts() ) :

	// Inline js array
	$inline_js = array( 'carousel' );

	// Main Classes
	$wrap_classes = array( 'wpex-carousel', 'wpex-carousel-images', 'clr', 'owl-carousel' );

	// Carousel style
	if ( $style && 'default' != $style ) {
		$wrap_classes[] = $style;
		$arrows_position = ( 'no-margins' == $style && 'default' == $arrows_position ) ? 'abs' : $arrows_position;
	}

	// Arrow style
	if ( $arrows_style ) {
		$wrap_classes[] = 'arrwstyle-'. $arrows_style;
	}

	// Arrow position
	if ( $arrows_position && 'default' != $arrows_position ) {
		$wrap_classes[] = 'arrwpos-'. $arrows_position;
	}

	// Rounded
	if ( 'yes' == $rounded_image ) {
		$wrap_classes[] = 'wpex-rounded-images';
	}

	// Custom classes
	if ( $classes ) {
		$wrap_classes[] = vcex_get_extra_class( $classes );
	}

	// Entry classes
	$entry_classes = 'wpex-carousel-slide';
	if ( $entry_css ) {
		$entry_classes .= ' '. vc_shortcode_custom_css_class( $entry_css );
	}

	// Image Classes
	$img_classes = array( 'wpex-carousel-entry-media', 'clr' );
	if ( $overlay_style ) {
		$img_classes[] = wpex_overlay_classes( $overlay_style );
	}
	if ( $img_filter ) {
		$img_classes[] = wpex_image_filter_class( $img_filter );
	}
	if ( $img_hover_style ) {
		$img_classes[] = wpex_image_hover_classes( $img_hover_style );
	}

	// Lightbox css/js/classes
	if ( 'lightbox' == $thumbnail_link ) {
		vcex_enque_style( 'ilightbox', $lightbox_skin );
		$inline_js[] = 'carousel_lightbox';
		$wrap_classes[] = 'wpex-carousel-lightbox';
	}

	// Items to scroll fallback for old setting
	if ( 'page' == $items_scroll ) {
		$items_scroll = $items;
	}

	// Title design
	if ( 'yes' == $title ) {
		$heading_style = vcex_inline_style( array(
			'margin'         => $content_heading_margin,
			'text_transform' => $content_heading_transform,
			'font_weight'    => $content_heading_weight,
			'font_size'      => $content_heading_size,
			'color'          => $content_heading_color,
		) );
	}

	// Content Design
	if ( 'yes' == $title || 'yes' == $caption ) {

		// Defined var
		$content_style = '';

		// Non css_editor fields
		if ( $content_alignment ) {
			$content_style = array(
				'text_align' => $content_alignment,
			);
		}

		// Deprecated fields
		if ( ! $content_css ) {
			if ( isset( $content_background ) ) {
				$content_style['background'] = $content_background;
			}
			if ( isset( $content_padding ) ) {
				$content_style['padding'] = $content_padding;
			}
			if ( isset( $content_margin ) ) {
				$content_style['margin'] = $content_margin;
			}
			if ( isset( $content_border ) ) {
				$content_style['border'] = $content_border;
			}
		} else {
			$content_css = vc_shortcode_custom_css_class( $content_css ); // Custom CSS class
		}

		// Generate inline style
		if ( $content_style ) {
			$content_style = vcex_inline_style( $content_style );
		}
		
	}

	// Sanitize carousel data to prevent errors
	$arrows                 = wpex_esc_attr( $arrows, 'true' );
	$dots                   = wpex_esc_attr( $dots, 'false' );
	$auto_play              = wpex_esc_attr( $auto_play, 'false' );
	$infinite_loop          = wpex_esc_attr( $infinite_loop, 'true' );
	$auto_height            = wpex_esc_attr( $auto_height, 'false' );
	$center                 = wpex_esc_attr( $center, 'false' );
	$items                  = wpex_intval( $items, 4 );
	$items_scroll           = wpex_intval( $items_scroll, 1 );
	$timeout_duration       = wpex_intval( $timeout_duration, 5000 );
	$items_margin           = wpex_intval( $items_margin, 15 );
	$items_margin           = ( 'no-margins' == $style ) ? 0 : $items_margin;
	$tablet_items           = wpex_intval( $tablet_items, 3 );
	$mobile_landscape_items = wpex_intval( $mobile_landscape_items, 2 );
	$mobile_portrait_items  = wpex_intval( $mobile_portrait_items, 1 );
	$animation_speed        = wpex_intval( $animation_speed, 150 );

	// Prevent auto play in visual composer
	if ( wpex_is_front_end_composer() ) {
		$auto_play = 'false';
	}

	// Implode arrays
	$wrap_classes = implode( ' ', $wrap_classes );
	$img_classes  = implode( ' ', $img_classes );

	// Load inline js
	vcex_inline_js( $inline_js );

	// Open wrapper for auto height
	if ( 'true' == $auto_height ) {
		$output .= '<div class="owl-wrapper-outer">';
	}

	// Begin output
	$output .= '<div'. vcex_html( 'id_attr', $unique_id ) .' class="'. esc_attr( $wrap_classes ) .'" data-items="'. $items .'" data-slideby="'. $items_scroll .'" data-nav="'. $arrows .'" data-dots="'. $dots .'" data-autoplay="'. $auto_play .'" data-loop="'. $infinite_loop .'" data-autoplay-timeout="'. $timeout_duration .'" data-center="'. $center .'" data-margin="'. intval( $items_margin ) .'" data-items-tablet="'. $tablet_items .'" data-items-mobile-landscape="'. $mobile_landscape_items .'" data-items-mobile-portrait="'. $mobile_portrait_items .'" data-smart-speed="'. $animation_speed .'" data-auto-height="'. $auto_height .'">';
		
		// Loop through images
		$count=0;
		while ( $my_query->have_posts() ) :
			$count++;

			// Get post from query
			$my_query->the_post();

			// Attachment VARS
			$atts['post_id']      = get_the_ID();
			$atts['post_data']    = wpex_get_attachment_data( $atts['post_id'] );
			$atts['post_link']    = $atts['post_data']['url'];
			$atts['post_alt']     = esc_attr( $atts['post_data']['alt'] );
			$atts['post_caption'] = $atts['post_data']['caption'];

			// Pluck array to see if item has custom link
			$atts['post_url'] = $images_links_array[$atts['post_id']];

			// Validate URl
			$atts['post_url'] = ( '#' !== $atts['post_url'] ) ? esc_url( $atts['post_url'] ) : '';

			// Get correct title
			if ( 'title' == $title_type ) {
				$attachment_title = get_the_title();
			} elseif ( 'alt' == $title_type ) {
				$attachment_title = esc_attr( $atts['post_data']['alt'] );
			} else {
				$attachment_title = get_the_title();
			}
			
			// Image output
			$image_output = wpex_get_post_thumbnail( array(
				'attachment' => $atts['post_id'],
				'crop'       => $img_crop,
				'size'       => $img_size,
				'width'      => $img_width,
				'height'     => $img_height,
				'alt'        => $atts['post_alt'],
			) );

			$output .= '<div class="'. $entry_classes .'">';

				$output .= '<figure class="'. $img_classes .'">';

					// Add custom links to attributes for use with the overlay styles
					if ( 'custom_link' == $thumbnail_link && $atts['post_url'] ) {
						$atts['overlay_link'] = $atts['post_url'];
					}

					// Lightbox
					if ( 'lightbox' == $thumbnail_link ) :

						// Main link attributes
						$link_attrs = array(
							'href'  => wpex_get_lightbox_image( $atts['post_id'] ),
							'title' => $atts['post_alt'],
							'class' => 'wpex-carousel-entry-img',
						);

						// Main link lightbox attributes
						if ( 'lightbox' == $thumbnail_link ) {
							$link_attrs['class']     .= ' wpex-carousel-lightbox-item';
							$link_attrs['data-title'] = $atts['post_alt'];
							$link_attrs['data-count'] = $count;
							$link_attrs['data-type']  = 'image';
							if ( $lightbox_skin ) {
								$link_attrs['data-skin'] = $lightbox_skin;
							}

							if ( 'false' != $lightbox_title ) {
								if ( 'title' == $lightbox_title ) {
									$link_attrs['data-title'] = strip_tags( get_the_title( $atts['post_id'] ) );
								} elseif ( 'alt' == $lightbox_title ) {
									$link_attrs['data-title'] = $atts['post_alt'];
								}
							} else {
								$link_attrs['data-show_title']  = 'false';
							}

							// Caption data
							if ( 'false' != $lightbox_caption && $attachment_caption = get_post_field( 'post_excerpt', $atts['post_id'] ) ) {
								$link_attrs['data-caption'] = str_replace( '"',"'", $attachment_caption );
							}

						}

						$output .= '<a '. wpex_parse_attrs( $link_attrs ) .'>';

							$output .= $image_output;

							ob_start();
							wpex_overlay( 'inside_link', $overlay_style, $atts );
							$output .= ob_get_clean();

						$output .= '</a>';


					// Custom Link
					elseif ( 'custom_link' == $thumbnail_link && $atts['post_url'] ) :

						$output .= '<a href="'. esc_url( $atts['post_url'] ) .'" title="'. esc_attr( $atts['post_alt'] ) .'" class="wpex-carousel-entry-img"'. vcex_html( 'target_attr', $custom_links_target ) .'>';

							$output .= $image_output;

							ob_start();
							wpex_overlay( 'inside_link', $overlay_style, $atts );
							$output .= ob_get_clean();

						$output .= '</a>';

					// No link
					else :

						$output .= $image_output;

						ob_start();
						wpex_overlay( 'inside_link', $overlay_style, $atts );
						$output .= ob_get_clean();

					endif;

					// Outside link overlay html
					ob_start();
					wpex_overlay( 'outside_link', $overlay_style, $atts );
					$output .= ob_get_clean();

				$output .= '</figure>';

				// Display details
				if ( ( 'yes' == $title && $attachment_title ) || (  'yes' == $caption && $atts['post_caption'] ) ) :

					$classes = 'wpex-carousel-entry-details clr';
					if ( $content_css ) {
						$classes .= ' '. $content_css;
					}

					$output .= '<div class="'. $classes .'"'. $content_style .'>';

						// Display title
						if ( 'yes' == $title && $attachment_title ) :

							$output .= '<div class="wpex-carousel-entry-title entry-title"'. $heading_style .'>';
								$output .= esc_html( $attachment_title );
							$output .= '</div>';

						endif;

						// Display caption
						if ( 'yes' == $caption && $atts['post_caption'] ) :

							$output .= '<div class="wpex-carousel-entry-excerpt clr">';
								$output .= wp_kses_post( $atts["post_caption"] );
							$output .= '</div>';

						endif;
					
					$output .= '</div>';

				endif;

			$output .= '</div>';

		endwhile;

	$output .= '</div>';

	// Close wrap for single item auto height
	if ( 'true' == $auto_height ) {
		$output .= '</div>';
	}

	// Reset the post data to prevent conflicts with WP globals
	wp_reset_postdata();

	// Output shortcode html
	echo $output;

// End Query
endif;