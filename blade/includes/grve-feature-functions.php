<?php

/*
*	Feature Helper functions
*
* 	@version	1.0
* 	@author		Greatives Team
* 	@URI		http://greatives.eu
*/


/**
 * Get Validate Header Style
 */

function blade_grve_validate_header_style( $grve_header_style ) {

	$header_styles = array( 'default', 'dark', 'light' );
	if ( !in_array( $grve_header_style, $header_styles ) ) {
		$grve_header_style = 'default';
	}
	return $grve_header_style;

}

/**
 * Get Header Feature Header Section Data
 */

function blade_grve_get_feature_header_data() {
	global $post;

	$grve_header_position = 'above';
	if( blade_grve_is_woo_tax() ) {
		$grve_header_style = blade_grve_option( 'product_tax_header_style', 'default' );
		$grve_header_overlapping = blade_grve_option( 'product_tax_header_overlapping', 'no' );

	} else {
		$grve_header_style = blade_grve_option( 'blog_header_style', 'default' );
		$grve_header_overlapping = blade_grve_option( 'blog_header_overlapping', 'no' );
	}

	$feature_size = '';

	$grve_woo_shop = blade_grve_is_woo_shop();

	if ( is_search() ) {

		if ( blade_grve_visibility( 'search_page_custom_header_title' ) ) {
			$grve_header_style =  blade_grve_option( 'search_page_header_style' );
			$grve_header_overlapping =  blade_grve_option( 'search_page_header_overlapping' );
		} else {
			$grve_header_style =  blade_grve_option( 'page_header_style' );
			$grve_header_overlapping =  blade_grve_option( 'page_header_overlapping' );
		}
	}

	if ( is_singular() || $grve_woo_shop ) {

		if ( $grve_woo_shop ) {
			$post_id = wc_get_page_id( 'shop' );
		} else {
			$post_id = $post->ID;
		}
		$post_type = get_post_type( $post_id );

		switch( $post_type ) {
			case 'product':
				$grve_header_style =  blade_grve_post_meta( 'grve_header_style', blade_grve_option( 'product_header_style' ) );
				$grve_header_overlapping =  blade_grve_post_meta( 'grve_header_overlapping', blade_grve_option( 'product_header_overlapping' ) );
			break;
			case 'portfolio':
				$grve_header_style =  blade_grve_post_meta( 'grve_header_style', blade_grve_option( 'portfolio_header_style' ) );
				$grve_header_overlapping =  blade_grve_post_meta( 'grve_header_overlapping', blade_grve_option( 'portfolio_header_overlapping' ) );
			break;
			case 'post':
				$grve_header_style =  blade_grve_post_meta( 'grve_header_style', blade_grve_option( 'post_header_style' ) );
				$grve_header_overlapping =  blade_grve_post_meta( 'grve_header_overlapping', blade_grve_option( 'post_header_overlapping' ) );
			break;
			case 'page':
			default:
				if ( $grve_woo_shop ) {
					$grve_header_style =  blade_grve_post_meta_shop( 'grve_header_style', blade_grve_option( 'page_header_style' ) );
					$grve_header_overlapping =  blade_grve_post_meta_shop( 'grve_header_overlapping', blade_grve_option( 'page_header_overlapping' ) );
				} else {
					$grve_header_style =  blade_grve_post_meta( 'grve_header_style', blade_grve_option( 'page_header_style' ) );
					$grve_header_overlapping =  blade_grve_post_meta( 'grve_header_overlapping', blade_grve_option( 'page_header_overlapping' ) );
				}
			break;
		}

		//Force Overlapping for Scrolling Full Width Sections Template
		if ( is_page_template( 'page-templates/template-full-page.php' ) ) {
			$grve_header_overlapping = 'yes';
		} else {

			$feature_section_post_types = blade_grve_option( 'feature_section_post_types');

			if ( !empty( $feature_section_post_types ) && in_array( $post_type, $feature_section_post_types ) ) {

				$feature_section = get_post_meta( $post_id, 'grve_feature_section', true );
				$feature_settings = blade_grve_array_value( $feature_section, 'feature_settings' );
				$feature_element = blade_grve_array_value( $feature_settings, 'element' );

				if ( !empty( $feature_element ) ) {

					$feature_single_item = blade_grve_array_value( $feature_section, 'single_item' );
					$grve_header_position = blade_grve_array_value( $feature_settings, 'header_position' );
					if ( 'slider' ==  $feature_element ) {

						$slider_items = blade_grve_array_value( $feature_section, 'slider_items' );
						if ( !empty( $slider_items ) ) {
							$grve_header_style = isset( $slider_items[0]['header_style'] ) ? $slider_items[0]['header_style'] : 'default';
						}

					}
				}
			}
		}
	}

	return array(
		'data_overlap' => $grve_header_overlapping,
		'data_header_position' => $grve_header_position,
		'header_style' => blade_grve_validate_header_style( $grve_header_style ),
	);

}

/**
 * Prints Header Feature Section Page/Post/Portfolio
 */
function blade_grve_print_header_feature() {

	//Skip for  Scrolling Full Width Sections Template
	if ( is_page_template( 'page-templates/template-full-page.php' ) ) {
		return false;
	}

	global $post;

	$grve_woo_shop = blade_grve_is_woo_shop();

	if ( is_singular() || $grve_woo_shop ) {

		if ( $grve_woo_shop ) {
			$post_id = wc_get_page_id( 'shop' );
		} else {
			$post_id = $post->ID;
		}
		$post_type = get_post_type( $post_id );
		$feature_section_post_types = blade_grve_option( 'feature_section_post_types');
		if ( in_array( $post_type, $feature_section_post_types ) ) {

			$feature_section = get_post_meta( $post_id, 'grve_feature_section', true );
			$feature_settings = blade_grve_array_value( $feature_section, 'feature_settings' );
			$feature_element = blade_grve_array_value( $feature_settings, 'element' );

			if ( !empty( $feature_element ) ) {

				$feature_single_item = blade_grve_array_value( $feature_section, 'single_item' );

				switch( $feature_element ) {
					case 'title':
						if ( !empty( $feature_single_item ) ) {
							blade_grve_print_header_feature_single( $feature_settings, $feature_single_item, 'title' );
						}
						break;
					case 'image':
						if ( !empty( $feature_single_item ) ) {
							blade_grve_print_header_feature_single( $feature_settings, $feature_single_item, 'image' );
						}
						break;
					case 'video':
						if ( !empty( $feature_single_item ) ) {
							blade_grve_print_header_feature_single( $feature_settings, $feature_single_item, 'video' );
						}
						break;
					case 'slider':
						$slider_items = blade_grve_array_value( $feature_section, 'slider_items' );
						$slider_settings = blade_grve_array_value( $feature_section, 'slider_settings' );
						if ( !empty( $slider_items ) ) {
							blade_grve_print_header_feature_slider( $feature_settings, $slider_items, $slider_settings );
						}
						break;
					case 'map':
						$map_items = blade_grve_array_value( $feature_section, 'map_items' );
						$map_settings = blade_grve_array_value( $feature_section, 'map_settings' );
						if ( !empty( $map_items ) ) {
							blade_grve_print_header_feature_map( $feature_settings, $map_items, $map_settings );
						}
						break;
					case 'revslider':
						$revslider_alias = blade_grve_array_value( $feature_section, 'revslider_alias' );
						if ( !empty( $revslider_alias ) ) {
							blade_grve_print_header_feature_revslider( $feature_settings, $revslider_alias, $feature_single_item );
						}
						break;
					default:
						break;

				}
			}
		}
	}
}


/**
 * Prints Overlay Container
 */
function blade_grve_print_overlay_container( $item ) {

	$pattern_overlay = blade_grve_array_value( $item, 'pattern_overlay' );
	$color_overlay = blade_grve_array_value( $item, 'color_overlay', 'dark' );
	$color_overlay_custom = blade_grve_array_value( $item, 'color_overlay_custom', '#000000' );
	$color_overlay_custom = blade_grve_get_color( $color_overlay, $color_overlay_custom );
	$opacity_overlay = blade_grve_array_value( $item, 'opacity_overlay', '0' );

	if ( 'default' == $pattern_overlay ) {
		echo '<div class="grve-pattern"></div>';
	}
	if ( '0' != $opacity_overlay ) {
		$overlay_classes = array('grve-bg-overlay');
		$overlay_string = implode( ' ', $overlay_classes );

		echo '<div class="' . esc_attr( $overlay_string ) . '" style="background-color: rgba(' . esc_attr( blade_grve_hex2rgb( $color_overlay_custom ) ) . ',' . esc_attr( $opacity_overlay ) . ');"></div>';
	}
}

/**
 * Prints Background Image Container
 */
function blade_grve_print_bg_image_container( $item ) {

	$bg_position = blade_grve_array_value( $item, 'bg_position', 'center-center' );
	$bg_tablet_sm_position = blade_grve_array_value( $item, 'bg_tablet_sm_position' );

	$bg_image_id = blade_grve_array_value( $item, 'bg_image_id' );

	$full_src = wp_get_attachment_image_src( $bg_image_id, 'blade-grve-fullscreen' );
	$image_url = esc_url( $full_src[0] );
	if( !empty( $image_url ) ) {

		$bg_image_classes = array( 'grve-bg-image' );
		$bg_image_classes[] = 'grve-bg-' . $bg_position;
		if ( !empty( $bg_tablet_sm_position ) ) {
			$bg_image_classes[] = 'grve-bg-tablet-sm-' . $bg_tablet_sm_position;
		}
		$bg_image_classes_string = implode( ' ', $bg_image_classes );

		echo '<div class="' . esc_attr( $bg_image_classes_string ) . '" style="background-image: url(' . esc_url( $image_url ) . ');"></div>';
	}

}


/**
 * Prints Background Video Container
 */
function blade_grve_print_bg_video_container( $item ) {

	$bg_video_webm = blade_grve_array_value( $item, 'video_webm' );
	$bg_video_mp4 = blade_grve_array_value( $item, 'video_mp4' );
	$bg_video_ogv = blade_grve_array_value( $item, 'video_ogv' );
	$bg_video_poster = blade_grve_array_value( $item, 'video_poster', 'no' );
	$bg_image_id = blade_grve_array_value( $item, 'bg_image_id' );

	$loop = blade_grve_array_value( $item, 'video_loop', 'yes' );
	$muted = blade_grve_array_value( $item, 'video_muted', 'yes' );

	$full_src = wp_get_attachment_image_src( $bg_image_id, 'blade-grve-fullscreen' );
	$image_url = esc_url( $full_src[0] );

	$video_poster = '';

	if ( !empty( $image_url ) && 'yes' == $bg_video_poster ) {
		$video_poster = $image_url;
	}

	$video_settings = array(
		'preload' => 'auto',
		'autoplay' => 'yes',
		'loop' => $loop,
		'muted' => $muted,
		'poster' => $video_poster,
	);
	$video_settings = apply_filters( 'blade_grve_feature_video_settings', $video_settings );


	if ( !empty ( $bg_video_webm ) || !empty ( $bg_video_mp4 ) || !empty ( $bg_video_ogv ) ) {
?>
		<div class="grve-bg-video">
			<video <?php echo blade_grve_print_media_video_settings( $video_settings );?>>
			<?php if ( !empty ( $bg_video_webm ) ) { ?>
				<source src="<?php echo esc_url( $bg_video_webm ); ?>" type="video/webm">
			<?php } ?>
			<?php if ( !empty ( $bg_video_mp4 ) ) { ?>
				<source src="<?php echo esc_url( $bg_video_mp4 ); ?>" type="video/mp4">
			<?php } ?>
			<?php if ( !empty ( $bg_video_ogv ) ) { ?>
				<source src="<?php echo esc_url( $bg_video_ogv ); ?>" type="video/ogg">
			<?php } ?>
			</video>
		</div>
<?php
	}

}

/**
 * Get Feature Section data
 */
function blade_grve_get_feature_data( $feature_settings, $item_type, $item_effect = '', $el_class = '' ) {


	$wrapper_attributes = array();

	//Background Color
	$bg_color = blade_grve_array_value( $feature_settings, 'bg_color', 'dark' );
	$bg_color_custom = blade_grve_array_value( $feature_settings, 'bg_color_custom', '#000000' );
	$bg_color_custom = blade_grve_get_color( $bg_color, $bg_color_custom );

	//Data and Style
	if( 'revslider' != $item_type ) {
		$feature_size = blade_grve_array_value( $feature_settings, 'size' );
		$feature_height = blade_grve_array_value( $feature_settings, 'height', '550' );
		if ( !empty($feature_size) ) {
			if ( empty( $feature_height ) ) {
				$feature_height = "550";
			}
			$wrapper_attributes[] = 'data-height="' . esc_attr( $feature_height ) . '"';
			$wrapper_attributes[] = 'style="background-color: ' . esc_attr( $bg_color_custom ) . ';"';
		} else {
			$wrapper_attributes[] = 'style="background-color: ' . esc_attr( $bg_color_custom ) . ';"';
		}
	}

	//Classes
	$feature_item_classes = array( 'grve-with-' . $item_type  );

	if( 'revslider' != $item_type ) {
		if ( empty( $feature_size ) ) {
			$feature_item_classes[] = 'grve-fullscreen';
		} else {
			$feature_item_classes[] = 'grve-custom-size';
		}

		if ( !empty( $item_effect ) ) {
			$feature_item_classes[] = 'grve-bg-' . $item_effect;
		}
	}

	if ( !empty ( $el_class ) ) {
		$feature_item_classes[] = $el_class;
	}
	$feature_item_class_string = implode( ' ', $feature_item_classes );

	//Add Classes
	$wrapper_attributes[] = 'class="' . esc_attr( $feature_item_class_string ) . '"';

	return $wrapper_attributes;
}

/**
 * Get Feature Section data
 */
function blade_grve_get_feature_height( $feature_settings ) {

	//Data and Style
	$feature_style_height = '';

	$feature_size = blade_grve_array_value( $feature_settings, 'size' );
	$feature_height = blade_grve_array_value( $feature_settings, 'height', '550' );
	$feature_min_height = blade_grve_array_value( $feature_settings, 'min_height', '320' );
	if ( !empty($feature_size) ) {
		$feature_style_height = 'style="height:' . esc_attr( $feature_height ) . 'px; min-height:' . esc_attr( $feature_min_height ) . 'px;"';
	}
	return $feature_style_height;
}


/**
 * Prints Header Section Feature Single Item
 */
function blade_grve_print_header_feature_single( $feature_settings, $item, $item_type  ) {

	if( 'image' == $item_type ) {
		$item_effect = blade_grve_array_value( $item, 'image_effect' );
	} elseif( 'video' == $item_type ) {
		$item_effect = blade_grve_array_value( $item, 'video_effect' );
	} else {
		$item_effect = '';
	}

	$el_class = blade_grve_array_value( $item, 'el_class' );

	$feature_data = blade_grve_get_feature_data( $feature_settings, $item_type, $item_effect, $el_class );

?>
	<div id="grve-feature-section" <?php echo implode( ' ', $feature_data ); ?>>
		<div class="grve-wrapper clearfix" <?php echo blade_grve_get_feature_height( $feature_settings ); ?>>
			<?php blade_grve_print_header_feature_content( $feature_settings, $item, $item_type ); ?>
		</div>
		<div class="grve-background-wrapper">
		<?php
			blade_grve_print_overlay_container( $item  );
			if( 'image' == $item_type || 'video' == $item_type ) {
				blade_grve_print_bg_image_container( $item );
			}
			if( 'video' == $item_type ) {
				blade_grve_print_bg_video_container( $item );
			}
		?>
		</div>
		<?php blade_grve_print_feature_go_to_section( $feature_settings, $item ); ?>
	</div>
<?php
}

/**
 * Prints Feature Slider
 */
function blade_grve_print_header_feature_slider( $feature_settings, $slider_items, $slider_settings ) {

	$slider_speed = blade_grve_array_value( $slider_settings, 'slideshow_speed', '3500' );
	$slider_pause = blade_grve_array_value( $slider_settings, 'slider_pause', 'no' );
	$slider_transition = blade_grve_array_value( $slider_settings, 'transition', 'slide' );
	$slider_dir_nav = blade_grve_array_value( $slider_settings, 'direction_nav', '1' );
	$slider_effect = blade_grve_array_value( $slider_settings, 'slider_effect', '' );

	$feature_data = blade_grve_get_feature_data( $feature_settings, 'slider', $slider_effect, 'grve-carousel-wrapper'  );

	$grve_header_style = isset( $slider_items[0]['header_style'] ) ? $slider_items[0]['header_style'] : 'default';

?>
	<div id="grve-feature-section" <?php echo implode( ' ', $feature_data ); ?>>

		<?php echo blade_grve_element_navigation( $slider_dir_nav, $grve_header_style ); ?>

		<div id="grve-feature-slider" data-slider-speed="<?php echo esc_attr( $slider_speed ); ?>" data-slider-pause="<?php echo esc_attr( $slider_pause ); ?>" data-slider-transition="<?php echo esc_attr( $slider_transition ); ?>">

<?php

			foreach ( $slider_items as $item ) {

				$header_style = blade_grve_array_value( $item, 'header_style', 'default' );
				$grve_header_style = blade_grve_validate_header_style( $header_style );

				$el_class = blade_grve_array_value( $item, 'el_class' );
				$el_id = blade_grve_array_value( $item, 'id', uniqid() );

?>
				<div class="grve-slider-item grve-slider-item-id-<?php echo esc_attr( $el_id ); ?> <?php echo esc_attr( $el_class ); ?>" data-header-color="<?php echo esc_attr( $grve_header_style ); ?>">
					<div class="grve-wrapper clearfix" <?php echo blade_grve_get_feature_height( $feature_settings ); ?>>
						<?php blade_grve_print_header_feature_content( $feature_settings, $item ); ?>
					</div>
					<div class="grve-background-wrapper">
					<?php
						blade_grve_print_overlay_container( $item  );
						blade_grve_print_bg_image_container( $item );
					?>
					</div>
					<?php blade_grve_print_feature_go_to_section( $feature_settings, $item ); ?>
				</div>
<?php
			}
?>
		</div>

	</div>
<?php

}

/**
 * Prints Header Feature Map
 */
function blade_grve_print_header_feature_map( $feature_settings, $map_items, $map_settings ) {

	wp_enqueue_script( 'blade-grve-googleapi-script');
	wp_enqueue_script( 'blade-grve-maps-script');

	$feature_data = blade_grve_get_feature_data( $feature_settings, 'map' );

	$map_marker = blade_grve_array_value( $map_settings, 'marker', get_template_directory_uri() . '/images/markers/markers.png' );
	$map_zoom = blade_grve_array_value( $map_settings, 'zoom', 14 );
	$map_disable_style = blade_grve_array_value( $map_settings, 'disable_style', 'no' );

	$map_lat = blade_grve_array_value( $map_items[0], 'lat', '51.516221' );
	$map_lng = blade_grve_array_value( $map_items[0], 'lng', '-0.136986' );

?>
	<div id="grve-feature-section" <?php echo implode( ' ', $feature_data ); ?>>
		<div class="grve-map grve-wrapper clearfix" <?php echo blade_grve_get_feature_height( $feature_settings ); ?> data-lat="<?php echo esc_attr( $map_lat ); ?>" data-lng="<?php echo esc_attr( $map_lng ); ?>" data-zoom="<?php echo esc_attr( $map_zoom ); ?>" data-disable-style="<?php echo esc_attr( $map_disable_style ); ?>"></div>
		<?php
			foreach ( $map_items as $map_item ) {
				blade_grve_print_feature_map_point( $map_item, $map_marker );
			}
		?>
	</div>
<?php
}

function blade_grve_print_feature_map_point( $map_item, $default_marker ) {

	$map_lat = blade_grve_array_value( $map_item, 'lat', '51.516221' );
	$map_lng = blade_grve_array_value( $map_item, 'lng', '-0.136986' );
	$map_marker = blade_grve_array_value( $map_item, 'marker', $default_marker );

	$map_title = blade_grve_array_value( $map_item, 'title' );
	$map_infotext = blade_grve_array_value( $map_item, 'info_text','' );
	$map_infotext_open = blade_grve_array_value( $map_item, 'info_text_open', 'no' );

	$button_text = blade_grve_array_value( $map_item, 'button_text' );
	$button_url = blade_grve_array_value( $map_item, 'button_url' );
	$button_target = blade_grve_array_value( $map_item, 'button_target', '_self' );
	$button_class = blade_grve_array_value( $map_item, 'button_class' );

?>
	<div style="display:none" class="grve-map-point" data-point-lat="<?php echo esc_attr( $map_lat ); ?>" data-point-lng="<?php echo esc_attr( $map_lng ); ?>" data-point-marker="<?php echo esc_attr( $map_marker ); ?>" data-point-title="<?php echo esc_attr( $map_title ); ?>" data-point-open="<?php echo esc_attr( $map_infotext_open ); ?>">
		<?php if ( !empty( $map_title ) || !empty( $map_infotext ) || !empty( $button_text ) ) { ?>
		<div class="grve-map-infotext">
			<?php if ( !empty( $map_title ) ) { ?>
			<h6 class="grve-infotext-title"><?php echo esc_html( $map_title ); ?></h6>
			<?php } ?>
			<?php if ( !empty( $map_infotext ) ) { ?>
			<p class="grve-infotext-description"><?php echo wp_kses_post( $map_infotext ); ?></p>
			<?php } ?>
			<?php if ( !empty( $button_text ) ) { ?>
			<a class="grve-infotext-link <?php echo esc_attr( $button_class ); ?>" href="<?php echo esc_url( $button_url ); ?>" target="<?php echo esc_attr( $button_target ); ?>"><?php echo esc_html( $button_text ); ?></a>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
<?php

}

/**
 * Prints Header Feature Revolution Slider
 */
function blade_grve_print_header_feature_revslider( $feature_settings, $revslider_alias, $item  ) {

	$el_class = blade_grve_array_value( $item, 'el_class' );
	$feature_data = blade_grve_get_feature_data( $feature_settings, 'revslider', '', $el_class );

?>
	<div id="grve-feature-section" <?php echo implode( ' ', $feature_data ); ?>>
		<?php echo do_shortcode( '[rev_slider ' . $revslider_alias . ']' ); ?>
		<?php blade_grve_print_feature_go_to_section( $feature_settings, $item ); ?>
	</div>

<?php
}

/**
 * Prints Header Feature Go to Section ( Bottom Arrow )
 */
function blade_grve_print_feature_go_to_section( $feature_settings, $item ) {

	$arrow_enabled = blade_grve_array_value( $item, 'arrow_enabled', 'no' );
	$arrow_color = blade_grve_array_value( $item, 'arrow_color', 'light' );
	$arrow_color_custom = blade_grve_array_value( $item, 'arrow_color_custom', '#ffffff' );
	$arrow_color_custom = blade_grve_get_color( $arrow_color, $arrow_color_custom );
	$arrow_align = blade_grve_array_value( $item, 'arrow_align', 'left' );

	if( 'yes' == $arrow_enabled ) {
?>
		<div id="grve-goto-section-wrapper" class="grve-align-<?php echo esc_attr( $arrow_align ); ?>">
			<div class="grve-container">
				<i id="grve-goto-section" class="grve-icon-arrow-bottom" style=" color: <?php echo esc_attr( $arrow_color_custom ); ?>;"></i>
			</div>
		</div>
<?php
	}

}

/**
 * Prints Header Feature Content Image
 */
function blade_grve_print_feature_content_image( $item ) {

	$media_id = blade_grve_array_value( $item, 'content_image_id', '0' );
	$media_size = blade_grve_array_value( $item, 'content_image_size', 'medium' );

	if( '0' != $media_id ) {
?>
		<div class="grve-graphic clearfix">
			<?php echo wp_get_attachment_image( $media_id, $media_size ); ?>
		</div>
<?php
	}

}


/**
 * Prints Header Section Feature Content
 */
function blade_grve_print_header_feature_content( $feature_settings, $item, $mode = ''  ) {

	$feature_size = blade_grve_array_value( $feature_settings, 'size' );

	$title = blade_grve_array_value( $item, 'title' );
	$caption = blade_grve_array_value( $item, 'caption' );
	$subheading = blade_grve_array_value( $item, 'subheading' );

	$subheading_tag = blade_grve_array_value( $item, 'subheading_tag', 'div' );
	$title_tag = blade_grve_array_value( $item, 'title_tag', 'div' );
	$caption_tag = blade_grve_array_value( $item, 'caption_tag', 'div' );

	$grve_subheading_classes = array( 'grve-subheading', 'clearfix' );
	$grve_title_classes = array( 'grve-title', 'clearfix' );
	$grve_caption_classes = array( 'grve-description', 'clearfix' );

	$subheading_color = blade_grve_array_value( $item, 'subheading_color', 'light' );
	$title_color = blade_grve_array_value( $item, 'title_color', 'light' );
	$caption_color = blade_grve_array_value( $item, 'caption_color', 'light' );

	if ( 'custom' != $subheading_color ) {
		$grve_subheading_classes[] = 'grve-text-' . $subheading_color;
	}
	if ( 'custom' != $title_color ) {
		$grve_title_classes[] = 'grve-text-' . $title_color;
	}
	if ( 'custom' != $caption_color ) {
		$grve_caption_classes[] = 'grve-text-' . $caption_color;
	}

	$grve_subheading_classes = implode( ' ', $grve_subheading_classes );
	$grve_title_classes = implode( ' ', $grve_title_classes );
	$grve_caption_classes = implode( ' ', $grve_caption_classes );

	$content_position = blade_grve_array_value( $item, 'content_position', 'center-center' );
	$content_animation = blade_grve_array_value( $item, 'content_animation', 'fade-in' );

	$button = blade_grve_array_value( $item, 'button' );
	$button2 = blade_grve_array_value( $item, 'button2' );

	$button_text = blade_grve_array_value( $button, 'text' );
	$button_text2 = blade_grve_array_value( $button2, 'text' );

?>
	<div class="grve-content grve-align-<?php echo esc_attr( $content_position ); ?>" data-animation="<?php echo esc_attr( $content_animation ); ?>">
		<div class="grve-container">

			<?php blade_grve_print_feature_content_image( $item ); ?>
			<?php if ( !empty( $subheading ) ) { ?>
			<<?php echo tag_escape( $subheading_tag ); ?> class="<?php echo esc_attr( $grve_subheading_classes ); ?>"><span><?php echo wp_kses_post( $subheading ); ?></span></<?php echo tag_escape( $subheading_tag ); ?>>
			<?php } ?>
			<?php if ( !empty( $title ) ) { ?>
			<<?php echo tag_escape( $title_tag ); ?> class="<?php echo esc_attr( $grve_title_classes ); ?>"><span><?php echo wp_kses_post( $title ); ?></span></<?php echo tag_escape( $title_tag ); ?>>
			<?php } ?>
			<?php if ( !empty( $caption ) ) { ?>
			<<?php echo tag_escape( $caption_tag ); ?> class="<?php echo esc_attr( $grve_caption_classes ); ?>"><span><?php echo wp_kses_post( $caption ); ?></span></<?php echo tag_escape( $caption_tag ); ?>>
			<?php } ?>

			<?php
				if( 'title' != $mode && ( !empty( $button_text ) || !empty( $button_text2 ) ) ) {
				$btn1_class = $btn2_class = 'grve-btn-1';
				if ( !empty( $button_text ) && !empty( $button_text2 ) ) {
					$btn2_class = 'grve-btn-2';
				}
			?>
			<div class="grve-button-wrapper">
				<?php blade_grve_print_feature_button( $button, $btn1_class ); ?>
				<?php blade_grve_print_feature_button( $button2, $btn2_class ); ?>
			</div>
			<?php
				}
			?>
		</div>
	</div>
<?php
}

/**
 * Prints Header Feature Button
 */
function blade_grve_print_feature_button( $item, $extra_class = 'grve-btn-1' ) {

	$button_id = blade_grve_array_value( $item, 'id' );
	$button_text = blade_grve_array_value( $item, 'text' );
	$button_url = blade_grve_array_value( $item, 'url' );
	$button_type = blade_grve_array_value( $item, 'type' );
	$button_size = blade_grve_array_value( $item, 'size', 'medium' );
	$button_color = blade_grve_array_value( $item, 'color', 'primary-1' );
	$button_hover_color = blade_grve_array_value( $item, 'hover_color', 'black' );
	$button_shape = blade_grve_array_value( $item, 'shape', 'square' );
	$button_target = blade_grve_array_value( $item, 'target', '_self' );
	$button_class = blade_grve_array_value( $item, 'class' );

	if ( !empty( $button_text ) ) {

		//Button Classes
		$button_classes = array( 'grve-btn' );

		$button_classes[] = $extra_class;
		$button_classes[] = 'grve-btn-' . $button_size;
		$button_classes[] = 'grve-' . $button_shape;
		if ( 'outline' == $button_type ) {
			$button_classes[] = 'grve-btn-line';
		}
		if ( !empty( $button_class ) ) {
			$button_classes[] = $button_class;
		}
		$button_classes[] = 'grve-bg-' . $button_color;
		$button_classes[] = 'grve-bg-hover-' . $button_hover_color;

		$button_class_string = implode( ' ', $button_classes );

		if ( !empty( $button_url ) ) {
			$url = $button_url;
			$target = $button_target;
		} else {
			$url = "#";
			$target= "_self";
		}

?>
		<a class="<?php echo esc_attr( $button_class_string ); ?>" href="<?php echo esc_url( $url ); ?>"  target="<?php echo esc_attr( $target ); ?>">
			<span><?php echo esc_html( $button_text ); ?></span>
		</a>
<?php

	}

}

//Omit closing PHP tag to avoid accidental whitespace output errors.
