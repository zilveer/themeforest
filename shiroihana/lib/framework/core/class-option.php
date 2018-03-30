<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

final class Youxi_Option {

	public function keys() {

		static $keys = array();
		
		if( empty( $keys ) ) {
			$keys = array_keys( $this->defaults() );
		}

		return $keys;
	}

	public function defaults() {
		return apply_filters( 'youxi_option_defaults', array() );
	}

	public function get_all() {

		static $theme_options_cache = null;

		if( ! is_null( $theme_options_cache ) && ! is_customize_preview() ) {
			return $theme_options_cache;
		}

		$theme = wp_get_theme();
		$theme_mod_key = preg_replace( '/\W/', '_', $theme->stylesheet ) . '_settings';

		$options = get_theme_mod( $theme_mod_key, '__not_initialized' );

		if( '__not_initialized' === $options ) {
			$options = $this->defaults();
			set_theme_mod( $theme_mod_key, $options );
		}

		return ( $theme_options_cache = $options );
	}

	public function get( $option_id, $default = '' ) {

		static $cached_options = array();

		if( in_array( $option_id, $this->keys() ) && isset( $_GET[ $option_id ] ) ) {
			return $_GET[ $option_id ];
		}

		if( isset( $cached_options[ $option_id ] ) && ! is_customize_preview() ) {
			return $cached_options[ $option_id ];
		}

		$ot_keys   = apply_filters( 'youxi_option_ot_keys', array() );
		$ot_on_off = apply_filters( 'youxi_option_ot_on_off', array() );

		if( in_array( $option_id, $ot_keys ) ) {
			
			if( in_array( $option_id, $ot_on_off ) ) {
				$return  = ( 'on' === ot_get_option( $option_id, $default ) );
			} else {
				$return = ot_get_option( $option_id, $default );	
			}

		} else {

			$defaults = $this->defaults();
			$options  = $this->get_all();

			if( isset( $options[ $option_id ] ) ) {
				$return = $options[ $option_id ];
			} elseif( isset( $defaults[ $option_id ] ) ) {
				$return = $defaults[ $option_id ];
			} else {
				$return = $default;
			}

		}

		return ( $cached_options[ $option_id ] = $return );
	}
}
