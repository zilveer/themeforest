<?php
/**
 * Shortcode attributes
 * @var $atts
 * @var $title
 * @var $source
 * @var $image
 * @var $custom_src
 * @var $onclick
 * @var $img_size
 * @var $external_img_size
 * @var $caption
 * @var $img_link_large
 * @var $link
 * @var $img_link_target
 * @var $alignment
 * @var $el_class
 * @var $css_animation
 * @var $style
 * @var $external_style
 * @var $border_color
 * @var $css
 * Shortcode class
 * @var $this WPBakeryShortCode_VC_Single_image
 */

$atts = vc_map_get_attributes( $this->getShortcode(), $atts );
extract( $atts );

$default_src = vc_asset_url( 'vc/no_image.png' );

// backward compatibility. since 4.6
if ( empty( $onclick ) && isset( $img_link_large ) && 'yes' === $img_link_large ) {
	$onclick = 'img_link_large';
} else if ( empty( $atts['onclick'] ) && ( ! isset( $atts['img_link_large'] ) || 'yes' !== $atts['img_link_large'] ) ) {
	$onclick = 'custom_link';
}

if ( 'external_link' === $source ) {
	$style = $external_style;
}

$border_color = ( $border_color !== '' ) ? ' vc_box_border_' . $border_color : '';

$img = false;

switch ( $source ) {
	case 'media_library':
	case 'featured_image':

		if ( 'featured_image' === $source ) {
			$post_id = get_the_ID();
			if ( $post_id && has_post_thumbnail( $post_id ) ) {
				$img_id = get_post_thumbnail_id( $post_id );
			} else {
				$img_id = 0;
			}
		} else {
			$img_id = preg_replace( '/[^\d]/', '', $image );
		}

		// set rectangular
		if ( preg_match( '/_circle_2$/', $style ) ) {
			$style = preg_replace( '/_circle_2$/', '_circle', $style );
			$img_size = $this->getImageSquareSize( $img_id, $img_size );
		}

		if ( ! $img_size ) {
			$img_size = 'medium';
		}

		$img = wpb_getImageBySize( array(
			'attach_id' => $img_id,
			'thumb_size' => $img_size,
			'class' => 'vc_single_image-img'
		) );

		// don't show placeholder in public version if post doesn't have featured image
		if ( 'featured_image' === $source ) {
			if ( ! $img && 'page' === vc_manager()->mode() ) {
				return;
			}
		}

		break;

	case 'external_link':
		$dimensions = vcExtractDimensions( $external_img_size );
		$hwstring = $dimensions ? image_hwstring( $dimensions[0], $dimensions[1] ) : '';

		$custom_src = $custom_src ? esc_attr( $custom_src ) : $default_src;

		$img = array(
			'thumbnail' => '<img class="vc_single_image-img" ' . $hwstring . ' src="' . $custom_src . '" />'
		);
		break;

	default:
		$img = false;
}

if ( ! $img ) {
	$img['thumbnail'] = '<img class="vc_img-placeholder vc_single_image-img" src="' . $default_src . '" />';
}

$el_class = $this->getExtraClass( $el_class );

// backward compatibility
if ( vc_has_class( 'prettyphoto', $el_class ) ) {
	$onclick = 'link_image';
}

// backward compatibility. will be removed in 4.7+
if ( ! empty( $atts['img_link'] ) ) {
	$link = $atts['img_link'];
	if ( ! preg_match( '/^(https?\:\/\/|\/\/)/', $link ) ) {
		$link = 'http://' . $link;
	}
}

// backward compatibility
if ( in_array( $link, array( 'none', 'link_no' ) ) ) {
	$link = '';
}

$a_attrs = array();

// CUSTOM LIGHTBOX VIDEO - TOTAL SETTINGS
if ( ! empty( $lightbox_video ) ) {

	// Load lightbox skin
	wpex_enqueue_ilightbox_skin();

	// Esc lightbox video
	$lightbox_video = esc_url( $lightbox_video );

	// Get lightbox dims
	$lightbox_dimensions = vcex_parse_lightbox_dims( $lightbox_dimensions );

	if ( $lightbox_iframe_type ) {

		// Add lightbox class
		$a_attrs['class'] = 'wpex-lightbox';

		if ( 'video_embed' == $lightbox_iframe_type ) {
			$a_attrs['class'] = 'wpex-lightbox';
			$video_embed_url = wpex_sanitize_data( $lightbox_video, 'embed_url' );
			$lightbox_video = $video_embed_url ? $video_embed_url : $lightbox_video;
			$a_attrs['data-type'] = 'iframe';
			$a_attrs['data-options'] = $lightbox_dimensions;
			vcex_inline_js( 'ilightbox_single' );
		} elseif ( 'url' == $lightbox_iframe_type ) {
			$a_attrs['data-type'] = 'iframe';
			$a_attrs['data-options'] = $lightbox_dimensions;
		} elseif ( 'html5' == $lightbox_iframe_type ) {
			$poster = wp_get_attachment_image_src( $img_id, 'full');
			$poster = $poster[0];
			$a_attrs['data-type'] = 'video';
			$a_attrs['data-options'] = $lightbox_dimensions .',html5video: { webm: \''. $lightbox_video_html5_webm .'\', poster: \''. $poster .'\' }';
		} elseif ( 'quicktime' == $lightbox_iframe_type ) {
			$a_attrs['data-type'] = 'video';
			$a_attrs['data-options'] = $lightbox_dimensions;
		}

	}

	// Auto detect style
	else {

		// Add correct link class
		$a_attrs['class'] = 'wpex-lightbox-autodetect';

	}

	// Update link
	$link = $lightbox_video;
	
	// Set var to false to prevent stuff below
	$onclick = false;

}
// CUSTOM LIGHTBOX END - TOTAL SETTINGS


// CUSTOM LIGHTBOX IMG - TOTAL SETTINGS
if ( ! empty( $lightbox_custom_img ) ) {

	// Load lightbox skin and inline js
	wpex_enqueue_ilightbox_skin();
	vcex_inline_js( 'ilightbox_single' );

	// Alter link
	$lightbox_custom_img_src = wp_get_attachment_image_src( $lightbox_custom_img, 'full' );

	if ( isset( $lightbox_custom_img_src[0] ) ) {
		$link = $lightbox_custom_img_src[0];
	}

	// Add lightbox class
	$a_attrs['class'] = 'wpex-lightbox';
	$a_attrs['data-caption'] = wpex_get_attachment_data( $lightbox_custom_img, 'caption' );

	// Remove onclick
	$onclick = null;

}
// CUSTOM LIGHTBOX IMG END - TOTAL SETTINGS

// CUSTOM LIGHTBOX GALLERY - TOTAL SETTINGS
if ( ! empty( $lightbox_gallery ) ) {

	// Load lightbox skin and inline js
	wpex_enqueue_ilightbox_skin();
	vcex_inline_js( 'ilightbox_custom_gallery' );
	
	// Add correct link class
	$a_attrs['class'] = 'wpex-lightbox-gallery';

	// Create gallery
	$gallery_ids = explode( ",",$lightbox_gallery );
	if ( $gallery_ids && is_array( $gallery_ids ) ) {
		$gallery_images = '';
		$count=0;
		foreach ( $gallery_ids as $id ) {
			$count++;
			if ( $count != count( $gallery_ids ) ) {
				$gallery_images .= wp_get_attachment_url( $id ) . ',';
			} else {
				$gallery_images .= wp_get_attachment_url( $id );
			}
		}
		$a_attrs['data-gallery'] = $gallery_images;
	}

	// Link to nothing
	$link = '#';


}
// CUSTOM LIGHTBOX GALLERY END - TOTAL SETTINGS

switch ( $onclick ) {
	case 'img_link_large':

		if ( 'external_link' === $source ) {
			$link = $custom_src;
		} elseif ( function_exists( 'wpex_get_lightbox_image' ) ) {
			$link = wpex_get_lightbox_image( $img_id );
		} else {
			$link = wp_get_attachment_image_src( $img_id, 'large' );
			$link = $link[0];
		}

		// Add class for Total theme
		vcex_inline_js( 'ilightbox_single' );
		wpex_enqueue_ilightbox_skin();
		$a_attrs['class'] = 'wpex-lightbox';

		break;

	case 'link_image':
		wp_enqueue_script( 'prettyphoto' );
		wp_enqueue_style( 'prettyphoto' );

		$a_attrs['class'] = 'prettyphoto';
		$a_attrs['rel'] = 'prettyPhoto[rel-' . get_the_ID() . '-' . rand() . ']';

		// backward compatibility
		if ( vc_has_class( 'prettyphoto', $el_class ) ) {
			// $link is already defined
		} else if ( 'external_link' === $source ) {
			$link = $custom_src;
		} else {
			$link = wp_get_attachment_image_src( $img_id, 'large' );
			$link = $link[0];
		}

		break;

	case 'custom_link':
		// $link is already defined
		break;

	case 'zoom':
		wp_enqueue_script( 'vc_image_zoom' );

		if ( 'external_link' === $source ) {
			$large_img_src = $custom_src;
		} else {
			$large_img_src = wp_get_attachment_image_src( $img_id, 'large' );
			if ( $large_img_src ) {
				$large_img_src = $large_img_src[0];
			}
		}

		$img['thumbnail'] = str_replace( '<img ', '<img data-vc-zoom="' . $large_img_src . '" ', $img['thumbnail'] );

		break;
}

// backward compatibility
if ( vc_has_class( 'prettyphoto', $el_class ) ) {
	$el_class = vc_remove_class( 'prettyphoto', $el_class );
}

// Image Filter - TOTAL THEME
if ( ! empty( $img_filter ) ) {
	$img_filter = ' '. wpex_image_filter_class( $img_filter );
}

// Image - Hover
if ( ! empty( $img_hover ) ) {
	$img_hover = ' '. wpex_image_hover_classes( $img_hover );
}

$html = ( 'vc_box_shadow_3d' === $style ) ? '<span class="vc_box_shadow_3d_wrap">' . $img['thumbnail'] . '</span>' : $img['thumbnail'];

// TOTAL OVERLAY CAPTION
if ( $img_caption ) {
    $html .='<span class="wpb_single_image_caption">'. $img_caption .'</span>';
}
// TOTAL OVERLAY CAPTION END
$wrapper_classes = 'vc_single_image-wrapper';
if ( $style ) {
	$wrapper_classes .= ' '. $style;
	$wrapper_classes .= ' '. $border_color;
}
if ( $img_filter ) {
	$wrapper_classes .= ' '. $img_filter;
}
if ( $img_hover ) {
	$wrapper_classes .= ' '. $img_hover;
}
$html = '<div class="'. $wrapper_classes .'">' . $html . '</div>';

// Get title attribute from image
$img_title = wpex_get_attachment_data( $img_id, 'alt' );
if ( $img_title ) {
	$a_attrs['title'] = $img_title;
}

if ( $link ) {
	$a_attrs['href'] = $link;
	if ( 'local' != $img_link_target ) {
		$a_attrs['target'] = $img_link_target;
	} else {
		$a_attrs['class'] = 'local-scroll-link';
	}
	$html = '<a ' . vc_stringify_attributes( $a_attrs ) . '>' . $html . '</a>';
}

$class_to_filter = 'wpb_single_image wpb_content_element vc_align_' . $alignment . ' ' . $this->getCSSAnimation( $css_animation );
$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $atts );

if ( in_array( $source, array( 'media_library', 'featured_image' ) ) && 'yes' === $add_caption ) {
	$post = get_post( $img_id );
	$caption = $post->post_excerpt;
} else if ( 'external_link' === $source ) {
	$add_caption = 'yes';
}

if ( 'yes' === $add_caption && '' !== $caption ) {
	$html = '
		<figure class="vc_figure">
			' . $html . '
			<figcaption class="vc_figure-caption">' . esc_html( $caption ) . '</figcaption>
		</figure>
	';
}

$output = '
	<div class="' . esc_attr( trim( $css_class ) ) . '">
		<div class="wpb_wrapper">
			' . wpb_widget_title( array(
					'title' => $title,
					'extraclass' => 'wpb_singleimage_heading'
				) ) . '
			' . $html . '
		</div>
	</div>
';

echo $output;