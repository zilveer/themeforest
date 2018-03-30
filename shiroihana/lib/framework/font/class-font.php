<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

require 'class-fvd.php';
require 'class-websafe.php';
require 'class-google-font.php';
require 'class-typekit.php';

final class Youxi_Font {

	private static $processed_settings = null;

	private static function settings() {

		if( ! is_null( self::$processed_settings ) ) {
			return self::$processed_settings;
		}

		/* Get the font settings */
		$settings = apply_filters( 'youxi_font_settings', array() );

		/* Process the raw settings */
		$processed = array();
		foreach( array_keys( $settings ) as $key ) {
			$processed[ $key ] = self::walk_settings( $settings, $key );
		}

		return ( self::$processed_settings = $processed );
	}

	private static function walk_settings( $settings, $key, $visited = array() ) {
		$setting = $settings[ $key ];
		$visited[] = $key;
		if( isset( $setting['inherits'], $settings[ $setting['inherits'] ] ) && ! in_array( $setting['inherits'], $visited ) ) {
			$inherited = self::walk_settings( $settings, $setting['inherits'], $visited );
			if( isset( $inherited['include_all_styles'] ) ) {
				if( isset( $setting['include_all_styles'] ) ) {
					$setting['include_all_styles'] = (bool) $setting['include_all_styles'] || (bool) $inherited['include_all_styles'];
				} else {
					$setting['include_all_styles'] = (bool) $inherited['include_all_styles'];
				}
			}
			if( isset( $inherited['additional_weights'] ) ) {
				if( isset( $setting['additional_weights'] ) ) {
					$setting['additional_weights'] = array_merge( $setting['additional_weights'], $inherited['additional_weights'] );
				} else {
					$setting['additional_weights'] = $inherited['additional_weights'];
				}
				$setting['additional_weights'] = array_unique( $setting['additional_weights'] );
			}
		}

		return $setting;
	}

	private static function options() {

		static $font_options = null;
		if( ! is_null( $font_options ) ) {
			return $font_options;
		}

		$font_settings = self::settings();
		$font_keys = array_keys( $font_settings );

		$options = apply_filters( 'youxi_font_options', array() );
		$options = array_intersect_key( $options, array_flip( $font_keys ) );

		$google_fonts  = array();
		$typekit_fonts = array();
		$websafe_fonts = array();
		
		foreach( $options as $key => $option ) {

			/* Make overriding font values possible */
			if( isset( $_GET[ $key ] ) ) {
				$option = $_GET[ $key ];
			}

			/* Make sure the option is a string */
			if( ! is_string( $option ) ) {
				$option = '';
			}

			/* Matching inputs are either Typekit, Websafe or Google Font */
			if( preg_match( '/^(typekit|google|websafe)\/(.+)$/', $option, $matches ) ) {

				$type  = $matches[1];
				$value = $matches[2];

				if( ! self::is_valid_font( $type, $value ) ) {
					$type  = 'google';
					$value = '';
				}
				${$type . '_fonts'}[ $key ] = $value;

			} else {

				/* Others are Google Font */
				$google_fonts[ $key ] = self::is_valid_font( 'google', $option ) ? $option : '';
			}

			/* Remove inherited, empty Google Fonts */
			if( isset( $google_fonts[ $key ], $font_settings[ $key ]['inherits'] ) && empty( $google_fonts[ $key ] ) ) {
				unset( $google_fonts[ $key ] );
			}
		}

		/* Compare Google Font to Defaults */
		$google_font_defaults = wp_list_pluck( $font_settings, 'default' );
		$google_font_defaults = array_intersect_key( $google_font_defaults, $google_fonts );

		/* Merge Google Fonts with the defaults */
		$google_fonts = array_filter( $google_fonts );
		$google_fonts = array_merge( $google_font_defaults, $google_fonts );
		
		return ( $font_options = array( 'google' => $google_fonts, 'typekit' => $typekit_fonts, 'websafe' => $websafe_fonts ) );
	}

	public static function has_websafe() {
		$font_options = self::options();
		return ! empty( $font_options['websafe'] );
	}

	public static function websafe_css() {
		$font_options = self::options();
		$websafe_fonts = $font_options['websafe'];

		$css = array();
		foreach( $websafe_fonts as $key => $str ) {
			$css[ $key ] = Youxi_Websafe::to_css( $str );
		}

		return array_filter( $css );
	}

	public static function has_typekit() {
		$font_options = self::options();
		return ! empty( $font_options['typekit'] );
	}

	public static function typekit_css() {
		$font_options = self::options();
		$typekit_fonts = $font_options['typekit'];

		$css = array();
		foreach( $typekit_fonts as $key => $str ) {
			$css[ $key ] = Youxi_Typekit::to_css( $str );
		}

		return array_filter( $css );
	}

	public static function has_google_font() {
		$font_options = self::options();
		return ! empty( $font_options['google'] );
	}

	public static function google_font_css() {
		$font_options = self::options();
		$google_fonts = $font_options['google'];

		$css = array();
		foreach( $google_fonts as $key => $str ) {
			$css[ $key ] = Youxi_Google_Font::to_css( $str );
		}

		return array_filter( $css );
	}

	public static function google_font_request_url() {
		$font_options = self::options();
		$google_fonts = $font_options['google'];

		/* Prepare Request */
		$request = Youxi_Google_Font::build_request( $google_fonts, self::settings() );
		
		/* Generate Google Font Request URL */
		return Youxi_Google_Font::request_url( $request['families'], $request['subsets'] );
	}

	public static function is_valid_font( $type, $value ) {

		switch( $type ) {
			case 'typekit':
				$result = Youxi_Typekit::to_css( $value );
				break;
			case 'google':
				$result = Youxi_Google_Font::to_css( $value );
				break;
			case 'websafe':
				$result = Youxi_Websafe::to_css( $value );
				break;
		}

		return isset( $result );
	}

	public static function get_css() {
		return array_merge( self::google_font_css(), self::typekit_css(), self::websafe_css() );
	}

	public static function get_less_vars() {

		$font_css  = self::get_css();
		$font_vars = array();

		foreach( $font_css as $key => $css ) {

			if( ! is_array( $css ) ) {
				continue;
			}

			$font_var_key = preg_replace( array( '/_/', '/(-|_)?font$/' ), array( '-' ), $key );

			foreach( array( 'family', 'weight', 'style' ) as $prop ) {

				if( isset( $css['font-' . $prop ] ) ) {
					$font_vars[ $font_var_key . '-font-' . $prop  ] = $css['font-' . $prop ];
				}
			}
		}

		return $font_vars;
	}
}