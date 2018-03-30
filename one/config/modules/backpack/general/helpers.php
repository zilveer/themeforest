<?php

if( ! function_exists( 'thb_get_copyright' ) ) {
	/**
	 * Get the site copyright message.
	 *
	 * @return string
	 */
	function thb_get_copyright() {
		$copyright = thb_get_option( 'copyright' );
		$copyright = wp_kses( $copyright, array(
			'a' => array(
				'href' => array(),
				'title' => array(),
				'target' => array()
			),
			'br' => array(),
			'em' => array(),
			'strong' => array(),
			'span' => array(),
			'div' => array(
				'class' => array()
			),
		) );
		$translated_copyright = explode( "\n", $copyright );

		if ( count( $translated_copyright ) > 1 ) {
			$locale = thb_get_current_locale();

			foreach ( $translated_copyright as $string ) {
				if ( preg_match( "/^.{2}_.{2}:/i", $string ) ) {
					list( $string_locale, $string_text ) = explode( ':', $string );

					if ( $string_locale === $locale ) {
						$copyright = ltrim( $string, $string_locale . ':' );
						break;
					}
				}
			}
		}

		return apply_filters( 'thb_get_copyright', $copyright );
	}
}

if( ! function_exists( 'thb_copyright' ) ) {
	/**
	 * Display the site copyright message.
	 */
	function thb_copyright() {
		echo thb_get_copyright();
	}
}

if( ! function_exists('thb_logo') ) {
	/**
	 * Display a graphic logo or its textual counterpart.
	 */
	function thb_logo( $class = '' ) {
		$logo             = apply_filters( 'thb_logo', thb_get_option( 'main_logo' ) );
		$logo_2x          = apply_filters( 'thb_logo_2x', thb_get_option( 'main_logo_retina' ) );
		$logo_description = apply_filters( 'thb_logo_description', get_bloginfo( 'description' ) );

		$args = array(
			'class'       => $class,
			'logo'        => thb_image_get_size( $logo ),
			'logo_2x'     => thb_image_get_size( $logo_2x ),
			'description' => $logo_description,
		);

		if ( ! empty( $args['logo'] ) && ! empty( $args['logo_2x'] ) ) {
			$args['logo_metadata'] = wp_get_attachment_metadata( $logo );
			$args['logo_2x_metadata'] = wp_get_attachment_metadata( $logo_2x );
		}

		thb_get_subtemplate( 'backpack/general', dirname(__FILE__), 'logo', $args );
	}
}