<?php
/**
 *  Add Dynamic css to header
 *  @version	1.0
 *  @author		Greatives Team
 *  @URI		http://greatives.eu
 */


add_action('wp_head', 'blade_grve_load_dynamic_css');

if ( !function_exists( 'blade_grve_load_dynamic_css' ) ) {

	function blade_grve_load_dynamic_css() {
		include( 'grve-dynamic-typography-css.php' );
		include( 'grve-dynamic-css.php' );
		if ( blade_grve_woocommerce_enabled() ) {
			include( 'grve-dynamic-woo-css.php' );
		}

		$custom_css_code = blade_grve_option( 'css_code' );
		if ( !empty( $custom_css_code ) ) {
			echo blade_grve_get_css_output( $custom_css_code );
		}

		blade_grve_add_custom_page_css();
		blade_grve_get_global_button_style();
	}
}

function blade_grve_add_custom_page_css( $id = null ) {

	$grve_custom_css = '';
	$grve_woo_shop = blade_grve_is_woo_shop();

	if ( is_front_page() && is_home() ) {
		// Default homepage
		$mode = 'blog';
	} else if ( is_front_page() ) {
		// static homepage
		$mode = 'page';
	} else if ( is_home() ) {
		// blog page
		$mode = 'blog';
	} else if( is_search() ) {
		if ( blade_grve_visibility( 'search_page_custom_header_title' ) ) {
			$mode = 'search_page';
		} else {
			$mode = 'page';
		}
	} else if ( is_singular() || $grve_woo_shop ) {
		if ( is_singular( 'post' ) ) {
			$mode = 'post';
		} else if ( is_singular( 'portfolio' ) ) {
			$mode = 'portfolio';
		} else if ( is_singular( 'product' ) ) {
			$mode = 'product';
		} else {
			$mode = 'page';
		}
	} else if ( is_archive() ) {
		if( blade_grve_is_woo_tax() ) {
			$mode = 'product_tax';
		} else {
			$mode = 'blog';
		}

	} else {
		$mode = 'page';
	}

	$grve_page_title = array(
		'bg_color' => blade_grve_option( $mode . '_title_bg_color', 'dark' ),
		'bg_color_custom' => blade_grve_option( $mode . '_title_bg_color_custom', '#000000' ),
		'title_color' => blade_grve_option( $mode . '_title_color', 'light' ),
		'title_color_custom' => blade_grve_option( $mode . '_title_color_custom', '#ffffff' ),
		'caption_color' => blade_grve_option( $mode . '_description_color', 'light' ),
		'caption_color_custom' => blade_grve_option( $mode . '_description_color_custom', '#ffffff' ),
	);

	if ( is_tag() || is_category() || blade_grve_is_woo_category() || blade_grve_is_woo_tag() ) {
		$category_id = get_queried_object_id();
		$grve_custom_title_options = blade_grve_get_term_meta( $category_id, 'grve_custom_title_options' );
		$grve_page_title_custom = blade_grve_array_value( $grve_custom_title_options, 'custom' );
		if ( 'custom' == $grve_page_title_custom ) {
			$grve_page_title = $grve_custom_title_options;
		}
	}


	if ( is_singular() || $grve_woo_shop ) {

		if ( ! $id ) {
			if ( $grve_woo_shop ) {
				$id = wc_get_page_id( 'shop' );
			} else {
				$id = get_the_ID();
			}
		}
		if ( $id ) {

			//Custom Title
			$grve_custom_title_options = get_post_meta( $id, 'grve_custom_title_options', true );
			$grve_page_title_custom = blade_grve_array_value( $grve_custom_title_options, 'custom' );
			if ( !empty( $grve_page_title_custom ) ) {
				$grve_page_title = $grve_custom_title_options;
			}

			//Feature Section
			$feature_section = get_post_meta( $id, 'grve_feature_section', true );
			$feature_settings = blade_grve_array_value( $feature_section, 'feature_settings' );
			$feature_element = blade_grve_array_value( $feature_settings, 'element' );

			if ( !empty( $feature_element ) ) {

				switch( $feature_element ) {

					case 'title':
					case 'image':
					case 'video':
						$single_item = blade_grve_array_value( $feature_section, 'single_item' );
						if ( !empty( $single_item ) ) {
							$grve_custom_css .= blade_grve_get_feature_title_css( $single_item );
						}
						break;
					case 'slider':
						$slider_items = blade_grve_array_value( $feature_section, 'slider_items' );
						if ( !empty( $slider_items ) ) {
							foreach ( $slider_items as $item ) {
								$grve_custom_css .= blade_grve_get_feature_title_css( $item, 'slider' );
							}
						}
						break;
					default:
						break;

				}
			}
		}
	}

	$grve_custom_css .= blade_grve_get_title_css( $grve_page_title );

	if ( ! empty( $grve_custom_css ) ) {
		echo blade_grve_get_css_output( $grve_custom_css );
	}
}

function blade_grve_get_feature_title_css( $item, $type = 'single' ) {

	$grve_custom_css = '';
	$custom_class = '';

	if( 'slider' == $type ) {
		$id = blade_grve_array_value( $item, 'id' );
		if ( !empty( $id ) ) {
			$custom_class = ' .grve-slider-item-id-' . $id ;
		}
	}

	$subheading_color = blade_grve_array_value( $item, 'subheading_color', 'light' );
	if ( 'custom' == $subheading_color ) {
		$subheading_color_custom = blade_grve_array_value( $item, 'subheading_color_custom', '#ffffff' );
		$grve_custom_css .= '#grve-feature-section' . esc_attr( $custom_class ) . ' .grve-subheading {';
		$grve_custom_css .= blade_grve_get_css_color( 'color', $subheading_color_custom );
		$grve_custom_css .= '}';
	}

	$title_color = blade_grve_array_value( $item, 'title_color', 'light' );
	if ( 'custom' == $title_color ) {
		$title_color_custom = blade_grve_array_value( $item, 'title_color_custom', '#ffffff' );
		$grve_custom_css .= '#grve-feature-section' . esc_attr( $custom_class ) . ' .grve-title {';
		$grve_custom_css .= blade_grve_get_css_color( 'color', $title_color_custom );
		$grve_custom_css .= '}';
	}

	$caption_color = blade_grve_array_value( $item, 'caption_color', 'light' );
	if ( 'custom' == $caption_color ) {
		$caption_color_custom = blade_grve_array_value( $item, 'caption_color_custom', '#ffffff' );
		$grve_custom_css .= '#grve-feature-section' . esc_attr( $custom_class ) . ' .grve-description {';
		$grve_custom_css .= blade_grve_get_css_color( 'color', $caption_color_custom );
		$grve_custom_css .= '}';
	}

	$media_id = blade_grve_array_value( $item, 'content_image_id', '0' );
	$media_max_height = blade_grve_array_value( $item, 'content_image_max_height', '150' );

	if( '0' != $media_id ) {
		$grve_custom_css .= '#grve-feature-section' . esc_attr( $custom_class ) . ' .grve-content .grve-graphic img  {';
		$grve_custom_css .= 'max-height:' . esc_attr( $media_max_height ) .'px';
		$grve_custom_css .= '}';
	}

	return $grve_custom_css;

}

function blade_grve_get_title_css( $title ) {
	$grve_custom_css = '';

	$bg_color = blade_grve_array_value( $title, 'bg_color', 'dark' );
	if ( 'custom' == $bg_color ) {
		$bg_color_custom = blade_grve_array_value( $title, 'bg_color_custom', '#000000' );
		$grve_custom_css .= '.grve-page-title {';
		$grve_custom_css .= blade_grve_get_css_color( 'background-color', $bg_color_custom );
		$grve_custom_css .= '}';
	}

	$title_color = blade_grve_array_value( $title, 'title_color', 'light' );
	if ( 'custom' == $title_color ) {
		$title_color_custom = blade_grve_array_value( $title, 'title_color_custom', '#ffffff' );
		$grve_custom_css .= '.grve-page-title .grve-title {';
		$grve_custom_css .= blade_grve_get_css_color( 'color', $title_color_custom );
		$grve_custom_css .= '}';
	}

	$caption_color = blade_grve_array_value( $title, 'caption_color', 'light' );
	if ( 'custom' == $caption_color ) {
		$caption_color_custom = blade_grve_array_value( $title, 'caption_color_custom', '#ffffff' );
		$grve_custom_css .= '.grve-page-title .grve-description, .grve-page-title .grve-subheading {';
		$grve_custom_css .= blade_grve_get_css_color( 'color', $caption_color_custom );
		$grve_custom_css .= '}';
	}

	return $grve_custom_css;
}

function blade_grve_get_global_button_style() {
	$grve_custom_css = "";

	$button_type = blade_grve_option( 'button_type', 'simple' );
	$button_shape = blade_grve_option( 'button_shape', 'square' );
	$button_color = blade_grve_option( 'button_color', 'primary-1' );
	$button_hover_color = blade_grve_option( 'button_hover_color', 'black' );

	$grve_colors = array(
		'primary-1' => blade_grve_option( 'body_primary_1_color' ),
		'primary-2' => blade_grve_option( 'body_primary_2_color' ),
		'primary-3' => blade_grve_option( 'body_primary_3_color' ),
		'primary-4' => blade_grve_option( 'body_primary_4_color' ),
		'primary-5' => blade_grve_option( 'body_primary_5_color' ),
		'primary-5' => blade_grve_option( 'body_primary_5_color' ),
		'green' => '#66bb6a',
		'red' => '#ff5252',
		'orange' => '#ffb74d',
		'aqua' => '#1de9b6',
		'blue' => '#00b0ff',
		'purple' => '#b388ff',
		'black' => '#000000',
		'grey' => '#bababa',
		'white' => '#ffffff',
	);

		$grve_custom_css .= ".grve-modal input[type='submit']:not(.grve-custom-btn), #grve-theme-wrapper input[type='submit']:not(.grve-custom-btn), #grve-theme-wrapper input[type='reset']:not(.grve-custom-btn), #grve-theme-wrapper button:not(.grve-custom-btn):not(.vc_general), .woocommerce-MyAccount-content a.button {";
			switch( $button_shape ) {
				case "round":
					$grve_custom_css .= "-webkit-border-radius: 3px;";
					$grve_custom_css .= "border-radius: 3px;";
				break;
				case "extra-round":
					$grve_custom_css .= "-webkit-border-radius: 50px;";
					$grve_custom_css .= "border-radius: 50px;";
				break;
				case "square":
				default:
				break;
			}

			$default_color = blade_grve_option( 'body_primary_1_color' );
			$color = blade_grve_array_value( $grve_colors, $button_color, $default_color );

			if ( "outline" == $button_type ) {

				$grve_custom_css .= "border: 1px solid;";
				$grve_custom_css .= "background-color: transparent;";
				$grve_custom_css .= "background-image: none;";
				$grve_custom_css .= "border-color: " . esc_attr( $color ) . ";";
				$grve_custom_css .= "color: " . esc_attr( $color ) . ";";

			} else {
				$grve_custom_css .= "background-color: " . esc_attr( $color ) . ";";
				if ( 'white' == $button_color ) {
					$grve_custom_css .= "color: #bababa;";
				} else {
					$grve_custom_css .= "color: #ffffff;";
				}
			}


		$grve_custom_css .= "}";

		$grve_custom_css .= ".grve-modal input[type='submit']:not(.grve-custom-btn):hover, #grve-theme-wrapper input[type='submit']:not(.grve-custom-btn):hover, #grve-theme-wrapper input[type='reset']:not(.grve-custom-btn):hover, #grve-theme-wrapper button:not(.grve-custom-btn):not(.vc_general):hover,.woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-MyAccount-content a.button:hover {";

		$hover_color = blade_grve_array_value( $grve_colors, $button_hover_color, "#bababa" );

		if ( "outline" == $button_type ) {

			$grve_custom_css .= "background-color: " . esc_attr( $hover_color ) . ";";
			$grve_custom_css .= "border-color: " . esc_attr( $hover_color ) . ";";
			if ( 'white' == $button_hover_color ) {
				$grve_custom_css .= "color: #bababa;";
			} else {
				$grve_custom_css .= "color: #ffffff;";
			}

		} else {
			$grve_custom_css .= "background-color: " . esc_attr( $hover_color ) . ";";
			if ( 'white' == $button_hover_color ) {
				$grve_custom_css .= "color: #bababa;";
			} else {
				$grve_custom_css .= "color: #ffffff;";
			}
		}

		$grve_custom_css .= "}";

	echo blade_grve_get_css_output( $grve_custom_css );
}

//Omit closing PHP tag to avoid accidental whitespace output errors.
