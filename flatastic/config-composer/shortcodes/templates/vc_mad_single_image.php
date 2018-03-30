<?php

class WPBakeryShortCode_VC_mad_single_image extends WPBakeryShortCode {

	public $atts = array();

	protected function content($atts, $content = null) {

		$this->atts = shortcode_atts(array(
			'title' => '',
			'source' => 'media_library',
			'image' => '',
			'custom_src' => '',
			'img_size' => '',
			'external_img_size' => '',
			'alignment' => '',
			'onclick' => '',
			'link' => '',
			'img_link_target' => '',
			'css' => ''
		), $atts, 'vc_mad_single_image');

		return $this->html();
	}

	public function html() {

		$output = $el_class = $image = $img_size = $img_link_target = $link = $img_link_large = $title = $alignment = '';
		$source = $custom_src = $onclick = $external_img_size = $css = '';

		extract($this->atts);

		$atts = $this->atts;

		$zoom_image = mad_custom_get_option('zoom_image', '');

		$default_src = vc_asset_url( 'vc/no_image.png' );

		// backward compatibility. since 4.6
		if ( empty( $onclick ) && isset( $img_link_large ) && 'yes' === $img_link_large ) {
			$onclick = 'img_link_large';
		} else if ( empty( $atts['onclick'] ) && ( ! isset( $atts['img_link_large'] ) || 'yes' !== $atts['img_link_large'] ) ) {
			$onclick = 'custom_link';
		}

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

		switch ( $onclick ) {
			case 'img_link_large':

				if ( 'external_link' === $source ) {
					$link = $custom_src;
				} else {
					$link = wp_get_attachment_image_src( $img_id, 'large' );
					$link = $link[0];
				}

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
		}

		// backward compatibility
		if ( vc_has_class( 'prettyphoto', $el_class ) ) {
			$el_class = vc_remove_class( 'prettyphoto', $el_class );
		}

		$html = $img['thumbnail'];
		$html = '<div class="vc_single_image-wrapper">' . $html . '</div>';

		if ( $link ) {
			$a_attrs['href'] = $link;
			$a_attrs['target'] = $img_link_target;
			$html = '<a ' . vc_stringify_attributes( $a_attrs ) . '>' . $html . '</a>';
		}

		$class_to_filter = 'wpb_single_image wpb_content_element vc_align_' . $alignment;
		$class_to_filter .= vc_shortcode_custom_css_class( $css, ' ' ) . $this->getExtraClass( $el_class );
		$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, $class_to_filter, $this->settings['base'], $this->atts );

		$output .= "\n\t" . '<div class="' . esc_attr( trim( $css_class ) ) . '">';
		$output .= "\n\t\t" . '<div class="wpb_wrapper">';
		$output .= "\n\t\t\t" . wpb_widget_title(array('title' => $title, 'extraclass' => 'wpb_singleimage_heading'));
		$output .= "\n\t\t\t\t" . '<div class="image-overlay ' . esc_attr($zoom_image) . '">';
			$output .= "\n\t\t\t\t\t" . '<div class="photoframe wrapper">';
				$output .= "\n\t\t\t" . $html;
			$output .= "\n\t\t\t\t\t" . '</div>';
		$output .= "\n\t\t\t\t" . '</div>';
		$output .= "\n\t\t" . '</div> ' . $this->endBlockComment( '.wpb_wrapper' );
		$output .= "\n\t" . '</div> ' . $this->endBlockComment( '.wpb_single_image' );

		return $output;
	}

}