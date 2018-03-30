<?php
/**
 * Functions used in the header
 */

if( ! function_exists( 'media_center_header_style' ) ) {
	function media_center_header_style() {
		return apply_filters( 'mc_get_header_style', 'header-style-1' );
	}
}

if( ! function_exists( 'media_center_site_favicon' ) ) {
	function media_center_site_favicon() {
		$favicon_url = apply_filters( 'mc_site_favicon_url', get_template_directory_uri() . '/assets/images/favicon.ico' );
		echo '<link rel="shortcut icon" href="' . esc_url( $favicon_url ) . '">';
	}
}

if( ! function_exists( 'mc_output_search_bar' ) ) {
	function mc_output_search_bar() {
		if( defined( 'ECWID_DEMO_STORE_ID' ) ) {
            mc_get_template( 'ecwid/mc-search-bar.php' );
        } else {
            mc_get_template( 'header/mc-search-bar.php' );
        }
	}
}

if ( ! function_exists( 'media_center_add_data_hover_attribute' ) ) {
	function media_center_add_data_hover_attribute( $atts, $item, $args, $depth ) {
		// If item has_children add atts to a.
		$should_add_toggle = false;

		if( $args->theme_location == 'departments' ) {
			$should_add_toggle = false;
		} else {
			$should_add_toggle = $depth < 1;
		}

		if ( $args->has_children && $should_add_toggle ) {

			$dropdown_trigger = apply_filters( 'mc_' . $args->theme_location . '_dropdown_trigger', 'click', $args->theme_location );
			if( isset( $args->dropdown_trigger) && ! empty( $args->dropdown_trigger ) ) {
				$dropdown_trigger = $args->dropdown_trigger;
			}
			if( $dropdown_trigger == 'hover' ) {
				$atts['data-hover'] = 'dropdown';
				
				if( isset( $atts['data-toggle'] ) ) {
					unset( $atts['data-toggle'] );
				}
			}
		}
		
		return $atts;
	}
}