<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

if ( ! function_exists( 'thb_get_builder_position' ) ) {
	/**
	 * Get the builder position in the page.
	 *
	 * @return string
	 */
	function thb_get_builder_position() {
		$builder_position = thb_get_post_meta( thb_get_page_ID(), 'builder_position' );
		$builder_position = apply_filters( 'thb_get_builder_position', $builder_position );

		if ( empty( $builder_position ) ) {
			$builder_position = 'top';
		}

		return $builder_position;
	}
}

if ( ! function_exists( 'thb_is_builder_position_top' ) ) {
	/**
	 * Check if the builder section should be placed above the page content.
	 *
	 * @return boolean
	 */
	function thb_is_builder_position_top() {
		return thb_get_builder_position() == 'top';
	}
}

if ( ! function_exists( 'thb_is_builder_position_bottom' ) ) {
	/**
	 * Check if the builder section should be placed below the page content.
	 *
	 * @return boolean
	 */
	function thb_is_builder_position_bottom() {
		return ! thb_is_builder_position_top();
	}
}

if ( ! function_exists( 'thb_builder_get_duplicable' ) ) {
	/**
	 * Get the builder duplicable field.
	 *
	 * @param integer $page_id The page ID.
	 * @return array
	 */
	function thb_builder_get_duplicable( $page_id ) {
		$builder_key = 'section';

		if ( isset( $_GET['preview_id'] ) && $_GET['preview_id'] == $page_id ) {
			/* If we're previewing the builder, load its backup. */
			$preview_builder_key = '_' . $builder_key;

			$sections = thb_duplicable_get( $preview_builder_key, $page_id );

			if ( ! empty( $sections ) ) {
				return $sections;
			}
		}

		$sections = thb_duplicable_get( $builder_key, $page_id );

		return $sections;
	}
}

if ( ! function_exists( 'thb_is_builder_empty' ) ) {
	/**
	 * Check if the builder sections are empty.
	 *
	 * @return boolean
	 */
	function thb_is_builder_empty() {
		$page_id = thb_get_page_ID();
		$sections = thb_builder_get_duplicable( $page_id );

		return empty( $sections );
	}
}

/**
 * Localize the builder data.
 */
function thb_localize_builder( $data ) {
	if ( thb_is_builder_empty() ) {
		return $data;
	}

	$page_id = thb_get_page_ID();
	$sections = thb_builder_get_duplicable( $page_id );
	$builder = array();

	foreach ( $sections as $section ) {
		$value = $section['value'];
		$decoded_section = html_entity_decode( $value );
		parse_str( $decoded_section, $sect );

		$sect = stripslashes_deep( $sect );

		$builder[] = $sect;
	}

	$data['thb_builder_data'] = $builder;

	return $data;
}

add_filter( 'thb_frontend_localized_scripts', 'thb_localize_builder' );

if( !function_exists('thb_decode_builder_section') ) {
	/**
	 * Decode a builder section.
	 */
	function thb_decode_builder_section( $section ) {
		$value = $section['value'];
		$decoded_section = html_entity_decode( $value );
		parse_str( $decoded_section, $sect );

		$sect = stripslashes_deep( $sect );

		return $sect;
	}
}

/**
 * Prints section-related inline styles in wp_head.
 */
function thb_builder_inline_styles() {
	$page_id = thb_get_page_ID();
	$sections = thb_builder_get_duplicable( $page_id );

	if ( thb_is_builder_empty() ) {
		return;
	}

	foreach( $sections as $section_index => $sect ) {
		$section = thb_decode_builder_section( $sect );
		$section_id = "thb-section-$section_index";

		$breakpoints = thb_responsive_breakpoints();

		if ( ! empty( $breakpoints ) ) {
			foreach ( $breakpoints as $breakpoint => $label ) {
				$padding_top    = thb_isset( $section['appearance'], 'padding_top_' . $breakpoint, '' );
				$padding_bottom = thb_isset( $section['appearance'], 'padding_bottom_' . $breakpoint, '' );
				$margin_top     = thb_isset( $section['appearance'], 'margin_top_' . $breakpoint, '' );
				$margin_bottom  = thb_isset( $section['appearance'], 'margin_bottom_' . $breakpoint, '' );

				if ( $padding_top !== '' || $padding_bottom !== '' || $margin_top !== '' || $margin_bottom !== '' ) {
					echo '<style type="text/css">';
						printf( '@media screen and (max-width: %spx) {', $breakpoint );
							printf( '#%s .thb-section-extra {', $section_id );

								if ( $padding_top !== '' ) {
									if ( is_numeric( $padding_top ) ) {
										$padding_top .= 'px';
									}

									printf( 'padding-top: %s !important;', $padding_top );
								}

								if ( $padding_bottom !== '' ) {
									if ( is_numeric( $padding_bottom ) ) {
										$padding_bottom .= 'px';
									}

									printf( 'padding-bottom: %s !important;', $padding_bottom );
								}

								if ( $margin_top !== '' ) {
									if ( is_numeric( $margin_top ) ) {
										$margin_top .= 'px';
									}

									printf( 'margin-top: %s !important;', $margin_top );
								}

								if ( $margin_bottom !== '' ) {
									if ( is_numeric( $margin_bottom ) ) {
										$margin_bottom .= 'px';
									}

									printf( 'margin-bottom: %s !important;', $margin_bottom );
								}

							echo '}';
						echo '}';
					echo '</style>';
				}
			}
		}

		if ( ! empty( $section['rows'] ) ) {
			foreach ( $section['rows'] as $row_index => $row ) {
				if ( ! empty( $row['columns'] ) ) {
					foreach( $row['columns'] as $column_index => $column ) {
						if ( ! empty( $breakpoints ) ) {
							$column_id = sprintf( 'thb-section-%s-row-%s-column-%s', $section_index, $row_index, $column_index );

							foreach ( $breakpoints as $breakpoint => $label ) {
								$padding_top      = thb_isset( $column['appearance'], 'padding_top_' . $breakpoint, '' );
								$padding_right    = thb_isset( $column['appearance'], 'padding_right_' . $breakpoint, '' );
								$padding_bottom   = thb_isset( $column['appearance'], 'padding_bottom_' . $breakpoint, '' );
								$padding_left     = thb_isset( $column['appearance'], 'padding_left_' . $breakpoint, '' );

								if ( $padding_top !== '' || $padding_right !== '' || $padding_bottom !== '' || $padding_left !== '' ) {
									echo '<style type="text/css">';
										printf( '@media screen and (max-width: %spx) {', $breakpoint );
											printf( '#%s {', $column_id );

												if ( $padding_top !== '' ) {
													if ( is_numeric( $padding_top ) ) {
														$padding_top .= 'px';
													}

													printf( 'padding-top: %s !important;', $padding_top );
												}

												if ( $padding_right !== '' ) {
													if ( is_numeric( $padding_right ) ) {
														$padding_right .= 'px';
													}

													printf( 'padding-right: %s !important;', $padding_right );
												}

												if ( $padding_bottom !== '' ) {
													if ( is_numeric( $padding_bottom ) ) {
														$padding_bottom .= 'px';
													}

													printf( 'padding-bottom: %s !important;', $padding_bottom );
												}

												if ( $padding_left !== '' ) {
													if ( is_numeric( $padding_left ) ) {
														$padding_left .= 'px';
													}

													printf( 'padding-left: %s !important;', $padding_left );
												}

											echo '}';
										echo '}';
									echo '</style>';
								}
							}
						}
					}
				}
			}
		}
	}
}

add_action( 'wp_head', 'thb_builder_inline_styles' );

if ( ! function_exists( 'thb_builder' ) ) {
	/**
	 * Display the builder sections.
	 */
	function thb_builder() {
		$page_id = thb_get_page_ID();
		$sections = thb_builder_get_duplicable( $page_id );

		foreach ( $sections as $index => $single_section ) {
			$sections[$index]['value'] = thb_strip_scripts( $sections[$index]['value'] );
		}

		if ( thb_is_builder_empty() ) {
			return;
		}

		wp_reset_query();

		$total_section_classes = array();

		foreach( $sections as $index => $section ) {
			$sect = thb_decode_builder_section( $section );
			$section_classes = apply_filters( 'thb_section_classes', array(), $sect );

			if ( empty( $sect['rows'] ) ) {
				continue;
			}

			$current_is_boxed = in_array( 'thb-section-boxed', $section_classes );

			$prev_index = $index > 0 ? $index - 1 : false;
			$next_index = $index < count( $sections ) - 1 ? $index + 1 : false;

			if ( $prev_index !== false ) {
				$prev_section = thb_decode_builder_section( $sections[$prev_index] );
				$prev_section_classes = apply_filters( 'thb_section_classes', array(), $prev_section );

				$prev_is_boxed = in_array( 'thb-section-boxed', $prev_section_classes );

				if ( $current_is_boxed && ! $prev_is_boxed ) {
					$total_section_classes[$prev_index][] = 'thb-section-pre-boxed';
				}
			}

			if ( $next_index !== false ) {
				$next_section = thb_decode_builder_section( $sections[$next_index] );
				$next_section_classes = apply_filters( 'thb_section_classes', array(), $next_section );

				$next_is_boxed = in_array( 'thb-section-boxed', $next_section_classes );

				if ( $current_is_boxed && ! $next_is_boxed ) {
					$total_section_classes[$next_index][] = 'thb-section-post-boxed';
				}
			}
		}

		foreach ( $sections as $index => $section ) {
			$value = $section['value'];
			$decoded_section = html_entity_decode( $value );
			parse_str( $decoded_section, $sect );

			$sect = stripslashes_deep( $sect );

			if ( empty( $sect['rows'] ) ) {
				continue;
			}

			$section_classes = array(
				isset( $sect['appearance']['width'] ) ? $sect['appearance']['width'] : '',
				isset( $sect['appearance']['class'] ) ? $sect['appearance']['class'] : ''
			);

			if ( isset( $total_section_classes[$index] ) ) {
				$section_classes = array_merge( $section_classes, (array) $total_section_classes[$index] );
			}

			$section_classes = apply_filters( 'thb_section_classes', $section_classes, $sect );
			$section_attrs   = apply_filters( 'thb_section_attrs', array(), $sect );

			thb_get_module_template_part( 'backpack/builder', 'section', array(
				'section'             => $sect,
				'section_index'       => $index,
				'class'               => implode( ' ', $section_classes ),
				'section_attrs'       => thb_get_attributes( $section_attrs ),
			) );
		}
	}
}

if ( ! function_exists( 'thb_section_background' ) ) {
	/**
	 * Add a background field to the builder section appearance modal.
	 */
	function thb_section_background_field() {
		$thb_section_appearance_modal_tab = thb_theme()->getAdmin()->getModal( 'section_appearance' )->createTab( __( 'Background', 'thb_text_domain' ), 'section_appearance_background', 2 );
		$thb_modal_container = $thb_section_appearance_modal_tab->createContainer( '', 'thb_appearance_dimensions_container' );

			$thb_field = new THB_BackgroundField( 'background' );
			$thb_field->setLabel( '' );
			$thb_field->addClass( 'full' );

		$thb_modal_container->addField( $thb_field );

			$thb_field = new THB_SelectField( 'background_appearance' );
			$thb_field->setLabel( __( 'Appearance', 'thb_text_domain' ) );
			$thb_field->setOptions( array(
				'relative' => __( 'Regular', 'thb_text_domain' ),
				'fixed'    => __( 'Fixed', 'thb_text_domain' ),
				'parallax' => __( 'Parallax', 'thb_text_domain' ),
				'repeated' => __( 'Repeated', 'thb_text_domain' )
			) );

		$thb_modal_container->addField( $thb_field );

		$thb_container = thb_theme()->getAdmin()->getModal( 'section_appearance' )->getTab( 'section_appearance_dimensions' )->getContainer( 'thb_appearance_dimensions_container' );

			$thb_field = new THB_CheckboxField( 'fit_height' );
				$thb_field->setLabel( __( 'Fit to the window height', 'thb_text_domain' ) );
				$thb_field->setHelp( __( 'Force a min-height to the section container based on the window height. Please note that this option doesn\'t align the section content', 'thb_text_domain' ) );

		$thb_container->addField( $thb_field );
	}

	add_action( 'wp_loaded', 'thb_section_background_field' );
}

if ( ! function_exists( 'thb_theme_section_classes' ) ) {
	/**
	 * Add a skin class to the builder section frontend template.
	 *
	 * @param array $section_classes
	 * @param array $section
	 * @return array
	 */
	function thb_theme_section_classes( $section_classes, $section ) {
		if ( isset( $section['appearance'] ) ) {
			$skin = thb_section_get_text_skin( $section['appearance'] );

			if ( ! empty( $skin ) ) {
				$section_classes[] = 'thb-skin-' . $skin;
			}

			if ( isset( $section['appearance']['background'] ) ) {
				$overlay_display  = $section['appearance']['background']['overlay_display'];
				$overlay_color    = $section['appearance']['background']['overlay_color'];
				$background_color = $section['appearance']['background']['background_color'];
				$background_image = $section['appearance']['background']['id'];

				if ( ( $overlay_display == '1' && ! empty( $overlay_color ) ) || ! empty( $background_color ) || ! empty( $background_image ) ) {
					$section_classes[] = 'thb-section-boxed';
				}
			}
		}

		return $section_classes;
	}

	add_filter( 'thb_section_classes', 'thb_theme_section_classes', 10, 2 );
}

if( ! function_exists( 'thb_section_get_text_skin' ) ) {
	/**
	 * Generate the builder section skin class from a comparison color.
	 *
	 * @param array $appearance
	 * @return string
	 */
	function thb_section_get_text_skin( $appearance ) {
		$pagecontent_background = get_theme_mod('body_bg', '#ffffff');

		if ( isset( $appearance['background'] ) ) {
			$overlay_color     = $appearance['background']['overlay_color'];
			$background_color  = $appearance['background']['background_color'];

			return thb_color_get_skin_from_comparison( $overlay_color, $background_color, $pagecontent_background );
		}
		else {
			return thb_color_get_opposite_skin( $pagecontent_background );
		}

		return '';
	}
}

if ( ! function_exists( 'thb_section_attrs' ) ) {
	function thb_section_attrs( $section_attrs, $section ) {
		if ( ! isset( $section['appearance'] ) || ! isset( $section['appearance']['background'] ) ) {
			return $section_attrs;
		}

		$background_color       = thb_isset( $section['appearance']['background'], 'background_color', '' );
		$background_image       = thb_isset( $section['appearance']['background'], 'id', '' );
		$background_appearance  = thb_isset( $section['appearance'], 'background_appearance', '');
		$section_margin_top     = thb_isset( $section['appearance'], 'margin_top', '');
		$section_margin_bottom  = thb_isset( $section['appearance'], 'margin_bottom', '');
		$section_padding_top    = thb_isset( $section['appearance'], 'padding_top', '');
		$section_padding_bottom = thb_isset( $section['appearance'], 'padding_bottom', '');
		$fit_height             = thb_isset( $section['appearance'], 'fit_height', '');

		if ( $background_appearance ) {
			$section_attrs['data-' . $background_appearance] = '1';
		}

		if ( $fit_height ) {
			$section_attrs['data-fit-height'] = '1';
		}

		if ( ! isset( $section_attrs['style'] ) ) {
			$section_attrs['style'] = '';
		}

		if ( $section_margin_top != '' ) {
			if ( is_numeric( $section_margin_top ) ) {
				$section_margin_top .= 'px';
			}

			$section_attrs['style'] .= sprintf( ' margin-top: %s;', $section_margin_top );
		}

		if ( $section_margin_bottom != '' ) {
			if ( is_numeric( $section_margin_bottom ) ) {
				$section_margin_bottom .= 'px';
			}

			$section_attrs['style'] .= sprintf( ' margin-bottom: %s;', $section_margin_bottom );
		}

		if ( $section_padding_top != '' ) {
			if ( is_numeric( $section_padding_top ) ) {
				$section_padding_top .= 'px';
			}

			$section_attrs['style'] .= sprintf( ' padding-top: %s;', $section_padding_top );
		}

		if ( $section_padding_bottom != '' ) {
			if ( is_numeric( $section_padding_bottom ) ) {
				$section_padding_bottom .= 'px';
			}

			$section_attrs['style'] .= sprintf( ' padding-bottom: %s;', $section_padding_bottom );
		}

		if ( ! empty( $background_color ) ) {
			$section_attrs['style'] .= sprintf( ' background-color: %s;', $background_color );
		}

		if ( ! empty( $background_image ) ) {
			$section_attrs['style'] .= sprintf( ' background-image: url(%s);', thb_image_get_size( $background_image, 'full-width' ) );
		}

		return $section_attrs;
	}

	add_filter( 'thb_section_attrs', 'thb_section_attrs', 10, 2 );
}

if ( ! function_exists( 'thb_section_background' ) ) {
	function thb_section_background( $section ) {
		if ( isset( $section['appearance'] ) && isset( $section['appearance']['background'] ) ) {
			$overlay_display  = $section['appearance']['background']['overlay_display'];
			$overlay_color    = $section['appearance']['background']['overlay_color'];

			if ( empty( $overlay_color ) ) {
				return;
			}

			if ( $overlay_display == '1' ) {
				$overlay_opacity = $section['appearance']['background']['overlay_opacity'];

				thb_overlay( $overlay_color, $overlay_opacity, 'thb-background-overlay' );
			}
		}
	}

	add_action( 'thb_section_pre_wrapper', 'thb_section_background' );
}

if ( ! function_exists( 'thb_builder_fake_query' ) ) {
	/**
	 * Builder fake query in order to make shortcodes in builder blocks work
	 * properly. Remember to add a wp_reset_query call at the end of the loop.
	 */
	function thb_builder_fake_query() {
		$id = thb_get_page_ID();
		$post_type = get_post_type( $id );

		$args = array(
			'posts_per_page' => 1
		);

		$args['post_type'] = $post_type;
		$args['p'] = $id;

		query_posts( $args );
	}
}

if ( ! function_exists( 'thb_builder_section_has_title' ) ) {
	/**
	 * Check if a section has a title set.
	 *
	 * @param array $section_data The section data.
	 * @return boolean
	 */
	function thb_builder_section_has_title( $section_data ) {
		if ( ! isset( $section_data['rows'] ) ) {
			return false;
		}

		foreach ( $section_data['rows'] as $row ) {
			if ( isset( $row['columns'] ) && ! empty( $row['columns'] ) ) {
				foreach ( $row['columns'] as $column ) {
					if ( isset( $column['blocks'] ) && ! empty( $column['blocks'] ) ) {
						foreach ( $column['blocks'] as $block ) {
							if ( isset( $block['data'] ) && isset( $block['data']['is_title'] ) && $block['data']['is_title'] == '1' ) {
								return true;
							}
						}
					}
				}
			}
		}

		return false;
	}
}

function thb_builder_custom_search_query_join( $join = '', $wp_query ) {
	if ( ! is_admin() && $wp_query->is_main_query() && $wp_query->is_search ) {
		global $wpdb;
		$join .= " LEFT JOIN {$wpdb->postmeta} as meta_1 ON {$wpdb->posts}.ID = meta_1.post_id";
	}

	return $join;
}

function thb_builder_custom_search_query_where( $where = '', $wp_query ) {
	if ( ! is_admin() && $wp_query->is_main_query() && $wp_query->is_search ) {
		global $wpdb;

		$s = get_search_query();
		$in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

		foreach ( explode( ' ', $s ) as $q ) {
			$where .= $wpdb->prepare( " OR ( meta_1.meta_value LIKE %s AND meta_1.meta_key LIKE %s",
				'%' . $wpdb->esc_like( $q ) . '%',
				$wpdb->esc_like( 'thb_' ) . '%'
			);

			$where .= sprintf( " AND {$wpdb->posts}.post_type IN ( '%s' )", join( "', '", $in_search_post_types ) );

			$where .= ' )';
		}

		// $s = urlencode( $s );
		// $s = preg_replace( "/\+/", '%20', $s );
		// $s = preg_replace( "/\'/", '%27', $s );

		// $where .= sprintf( $where_clause, $s );
	}

	return $where;
}

function thb_builder_custom_search_query_fields( $fields, $wp_query ) {
	if ( ! is_admin() && $wp_query->is_main_query() && $wp_query->is_search ) {
		$fields = ' distinct ' . $fields;
	}

	return $fields;
}

add_filter( 'posts_fields' , 'thb_builder_custom_search_query_fields', 10, 2);
add_filter( 'posts_join' , 'thb_builder_custom_search_query_join', 10, 2);
add_filter( 'posts_where', 'thb_builder_custom_search_query_where', 10, 2 );