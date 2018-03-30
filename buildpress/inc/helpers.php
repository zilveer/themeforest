<?php
/**
 * Helper functions
 *
 * @package BuildPress
 */



/**
 * comments_number() does not use _n function, here we are to fix that
 * @return void
 */
if ( ! function_exists( 'buildpress_pretty_comments_number' ) ) {
	function buildpress_pretty_comments_number() {
		global $post;
		printf(
			/* translators: %s represents a number */
			_n( '%s Comment', '%s Comments', get_comments_number(), 'buildpress_wp' ),
			number_format_i18n( get_comments_number() )
		);
	}
}



/**
 * Prepare the srcset attribute value.
 * @param  int $img_id ID of the image
 * @uses http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
 * @return string
 */
if ( ! function_exists( 'buildpress_get_slide_sizes' ) ) {
	function buildpress_get_slide_sizes( $img_id ) {
		$srcset = array();

		$sizes = array( 'jumbotron-slider-s', 'jumbotron-slider-m', 'jumbotron-slider-l' );

		foreach ( $sizes as $size ) {
			$img = wp_get_attachment_image_src( $img_id, $size );
			$srcset[] = sprintf( '%s %sw', $img[0], $img[1] );
		}

		return implode( ', ' , $srcset );
	}
}



/**
 * Set some things when the theme is activated
 */
if ( ! function_exists( 'buildpress_theme_activated' ) ) {
	function buildpress_theme_activated() {
		// Save the version when the BuildPress was installed
		add_option( 'buildpress_initial_version', BUILDPRESS_WP_VERSION );
	}
	add_action( 'after_switch_theme', 'buildpress_theme_activated' );
}



/**
 * Helper function to get terms (categories) for custom post types
 * @param  int $post_id
 * @param  string $taxonomy
 * @return array
 */
if ( ! function_exists( 'buildpress_get_custom_categories' ) ) {
	function buildpress_get_custom_categories( $post_id, $taxonomy ) {
		$out = array();
		$terms = get_the_terms( $post_id, $taxonomy );

		if ( ! is_array( $terms ) ) {
			return array();
		}

		foreach ( $terms as $term ) {
			$out[$term->slug] = $term->name;
		}

		return $out;
	}
}



/**
 * Check if WooCommerce is active
 * @return boolean
 */
if ( ! function_exists( 'is_woocommerce_active' ) ) {
	function is_woocommerce_active() {
		return class_exists( 'Woocommerce' );
	}
}



/**
 * Append right body classes to the
 * @return string
 */
if ( ! function_exists( 'buildpress_body_class' ) ) {
	function buildpress_body_class() {
		$out = array();

		if ( 'boxed' === get_theme_mod( 'layout_mode', 'wide' ) ) {
			$out[] = 'boxed';
		}

		if ( 'sticky' === get_theme_mod( 'main_navigation_sticky', 'static' ) ) {
			$out[] = 'fixed-navigation';
		}

		if ( 'light' === get_theme_mod( 'theme_style', 'classic' ) ) {
			$out[] = 'header-light';
		}

		return implode( ' ', $out );
	}
}



/**
 * Create a style for the HTML attribute from the array of the CSS properties
 */
if ( ! function_exists( 'buildpress_create_style_attr' ) ) {
	function buildpress_create_style_attr( $attrs ) {
		$bg_style = '';

		if( ! empty( $attrs ) ) {
			$bg_style = ' style="';
			foreach ( $attrs as $key => $value ) {
				$trimmed_val = trim( $value );
				if ( ! empty( $trimmed_val ) ) {
					if( 'background-image' === $key ) {
						$bg_style .= $key . ': url(\'' . esc_url( $trimmed_val ) . '\'); ';
					}
					else {
						$bg_style .= $key . ': ' . $trimmed_val . '; ';
					}
				}
			}
			$bg_style .= '"';
		}

		return $bg_style;
	}
}



/**
 * Display previous or next link on project page
 */
if ( ! function_exists( 'buildpress_get_next_prev_project_link' ) ) {
	function buildpress_get_next_prev_project_link( $previous, $title ) {
		$link = get_permalink( get_adjacent_post( false, '', $previous ) );
		if ( get_permalink() != $link ): ?>
			<a href="<?php echo esc_url( $link ) . '#project-navigation-anchor'; ?>"><?php echo wp_kses_post($title); ?></a>
		<?php
		endif;
	}
}



/**
 * Checks if the theme was installed after the specified version.
 * @param  string $version_to_compare
 * @return boolean
 */
if ( ! function_exists( 'buildpress_installed_after' ) ) {
	function buildpress_installed_after( $version_to_compare ) {
		return get_option( 'buildpress_initial_version' ) && version_compare( get_option( 'buildpress_initial_version' ), $version_to_compare, '>' );
	}
}



/**
 * Return url with Google Fonts.
 *
 * @see https://github.com/grappler/wp-standard-handles/blob/master/functions.php
 * @return string Google fonts URL for the theme.
 */
function buildpress_google_web_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = array( 'latin' );

	$fonts = apply_filters( 'pre_google_web_fonts', $fonts );

	foreach ( $fonts as $key => $value ) {
		$fonts[ $key ] = $key . ':' . implode( ',', $value );
	}

	/* translators: To add an additional character subset specific to your language, translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language. */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'buildpress_wp' );
	if ( 'cyrillic' == $subset ) {
		array_push( $subsets, 'cyrillic', 'cyrillic-ext' );
	} elseif ( 'greek' == $subset ) {
		array_push( $subsets, 'greek', 'greek-ext' );
	} elseif ( 'devanagari' == $subset ) {
		array_push( $subsets, 'devanagari' );
	} elseif ( 'vietnamese' == $subset ) {
		array_push( $subsets, 'vietnamese' );
	}

	$subsets = apply_filters( 'subsets_google_web_fonts', $subsets );

	if ( $fonts ) {
		$fonts_url = add_query_arg(
			array(
				'family' => urlencode( implode( '|', $fonts ) ),
				'subset' => urlencode( implode( ',', array_unique( $subsets ) ) ),
			),
			'//fonts.googleapis.com/css'
		);
	}

	return apply_filters( 'google_web_fonts_url', $fonts_url );
}


/**
 * Prepare the srcset attribute value.
 * @param  int $img_id ID of the image
 * @param  array $sizes array of the image sizes. Example: $sizes = array( 'thumbnail', 'full' );
 * @uses http://codex.wordpress.org/Function_Reference/wp_get_attachment_image_src
 * @return string
 */
if ( ! function_exists( 'buildpress_get_attachment_image_srcs' ) ) {
	function buildpress_get_attachment_image_srcs( $img_id, $sizes ) {
		$srcset = array();

		foreach ( $sizes as $size ) {
			$img = wp_get_attachment_image_src( $img_id, $size );
			$srcset[] = sprintf( '%s %sw', $img[0], $img[1] );
		}

		return implode( ', ' , $srcset );
	}
}


/**
 * Get the Google maps API URL with API key.
 */
if ( ! function_exists( 'buildpress_get_google_maps_api_url' ) ) {
	function buildpress_get_google_maps_api_url() {
		$google_maps_api_url = '//maps.google.com/maps/api/js';
		$google_maps_api_key = get_theme_mod( 'google_maps_api_key', '' );

		if ( ! empty( $google_maps_api_key ) ) {
			$google_maps_api_url = add_query_arg( 'key', $google_maps_api_key, $google_maps_api_url );
		}

		return $google_maps_api_url;
	}
}
