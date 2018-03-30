<?php
/**
 * Visual Composer Helper Functions
 *
 * @package Total WordPress Theme
 * @subpackage VC Functions
 * @since 3.5.3
 */

/**
 * Config files tweak VC modules (add params, remove params, filter fields)
 *
 * Must load on the front-end and backend to ensure items are mapped correctly for
 * vc_map_get_attributes()
 *
 * @since 3.0.0
 */
require_once( WPEX_FRAMEWORK_DIR .'visual-composer/parse/parse-row-atts.php' );
require_once( WPEX_FRAMEWORK_DIR .'visual-composer/config/row.php' );
require_once( WPEX_FRAMEWORK_DIR .'visual-composer/config/column.php' );
require_once( WPEX_FRAMEWORK_DIR .'visual-composer/config/single-image.php' );

/**
 * Declare functions for use with the Visual Composer autocomplete
 *
 * @since 3.0.0
 */
if ( is_admin() ) {
	require_once( WPEX_FRAMEWORK_DIR .'visual-composer/helpers/autocomplete.php' );
}

/**
 * Helper classes for VC module output
 *
 * @since 3.0.0
 */
require_once( WPEX_FRAMEWORK_DIR .'visual-composer/helpers/build-query.php' );
require_once( WPEX_FRAMEWORK_DIR .'visual-composer/helpers/inline-js.php' );
require_once( WPEX_FRAMEWORK_DIR .'visual-composer/helpers/inline-style.php' );


/**
 * Displays notice when functions aren't found
 *
 * @since 3.5.0
 */
function vcex_function_needed_notice() {
	echo '<div class="vcex-function-needed">This module can not work without the required functions. Please make sure all your plugins and WordPress is up to date. If you still have issues contact the developer for assistance.</div>';
}

/**
 * Returns animation class and loads animation js
 *
 * @since 3.5.0
 */
function vcex_grid_get_post_class( $classes, $post_id ) {

	// Get post
	$post_id = $post_id ? $post_id : get_the_ID();

	// Get post type
	$type = get_post_type( $post_id );

	// Add entry class
	$classes[] = 'entry';

	// Add type class
	$classes[] = 'type-'. $type;

	// Add has media class
	if ( has_post_thumbnail()
		|| get_post_meta( $post_id, 'wpex_post_oembed', true )
		|| get_post_meta( $post_id, 'wpex_post_self_hosted_media', true )
		|| get_post_meta( $post_id, 'wpex_post_video_embed', true )
		|| wpex_post_has_gallery( $post_id )
	) {
		$classes[] = 'has-media';
	}

	// Add terms
	if ( $terms = vcex_get_post_term_classes( $post_id, $type ) ) {
		$classes[] = $terms;
	}

	// Apply filters
	$classes = apply_filters( 'vcex_grid_get_post_class', $classes );

	// Turn into string
	$classes = implode( ' ', $classes );

	// Sanitize and return
	return 'class="'. esc_attr( $classes ) .'"';

}

/**
 * Returns entry classes for vcex module entries
 *
 * @since 3.5.3
 */
function vcex_get_post_term_classes( $post_id, $post_type ) {

	// Define vars
	$classes = array();

	// Loop through tax objects and save in taxonomies var
	$taxonomies = get_object_taxonomies( $post_type, 'names' );
	if ( is_wp_error( $taxonomies ) || ! $taxonomies ) {
		return;
	}
	foreach ( $taxonomies as $tax ) {
		if ( $terms = get_the_terms( $post_id, $tax ) ) {
			foreach ( $terms as $term ) {
				$prefix = esc_html( $term->taxonomy );
				if ( $prefix ) {
					$parse_types   = wpex_theme_post_types();
					$parse_types[] = 'post';
					if ( in_array( $post_type, $parse_types ) ) {
						$search  = array( $post_type .'_category', 'category', $post_type .'_tag' );
						$replace = array( 'cat', 'cat', 'tag' );
						$prefix  = str_replace( $search, $replace, $prefix );
					}
					$classes[] = $prefix .'-'. $term->term_id;
				}
			}
		}
	}

	// Return classes
	return $classes ? implode( ' ', $classes ) : '';

}

/**
 * Returns animation class and loads animation js
 *
 * @since 3.5.0
 */
function vcex_get_css_animation( $css_animation = '' ) {
	if ( $css_animation ) {
		wp_enqueue_script( 'waypoints' );
		return ' wpb_animate_when_almost_visible wpb_' . $css_animation;
	}
}

/**
 * Get Extra class
 *
 * @since 2.0.0
 */
function vcex_get_extra_class( $classes = '' ) {
	if ( $classes ) {
		return str_replace( '.', '', $classes );
	}
}


/**
 * Returns list of post types
 *
 * @since 2.1.0
 */
function vcex_get_post_types() {
	$post_types_list = array();
	$post_types = get_post_types( array(
		'public' => true
	) );
	if ( $post_types ) {
		foreach ( $post_types as $post_type ) {
			if ( 'revision' != $post_type && 'nav_menu_item' != $post_type && 'attachment' != $post_type ) {
				$post_types_list[$post_type] = $post_type;
			}
		}
	}
	return $post_types_list;
}

/**
 * Array of Google Font options
 *
 * @since 2.1.0
 */
function vcex_fonts_array() {

	// Default array
	$array = array(
		esc_html__( 'Default', 'total' ) => '',
	);

	// Add custom fonts
	if ( function_exists( 'wpex_add_custom_fonts' ) ) {
		$array = array_merge( $array, wpex_add_custom_fonts() );
	}

	// Add standard fonts
	$std_fonts = wpex_standard_fonts();
	$array = array_merge( $array, $std_fonts );

	// Add Google Fonts
	if ( $google_fonts = wpex_google_fonts_array() ) {
		$array = array_merge( $array, $google_fonts );
	}

	// Return fonts
	return apply_filters( 'vcex_google_fonts_array', $array );

}

/**
 * Parses lightbox dimensions
 *
 * @since 2.1.2
 */
function vcex_parse_lightbox_dims( $dims ) {

	// Return default if undefined
	if ( ! $dims ) {
		return 'width:1920,height:1080';
	}

	// Parse data
	$dims = explode( 'x', $dims );
    $w    = isset( $dims[0] ) ? $dims[0] : '1920';
    $h    = isset( $dims[1] ) ? $dims[1] : '1080';

    // Return dimensions
    return 'width:'. $w .',height:'. $h .'';
	
}

/**
 * Parses textarea HTML
 *
 * @since 2.1.2
 */
function vcex_parse_textarea_html( $html = '' ) {
	if ( $html && base64_decode( $html, true ) ) {
		return rawurldecode( base64_decode( strip_tags( $html ) ) );
	}
	return $html;
}

/**
 * Parses the font_control / typography param
 *
 * @since 2.0.0
 */
function vcex_parse_typography_param( $value ) {

	// Conter value to array
	$value = vc_parse_multi_attribute( $value );
	
	// Define defaults
	$defaults = array(
		'tag'               => '',
		'text_align'        => '',
		'font_size'         => '',
		'line_height'       => '',
		'color'             => '',
		'font_style_italic' => '',
		'font_style_bold'   => '',
		'font_family'       => '',
		'letter_spacing'    => '',
		'font_family'       => '',
	);

	// Parse values so keys exist
	$values = wp_parse_args( $value, $defaults );

	// Return values
	return $values;

}

/**
 * Url param to check for for filters
 *
 * @since 3.2.0
 */
function vcex_grid_filter_url_param() {
	return apply_filters( 'vcex_grid_filter_url_param', 'filter' );
}

/**
 * Return grid filter arguments
 *
 * @since 2.0.0
 */
function vcex_grid_filter_args( $atts = '', $query = '' ) {

	// Return if no attributes found
	if ( ! $atts ) {
		return;
	}

	// Define args
	$args = $include = array();

	// Don't get empty
	$args['hide_empty'] = true;

	// Taxonomy
	if ( ! empty( $atts['filter_taxonomy'] ) ) {
		$taxonomy = $atts['filter_taxonomy'];
	} elseif ( isset( $atts['taxonomy'] ) ) {
		$taxonomy = $atts['taxonomy']; // Fallback
	} else {
		$taxonomy = null;
	}

	// Define post type and taxonomy
	$post_type = ! empty( $atts['post_type'] ) ? $atts['post_type'] : '';

	// Define include/exclude category vars
	$include_cats = ! empty( $atts['include_categories'] ) ? vcex_string_to_array( $atts['include_categories'] ) : '';

	// Check if only 1 category is included
	// If so check if it's a parent item so we can display children as the filter links
	if ( $include_cats && '1' == count( $include_cats ) && $children = get_term_children( $include_cats[0], $taxonomy ) ) {
		$include = $children;
	}

	// Include only terms from current query
	if ( empty( $include ) && $query ) {
		$post_ids = wp_list_pluck( $query->posts, 'ID' );
		foreach ( $post_ids as $post_id ) {
			$terms = wp_get_post_terms( $post_id, $taxonomy, array( 'fields' => 'ids' ) );
			if ( ! empty( $terms ) && is_array( $terms ) ) {
				foreach( $terms as $term ) {
					if ( ! $include_cats ) {
						$include[$term] = $term;
					} elseif ( $include_cats && in_array( $term, $include_cats ) ) {
						$include[$term] = $term;
					}
				}
			}
		}
		$args['include'] = $include;
	}

	// Add to args
	if ( ! empty( $include ) ) {
		$args['include'] = $include;
	}
	if ( ! empty( $exclude ) ) {
		$args['exclude'] = $exclude;
	}

	// Apply filters
	if ( $post_type ) {
		$args = apply_filters( 'vcex_'. $post_type .'_grid_filter_args', $args );
	}

	// Return args
	return $args;

}

/**
 * Convert to array
 *
 * @since 2.0.0
 */
function vcex_string_to_array( $value = array() ) {
	
	// Return wpex function if it exists  
	if ( function_exists( 'wpex_string_to_array' ) ) {
		return wpex_string_to_array( $value );
	}

	// Create our own return
	else {

		// Return null for empty array
		if ( empty( $value ) && is_array( $value ) ) {
			return null;
		}

		// Return if already array
		if ( ! empty( $value ) && is_array( $value ) ) {
			return $value;
		}

		// Clean up value
		$items  = preg_split( '/\,[\s]*/', $value );

		// Create array
		foreach ( $items as $item ) {
			if ( strlen( $item ) > 0 ) {
				$array[] = $item;
			}
		}

		// Return array
		return $array;

	}

}


/**
 * Generates various types of HTML based on a value
 *
 * @since 2.0.0
 */
function vcex_parse_old_design_js() {
	return WPEX_VCEX_DIR_URI . 'assets/parse-old-design.js';
}

/**
 * Generates various types of HTML based on a value
 *
 * @since 2.0.0
 */
function vcex_html( $type, $value, $trim = false ) {

	// Return nothing by default
	$return = '';

	// Return if value is empty
	if ( ! $value ) {
		return;
	}

	// Title attribute
	if ( 'id_attr' == $type ) {
		$value  = trim ( str_replace( '#', '', $value ) );
		$value  = str_replace( ' ', '', $value );
		if ( $value ) {
			$return = ' id="'. esc_attr( $value ) .'"';
		}
	}

	// Title attribute
	if ( 'title_attr' == $type ) {
		$return = ' title="'. esc_attr( $value ) .'"';
	}

	// Link Target
	elseif ( 'target_attr' == $type ) {
		if ( 'blank' == $value
			|| '_blank' == $value
			|| strpos( $value, 'blank' ) ) {
			$return = ' target="_blank"';
		}
	}

	// Link rel
	elseif ( 'rel_attr' == $type ) {
		if ( 'nofollow' == $value ) {
			$return = ' rel="nofollow"';
		}
	}

	// Return HTMl
	if ( $trim ) {
		return trim( $return );
	} else {
		return $return;
	}

}

/**
 * Returns array of image sizes for use in the Customizer
 *
 * @since 2.0.0
 */
function vcex_image_sizes() {
	$sizes = array(
		esc_html__( 'Custom Size', 'total' ) => 'wpex_custom',
	);
	$get_sizes = get_intermediate_image_sizes();
	array_unshift( $get_sizes, 'full' );
	$get_sizes = array_combine( $get_sizes, $get_sizes );
	$sizes     = array_merge( $sizes, $get_sizes );
	return $sizes;
}

/**
 * Notice when no posts are found
 *
 * @since 2.0.0
 */
function vcex_no_posts_found_message( $atts ) {
	if ( wpex_is_front_end_composer() ) {
		return '<div class="vcex-no-posts-found">'. apply_filters( 'vcex_no_posts_found_message', esc_html__( 'No posts found for your query.', 'total' ) ) .'</div>';
	}
}

/**
 * Echos unique ID html for VC modules
 *
 * @since 2.0.0
 */
function vcex_unique_id( $id = '' ) {
	echo vcex_get_unique_id( $id );
}

/**
 * Returns unique ID html for VC modules
 *
 * @since 2.0.0
 */
function vcex_get_unique_id( $id = '' ) {
	if ( $id ) {
		return vcex_html( 'id_attr', $id );
	}
}

/**
 * Returns dummy image
 *
 * @since 2.0.0
 */
function vcex_dummy_image_url() {
	return WPEX_THEME_URI .'/images/dummy-image.jpg';
}

/**
 * Outputs dummy image
 *
 * @since 2.0.0
 */
function vcex_dummy_image() {
	echo '<img src="'. WPEX_THEME_URI .'/images/dummy-image.jpg" />';
}

/**
 * Used to enqueue styles for Visual Composer modules
 *
 * @since 2.0.0
 */
function vcex_enque_style( $type, $value = '' ) {

	// iLightbox
	if ( 'ilightbox' == $type ) {
		wpex_enqueue_ilightbox_skin( $value );
	}

	// Hover animation
	elseif ( 'hover-animations' == $type ) {
		wp_enqueue_style( 'wpex-hover-animations' );
	}

}

/**
 * Array of Icon box styles
 *
 * @since 2.0.0
 */
function vcex_icon_box_styles() {

	// Define array
	$array  = array(
		'one'   => esc_html__( 'Left Icon', 'total' ),
		'seven' => esc_html__( 'Right Icon', 'total' ),
		'two'   => esc_html__( 'Top Icon', 'total' ),
		'three' => esc_html__( 'Top Icon Style 2 - legacy', 'total' ),
		'four'  => esc_html__( 'Outlined and Top Icon - legacy', 'total' ),
		'five'  => esc_html__( 'Boxed and Top Icon - legacy', 'total' ),
		'six'   => esc_html__( 'Boxed and Top Icon Style 2 - legacy', 'total' ),
	);

	// Apply filters
	$array = apply_filters( 'vcex_icon_box_styles', $array );

	// Flip array around for use with VC
	$array = array_flip( $array ); 

	// Return array
	return $array;

}

/**
 * Array of orderby options
 *
 * @since 2.0.0
 */
function vcex_orderby_array() {
	return apply_filters( 'vcex_orderby', array(
		esc_html__( 'Default', 'total')             => '',
		esc_html__( 'Date', 'total')                => 'date',
		esc_html__( 'Title', 'total' )              => 'title',
		esc_html__( 'Name', 'total' )               => 'name',
		esc_html__( 'Modified', 'total')            => 'modified',
		esc_html__( 'Author', 'total' )             => 'author',
		esc_html__( 'Random', 'total')              => 'rand',
		esc_html__( 'Parent', 'total')              => 'parent',
		esc_html__( 'Type', 'total')                => 'type',
		esc_html__( 'ID', 'total' )                 => 'ID',
		esc_html__( 'Comment Count', 'total' )      => 'comment_count',
		esc_html__( 'Menu Order', 'total' )         => 'menu_order',
		esc_html__( 'Meta Key Value', 'total' )     => 'meta_value',
		esc_html__( 'Meta Key Value Num', 'total' ) => 'meta_value_num',
	) );
}

/**
 * Array of ilightbox skins
 *
 * @since 2.0.0
 */
function vcex_ilightbox_skins() {
	$skins = array(
		''  => esc_html__( 'Default', 'total' ),
	);
	$skins = array_merge( $skins, wpex_ilightbox_skins() );
	$skins = array_flip( $skins );
	return $skins;
}

/**
 * Border Radius Classname
 *
 * @since 1.4.0
 */
function vcex_get_border_radius_class( $val ) {
	if ( 'none' == $val || '' == $val ) {
		return;
	}
	return 'wpex-'. $val;
}

/**
 * Helper function for building links using link param
 *
 * @since 2.0.0
 */
function vcex_build_link( $link, $fallback = '' ) {

	// If empty return fallback
	if ( empty( $link ) ) {
		return $fallback;
	}

	// Return if there isn't any link
	if ( '||' == $link ) {
		return;
	}

	// Return simple link escaped (fallback for old textfield input)
	if ( false === strpos( $link, 'url:' ) ) {
		return esc_url( $link );
	}

	// Build link
	$link = vc_build_link( $link );

	// Return array of link data
	return $link;

}

/**
 * Returns link data
 *
 * @since 2.0.0
 */
function vcex_get_link_data( $return, $link, $fallback = '' ) {

	// Get data
	$link = vcex_build_link( $link, $fallback );

	if ( 'url' == $return ) {
		if ( is_array( $link ) && ! empty( $link['url'] ) ) {
			return $link['url'];
		} else {
			return $link;
		}
	}

	if ( 'title' == $return ) {
		if ( is_array( $link ) && ! empty( $link['title'] ) ) {
			return $link['title'];
		} else {
			return $fallback;
		}
	}

	if ( 'target' == $return ) {
		if ( is_array( $link ) && ! empty( $link['target'] ) ) {
			return $link['target'];
		} else {
			return $fallback;
		}
	}

}

/**
 * Helper function enqueues icon fonts from Visual Composer
 *
 * @since 2.0.0
 */
function vcex_enqueue_icon_font( $family = '' ) {

	// Return if VC function doesn't exist
	if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
		return;
	}

	// Return if icon type is empty or it's fontawesome
	if ( empty( $family ) || 'fontawesome' == $family ) {
		return;
	}

	// Enqueue script
	vc_icon_element_fonts_enqueue( $family );

}

/**
 * Returns correct icon class based on icon type
 *
 * @since 2.0.0
 */
function vcex_get_icon_class( $atts, $icon_location ) {

	// Define vars
	$icon = '';
	$icon_type = ! empty( $atts['icon_type'] ) ? $atts['icon_type'] : 'fontawesome';

	// Generate fontawesome icon class
	if ( 'fontawesome' == $icon_type && ! empty( $atts[$icon_location] ) ) {
		$icon = $atts[$icon_location];
		$icon = str_replace( 'fa-', '', $icon );
		$icon = str_replace( 'fa ', '', $icon );
		$icon = 'fa fa-'. $icon;
	} elseif ( ! empty( $atts[ $icon_location .'_'. $icon_type ] ) ) {
		$icon = $atts[ $icon_location .'_'. $icon_type ];
	}

	// Sanitize
	$icon = in_array( $icon, array( 'icon', 'none' ) ) ? '' : $icon;

	// Return icon class
	return $icon;

}

/**
 * Adds inner row margin to compensate for the VC negative margins
 *
 * @since 2.0.0
 */
function vcex_offset_vc( $atts ) {

	// Define some things
	$video_bg = ! empty( $atts['video_bg'] ) ? $atts['video_bg'] : '';

	// No offset added here
	if ( ! empty( $atts['full_width'] ) || ! empty( $atts['max_width'] ) ) {
		return;
	}

	// Get column spacing
	$spacing = ! empty( $atts['column_spacing'] ) ? $atts['column_spacing'] : '30';

	// Return if spacing set to 0px
	if ( '0px' == $spacing ) {
		return;
	}

	// Define offset class
	$classes = 'wpex-offset-vc-'. $spacing/2;

	// Parallax check
	if ( ! empty( $atts['vcex_parallax'] ) && ! empty( $atts['parallax_image'] ) ) {
		return $classes;
	}

	// Self hosted video
	if ( 'self_hosted' == $video_bg && ! empty( $atts['video_bg_mp4'] ) ) {
		return $classes;
	}

	// Youtube videos
	if ( 'youtube' == $video_bg && ! empty( $atts['video_bg_url'] ) ) {
		return $classes;
	}

	// Overlays
	$overlay = isset( $atts['wpex_bg_overlay'] ) ? $atts['wpex_bg_overlay'] : '';
	if ( $overlay ) {
		return $classes;
	}

	// Check for custom CSS
	if ( ! empty( $atts['css'] ) ) {
		if ( strpos( $atts['css'], 'background' )
			|| strpos( $atts['css'], 'border' )
		) {
			return $classes;
		}
	} elseif ( ! empty( $atts['center_row'] )
		|| ! empty( $atts['bg_image'] )
		|| ! empty( $atts['bg_color'] )
		|| ! empty( $atts['border_width'] )
	) {
		return $classes;
	}

}

/**
 * Returns video row background
 *
 * @since 2.0.0
 */
if ( ! function_exists( 'vcex_row_video' ) ) {
	function vcex_row_video( $atts ) {

		// Define output
		$output = '';

		// Extract attributes
		extract( $atts );

		// Return if video_bg is empty
		if ( empty( $video_bg ) && 'self_hosted' != $video_bg ) {
			return;
		}

		// Make sure videos are defined
		if ( ! $video_bg_webm && ! $video_bg_ogv && ! $video_bg_mp4 ) {
			return;
		}

		// Get background image
		$bg_image = ! empty( $bg_image ) ? $bg_image : '';

		// Check sound
		$sound = apply_filters( 'vcex_self_hosted_row_video_sound', false );
		$sound = $sound ? '' : 'muted volume="0"';

		$output .= '<div class="wpex-video-bg-wrap">';
			$output .= '<video class="wpex-video-bg" poster="'. esc_url( $bg_image ) .'" preload="auto" autoplay="true" loop="loop" '. $sound .'>';
				if ( $video_bg_webm ) {
					$output .= '<source src="'. $video_bg_webm .'" type="video/webm" />';
				}
				if ( $video_bg_ogv ) {
					$output .= '<source src="'. $video_bg_ogv .'" type="video/ogg ogv" />';
				}
				if ( $video_bg_mp4 ) {
					$output .= '<source src="'. $video_bg_mp4 .'" type="video/mp4" />';
				}
			$output .= '</video>';
		$output .= '</div>';

		// Video overlay fallack
		if ( ! empty( $video_bg_overlay ) && 'none' != $video_bg_overlay ) {

			$output .= '<span class="wpex-video-bg-overlay '. $video_bg_overlay .'"></span>';

		}

		return $output;

	}
}

/**
 * Returns row parallax background
 *
 * @since 2.0.0
 */
if ( ! function_exists( 'vcex_parallax_bg' ) ) {

	function vcex_parallax_bg( $atts ) {

		// Extract attributes
		extract( $atts );

		// Make sure parallax is enabled
		if ( empty( $vcex_parallax ) ) {
			return;
		}

		// Return if a video is defined
		if ( ! empty( $video_bg ) && 'none' != $video_bg ) {
			return;
		}

		// Sanitize $bg_image
		$bg_image = ! empty( $atts['parallax_image'] ) ? wp_get_attachment_url( $atts['parallax_image'] ) : $bg_image;

		// Background image is obviously required
		if ( empty( $bg_image ) ) {
			return;
		}

		// Load inline js
		vcex_inline_js( array( 'parallax' ) );

		// Sanitize data
		$parallax_style     = ! empty( $parallax_style ) ? $parallax_style : ''; // Default should be cover
		$parallax_speed     = ! empty( $parallax_speed ) ? abs( $parallax_speed ) : '0.2';
		$parallax_direction = ! empty( $parallax_direction ) ? $parallax_direction : 'top';

		// Classes
		$classes = array( 'wpex-parallax-bg' );
		$classes[] = esc_attr( $parallax_style );
		if ( ! $parallax_mobile ) {
			 $classes[] = 'not-mobile';
		}
		$classes = apply_filters( 'wpex_parallax_classes', $classes );
		$classes = implode( ' ', $classes );

		// Add style
		$style = ' style="background-image: url('. $bg_image .');"';

		// Attributes
		$attributes = ' data-direction="'. $parallax_direction .'" data-velocity="-'. $parallax_speed .'"';

		return '<div class="'. $classes .'"'. $style . $attributes .'></div>';

	}

}

/**
 * Returns row overlay span
 *
 * @since 3.5.0
 */
function vcex_row_overlay( $atts ) {
	$overlay = isset( $atts['wpex_bg_overlay'] ) ? $atts['wpex_bg_overlay'] : '';
	if ( $overlay && 'none' != $overlay ) {
		$style = vcex_inline_style( array(
			'background_color' => isset( $atts['wpex_bg_overlay_color'] ) ? $atts['wpex_bg_overlay_color'] : '',
			'opacity' => isset( $atts['wpex_bg_overlay_opacity'] ) ? $atts['wpex_bg_overlay_opacity'] : '',
		) );
		return '<span class="wpex-bg-overlay '. $overlay.'"'. $style .'></span>';
	}
}

/**
 * Array of social links profiles to loop through
 *
 * @since 2.0.0
 */
function vcex_social_links_profiles() {
	if ( function_exists( 'wpex_topbar_social_options' ) ) {
		$profiles = wpex_topbar_social_options();
	}
	return apply_filters( 'vcex_social_links_profiles', $profiles );
}

/**
 * Array of pixel icons
 *
 * @since 1.4.0
 */
if ( ! function_exists( 'vcex_pixel_icons' ) ) {
	function vcex_pixel_icons() {
		return array(
			array( 'vc_pixel_icon vc_pixel_icon-alert' => esc_html__( 'Alert', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-info' => esc_html__( 'Info', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-tick' => esc_html__( 'Tick', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-explanation' => esc_html__( 'Explanation', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-address_book' => esc_html__( 'Address book', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-alarm_clock' => esc_html__( 'Alarm clock', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-anchor' => esc_html__( 'Anchor', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-application_image' => esc_html__( 'Application Image', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-arrow' => esc_html__( 'Arrow', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-asterisk' => esc_html__( 'Asterisk', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-hammer' => esc_html__( 'Hammer', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-balloon' => esc_html__( 'Balloon', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-balloon_buzz' => esc_html__( 'Balloon Buzz', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-balloon_facebook' => esc_html__( 'Balloon Facebook', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-balloon_twitter' => esc_html__( 'Balloon Twitter', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-battery' => esc_html__( 'Battery', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-binocular' => esc_html__( 'Binocular', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_excel' => esc_html__( 'Document Excel', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_image' => esc_html__( 'Document Image', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_music' => esc_html__( 'Document Music', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_office' => esc_html__( 'Document Office', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_pdf' => esc_html__( 'Document PDF', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_powerpoint' => esc_html__( 'Document Powerpoint', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-document_word' => esc_html__( 'Document Word', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-bookmark' => esc_html__( 'Bookmark', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-camcorder' => esc_html__( 'Camcorder', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-camera' => esc_html__( 'Camera', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-chart' => esc_html__( 'Chart', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-chart_pie' => esc_html__( 'Chart pie', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-clock' => esc_html__( 'Clock', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-fire' => esc_html__( 'Fire', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-heart' => esc_html__( 'Heart', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-mail' => esc_html__( 'Mail', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-play' => esc_html__( 'Play', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-shield' => esc_html__( 'Shield', 'total' ) ),
			array( 'vc_pixel_icon vc_pixel_icon-video' => esc_html__( 'Video', 'total' ) ),
		);
	}
}

/**
 * Sets image size to full if image height/width are empty
 *
 * @since 3.0.0
 */
function vcex_parse_image_size( $atts ) {
	$img_size = ( isset( $atts['img_size'] ) && 'wpex_custom' == $atts['img_size'] ) ? 'wpex_custom' : '';
	$img_size = empty( $atts['img_size'] ) ? 'wpex_custom' : '';
	if ( 'wpex_custom' == $img_size && empty( $atts['img_height'] ) && empty( $atts['img_width'] ) ) {
		$atts['img_size'] = 'full';
	}
	return $atts;
}

/**
 * Parses deprecated content settings in Total VC grid modules
 *
 * @since 3.0.0
 */
function vcex_parse_deprecated_grid_entry_content_css( $atts ) {

	// Disable border
	$content_border = ! empty( $atts['content_border'] ) ? $atts['content_border'] : '';
	if ( '0px' == $content_border || 'none' == $content_border ) {
		$atts['content_border'] = 'false';
	}

	// Parse css
	if ( empty( $atts['content_css'] ) ) {

		// Define css var
		$css = '';

		// Background Color - No Image
		$bg = ! empty( $atts['content_background'] ) ? $atts['content_background'] : '';
		if ( $bg ) {
			$css .= 'background-color: '. $bg .';';
		}

		// Border
		$border = ! empty( $atts['content_border'] ) ? $atts['content_border'] : '';
		if ( $border ) {
			if ( '0px' == $border || 'none' == $border ) {
				$css .= 'border: 0px none rgba(255,255,255,0.01);'; // reset border
			} else {
				$css .= 'border: '. $border .';';
			}
		}

		// Padding
		$padding = ! empty( $atts['content_padding'] ) ? $atts['content_padding'] : '';
		if ( $padding ) {
			$css .= 'padding: '. $padding .';';
		}

		// Margin
		$margin = ! empty( $atts['content_margin'] ) ? $atts['content_margin'] : '';
		if ( $margin ) {
			$css .= 'margin: '. $margin .';';
		}

		// Update css var
		if ( $css ) {
			$css = '.temp{'. $css .'}';
		}

		// Add css to attributes
		$atts['content_css'] = $css;

		// Unset old vars
		unset( $atts['content_background'] );
		unset( $atts['content_padding'] );
		unset( $atts['content_margin'] );
		unset( $atts['content_border'] );

	}

	// Return $atts
	return $atts;

}

/**
 * Parses deprecated css fields into new css_editor field
 *
 * @since 3.0.0
 */
function vcex_parse_deprecated_row_css( $atts, $return = 'temp_class' ) {

	// Parse CSS if empty and enabled
	$parse_css = apply_filters( 'vcex_parse_deprecated_row_css', true );

	// Return if disabled
	if ( ! $parse_css ) {
		return;
	}

	$new_css = '';

	// Margin top
	if ( ! empty( $atts['margin_top'] ) ) {
		$new_css .= 'margin-top: '. wpex_sanitize_data( $atts['margin_top'], 'px-pct' ) .';';
	}

	// Margin bottom
	if ( ! empty( $atts['margin_bottom'] ) ) {
		$new_css .= 'margin-bottom: '. wpex_sanitize_data( $atts['margin_bottom'], 'px-pct' ) .';';
	}

	// Margin right
	if ( ! empty( $atts['margin_right'] ) ) {
		$new_css .= 'margin-right: '. wpex_sanitize_data( $atts['margin_right'], 'px-pct' ) .';';
	}

	// Margin left
	if ( ! empty( $atts['margin_left'] ) ) {
		$new_css .= 'margin-left: '. wpex_sanitize_data( $atts['margin_left'], 'px-pct' ) .';';
	}

	// Padding top
	if ( ! empty( $atts['padding_top'] ) ) {
		$new_css .= 'padding-top: '. wpex_sanitize_data( $atts['padding_top'], 'px-pct' ) .';';
	}

	// Padding bottom
	if ( ! empty( $atts['padding_bottom'] ) ) {
		$new_css .= 'padding-bottom: '. wpex_sanitize_data( $atts['padding_bottom'], 'px-pct' ) .';';
	}

	// Padding right
	if ( ! empty( $atts['padding_right'] ) ) {
		$new_css .= 'padding-right: '. wpex_sanitize_data( $atts['padding_right'], 'px-pct' ) .';';
	}

	// Padding left
	if ( ! empty( $atts['padding_left'] ) ) {
		$new_css .= 'padding-left: '. wpex_sanitize_data( $atts['padding_left'], 'px-pct' ) .';';
	}

	// Border
	if ( ! empty( $atts['border_width'] ) && ! empty( $atts['border_color'] ) ) {
		$border_width = explode( ' ', $atts['border_width'] );
		$border_style = isset( $atts['border_style'] ) ? $atts['border_style'] : 'solid';
		$bcount = count( $border_width );
		if ( '1' == $bcount ) {
			$new_css .= 'border: '. $border_width[0] . ' '. $border_style .' '. $atts['border_color'] .';';
		} else {
			$new_css .= 'border-color: '. $atts['border_color'] .';';
			$new_css .= 'border-style: '. $border_style .';';
			if ( '2' == $bcount ) {
				$new_css .= 'border-top-width: '. $border_width[0] .';';
				$new_css .= 'border-bottom-width: '. $border_width[0] .';';
				$bw = isset( $border_width[1] ) ? $border_width[1] : '0px';
				$new_css .= 'border-left-width: '. $bw .';';
				$new_css .= 'border-right-width: '. $bw .';';
			} else {
				$new_css .= 'border-top-width: '. $border_width[0] .';';
				$bw = isset( $border_width[1] ) ? $border_width[1] : '0px';
				$new_css .= 'border-right-width: '. $bw .';';
				$bw = isset( $border_width[2] ) ? $border_width[2] : '0px';
				$new_css .= 'border-bottom-width: '. $bw .';';
				$bw = isset( $border_width[3] ) ? $border_width[3] : '0px';
				$new_css .= 'border-left-width: '. $bw .';';
			}
		}
	}

	// Background image
	if ( ! empty( $atts['bg_image'] ) ) {
		if ( 'temp_class' == $return ) {
			$bg_image = wp_get_attachment_url( $atts['bg_image'] ) .'?id='. $atts['bg_image'];
		} elseif ( 'inline_css' == $return ) {
			if ( is_numeric( $atts['bg_image'] ) ) {
				$bg_image = wp_get_attachment_url( $atts['bg_image'] );
			} else {
				$bg_image = $atts['bg_image'];
			}
		}
	}

	// Background Image & Color
	if ( ! empty( $bg_image ) && ! empty( $atts['bg_color'] ) ) {
		$style = ! empty( $atts['bg_style'] ) ? $atts['bg_style'] : 'stretch';
		$position = '';
		$repeat   = '';
		$size     = '';
		if ( 'stretch' == $style ) {
			$position = 'center';
			$repeat   = 'no-repeat';
			$size     = 'cover';
		}
		if ( 'fixed' == $style ) {
			$position = '0 0';
			$repeat   = 'no-repeat';
		}
		if ( 'repeat' == $style ) {
			$position = '0 0';
			$repeat   = 'repeat';
		}
		$new_css .= 'background: '. $atts['bg_color'] .' url('. $bg_image .');';
		if ( $position ) {
			$new_css .= 'background-position: '. $position .';';
		}
		if ( $repeat ) {
			$new_css .= 'background-repeat: '. $repeat .';';
		}
		if ( $size ) {
			$new_css .= 'background-size: '. $size .';';
		}
	}

	// Background Image - No Color
	if ( ! empty( $bg_image ) && empty( $atts['bg_color'] ) ) {
		$new_css .= 'background-image: url('. $bg_image .');'; // Add image
		$style = ! empty( $atts['bg_style'] ) ? $atts['bg_style'] : 'stretch'; // Generate style
		$position = '';
		$repeat   = '';
		$size     = '';
		if ( 'stretch' == $style ) {
			$position = 'center';
			$repeat   = 'no-repeat';
			$size     = 'cover';
		}
		if ( 'fixed' == $style ) {
			$position = '0 0';
			$repeat   = 'no-repeat';
		}
		if ( 'repeat' == $style ) {
			$position = '0 0';
			$repeat   = 'repeat';
		}
		if ( $position ) {
			$new_css .= 'background-position: '. $position .';';
		}
		if ( $repeat ) {
			$new_css .= 'background-repeat: '. $repeat .';';
		}
		if ( $size ) {
			$new_css .= 'background-size: '. $size .';';
		}
	}

	// Background Color - No Image
	if ( ! empty( $atts['bg_color'] ) && empty( $bg_image ) ) {
		$new_css .= 'background-color: '. $atts['bg_color'] .';';
	}

	// Return new css
	if ( $new_css ) {
		if ( 'temp_class' == $return ) {
			return '.temp{'. $new_css .'}';
		} elseif ( 'inline_css' == $return ) {
			return $new_css;
		}
	}

}

/**
 * Fallback to prevent JS error - DO NOT REMOVE!!!!!!
 *
 * @since 2.0.0
 */
if ( ! function_exists( 'vc_icon_element_fonts_enqueue' ) ) {
	function vc_icon_element_fonts_enqueue( $font ) {
		switch ( $font ) {
			case 'openiconic':
				wp_enqueue_style( 'vc_openiconic' );
				break;
			case 'typicons':
				wp_enqueue_style( 'vc_typicons' );
				break;
			case 'entypo':
				wp_enqueue_style( 'vc_entypo' );
				break;
			case 'linecons':
				wp_enqueue_style( 'vc_linecons' );
				break;
			case 'monosocial':
				wp_enqueue_style( 'vc_monosocialiconsfont' );
				break;
			default:
				do_action( 'vc_enqueue_font_icon_element', $font ); // hook to custom do enqueue style
		}
	}
}

/*-----------------------------------------------------------------------------------*/
/* - Deprecated Functions
/*-----------------------------------------------------------------------------------*/
function vcex_sanitize_data() {
	_deprecated_function( 'vcex_sanitize_data', '3.0.0', 'wpex_sanitize_data' );
}
function vcex_image_rendering() {
	return;
}