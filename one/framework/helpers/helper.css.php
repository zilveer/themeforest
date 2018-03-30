<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * CSS helpers.
 *
 * This file contains utility functions concerning CSS stylesheets and rules
 * generation.
 *
 * ---
 *
 * The Happy Framework: WordPress Development Framework
 * Copyright 2014, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2014, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 2.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

if( ! function_exists( 'thb_customizer' ) ) {
	/**
	 * Display the customizer generated CSS code.
	 */
	function thb_customizer() {
		global $wp_customize;

		$theme = get_option( 'stylesheet' );

		if ( empty( $wp_customize ) && get_option( "theme_mods_$theme" ) === false ) {
			return '';
		}

		add_action( 'wp_head', 'thb_customizer_imports', 0 );
		add_action( 'wp_head', 'thb_customizer_output', 9999 );
	}
}

if( ! function_exists( 'thb_customizer_get_output' ) ) {
	/**
	 * Get the customizer CSS output.
	 *
	 * @return string
	 */
	function thb_customizer_get_output() {
		$output = '';

		$thb_customizer = thb_theme()->getCustomizer();

		foreach ( $thb_customizer->getSections() as $section ) {
			foreach ( $section->getSettings() as $setting ) {
				$mod = get_theme_mod( $setting->getKey() );

				if ( $mod == $setting->getDefault() || $mod == '' ) {
					continue;
				}

				/**
				 * Rules
				 */
				foreach ( $setting->getRules() as $rule ) {
					$output .= $rule['selector'] . ' { ';
						foreach ( $rule['properties'] as $property ) {
							$output .= thb_css_property( $property, $mod, $setting, $rule );
						}
					$output .= '} ';
				}

				/**
				 * Mixins
				 */
				foreach ( $setting->getMixins() as $mixin ) {
					if ( ! is_callable( $mixin['mixin'] ) ) {
						continue;
					}

					$output .= $mixin['selector'] . ' { ';
						$output .= call_user_func( $mixin['mixin'], $mod );
					$output .= '} ';
				}

			}
		}

		return $output;
	}
}

if( ! function_exists( 'thb_customizer_get_imports' ) ) {
	/**
	 * Get the import code based on the customizer CSS output.
	 *
	 * @return string
	 */
	function thb_customizer_get_imports() {
		$imports = array();

		$thb_customizer = thb_theme()->getCustomizer();

		foreach ( $thb_customizer->getSections() as $section ) {
			foreach ( $section->getSettings() as $setting ) {
				$mod = get_theme_mod( $setting->getKey() );

				if ( empty( $mod ) ) {
					$mod = $setting->getDefault();
				}

				foreach ( $setting->getRules() as $rule ) {
					foreach ( $rule['properties'] as $property ) {
						$partial = thb_css_import( $property, $mod, $setting );

						if ( is_array( $partial ) ) {
							if ( ! isset( $imports[$partial['family']] ) ) {
								$imports[$partial['family']] = array();
							}

							$imports[$partial['family']][] = array(
								'variants' => $partial['variants'],
								'subsets' => $partial['subsets']
							);
						}
						else {
							$imports[] = $partial;
						}
					}
				}
			}
		}

		$imports_output = '';

		foreach ( $imports as $key => $import ) {
			if ( is_array( $import ) ) {
				$value = $key;

				$variants = array();
				$subsets = array();

				foreach ( $import as $i ) {
					$variants = array_merge( $i['variants'], $variants );
					$subsets = array_merge( $i['subsets'], $subsets );
				}

				if ( ! empty( $variants ) && $variants[0] != '' ) {
					$value .= ':' . implode( ',', array_unique( $variants ) );
				}

				if ( ! empty( $subsets ) && $subsets[0] != '' ) {
					$value .= '&subset=' . implode( ',', array_unique( $subsets ) );
				}

				$imports_output .= sprintf( '@import url(%s://fonts.googleapis.com/css?family=%s); ', thb_get_protocol(), $value );
			}
			else {
				$imports_output .= ' ' . $import;
			}
		}

		return $imports_output;
	}
}

if( ! function_exists( 'thb_customizer_imports' ) ) {
	/**
	 * Display CSS imports.
	 */
	function thb_customizer_imports() {
		$imports = thb_customizer_get_imports();

		if ( trim( $imports ) !== '' ) {
			thb_css_start( 'thb-customizer-imports' );
				echo $imports;
			thb_css_end();
		}
	}
}

if( ! function_exists( 'thb_customizer_output' ) ) {
	/**
	 * Displayt the customizer CSS output.
	 */
	function thb_customizer_output() {
		$output = thb_customizer_get_output();

		thb_css_start( 'thb-customizer' );
			echo $output;
		thb_css_end();
	}
}

if( ! function_exists('thb_css_start') ) {
	/**
	 * Open a style tag.
	 *
	 * @param string $id The style id tag.
	 */
	function thb_css_start( $id='' ) {
		$id = esc_attr( $id );

		echo '<style type="text/css"';
		echo !empty($id) ? ' id="' . $id . '">' : '>';
	}
}

if( ! function_exists('thb_css_end') ) {
	/**
	 * Close a style tag.
	 */
	function thb_css_end() {
		echo '</style>';
	}
}

if( ! function_exists( 'thb_css_import' ) ) {
	/**
	 * Get the import code for a CSS rule.
	 *
	 * @param string $property
	 * @param string $value
	 * @param THB_CustomizerSetting $setting
	 * @return string
	 */
	function thb_css_import( $property, $value, $setting ) {
		global $wp_customize;

		$key = $setting->getKey();

		if ( $property === 'font-family' ) {
			$font = thb_get_fonts( $value );

			if ( empty( $font ) ) {
				$font = thb_get_fonts( $setting->getDefault() );

				$family = str_replace( ' ', '+', $font['family'] );
			}
			else {
				$family = $value;
			}

			if ( $font['type'] === 'google' ) {
				$option = thb_get_option( 'customizer_' . $key );
				$variants = $option['variants'];
				$subsets = $option['subsets'];

				/**
				 * Variants
				 */
				$default_variants = $setting->getDefaultVariants();

				if ( ! isset( $wp_customize ) ) {
					// Frontend

					$variants_intersection = thb_array_explode( $variants );

					if ( empty( $variants ) ) {
						$variants_intersection = $default_variants;
					}
				}
				else {
					// Frontend customizer view
					$font_variants = thb_array_explode( $font['variants'] );
					$variants_intersection = array_intersect( $default_variants, $font_variants );

					if ( ! empty( $variants ) ) {
						$option_intersection = array_intersect( $variants_intersection, thb_array_explode( $variants ) );

						if ( ! empty( $option_intersection ) ) {
							$variants_intersection = $option_intersection;
						}
					}
				}

				/**
				 * Subsets
				 */
				$default_subsets = $setting->getDefaultSubsets();

				if ( ! isset( $wp_customize ) ) {
					// Frontend

					$subsets_intersection = thb_array_explode( $subsets );

					if ( empty( $subsets ) ) {
						$subsets_intersection = $default_subsets;
					}
				}
				else {
					// Frontend customizer view
					$font_subsets = thb_array_explode( $font['subsets'] );
					$subsets_intersection = array_intersect( $default_subsets, $font_subsets );

					if ( ! empty( $subsets ) ) {
						$option_intersection = array_intersect( $subsets_intersection, thb_array_explode( $subsets ) );

						if ( ! empty( $option_intersection ) ) {
							$subsets_intersection = $option_intersection;
						}
					}
				}

				return array(
					'family'   => $family,
					'variants' => $variants_intersection,
					'subsets'  => $subsets_intersection
				);
			}
			elseif ( $font['type'] === 'custom' ) {
				if ( ! $font['bundle'] ) {
					$upload_dir = wp_upload_dir();
					$custom_base_url = $upload_dir['baseurl'] . "/fonts/" . $font['folder'] . "/stylesheet.css";
				}
				else {
					$custom_base_url = $font['folder'];
				}

				return sprintf( '@import url(%s); ', $custom_base_url );
			}
		}

		return '';
	}
}

if( ! function_exists( 'thb_css_property' ) ) {
	/**
	 * Get the CSS rule display code.
	 *
	 * @param string $property
	 * @param string $value
	 * @param THB_CustomizerSetting $setting
	 * @param array $rule
	 * @return string
	 */
	function thb_css_property( $property, $value, $setting, $rule ) {
		$prefix = $suffix = '';

		$is_color_property = thb_text_contains( 'color', $property );

		// Modifiers
		foreach ( $rule['modifiers'] as $modifier => $modifier_value ) {

			// RGBA
			if ( $is_color_property && $modifier == 'rgba' ) {
				$prefix = 'rgba(';
				$value = implode( ',', thb_color_hexToRgb( $value ) );
				$suffix = ',' . $modifier_value . ')';
			}

		}

		switch ( $property ) {
			case 'font-family':
				$font = thb_get_fonts( $value );

				if ( empty( $font ) ) {
					$font = thb_get_fonts( $setting->getDefault() );

					if ( $font['type'] == 'typekit' ) {
						$value = $font['css'];
					}
					else {
						$value = str_replace( ' ', '+', $font['family'] );
					}

					if ( $setting->getDefault() == $value ) {
						return '';
					}
				}

				if ( $font['type'] == 'external' ) {
					return '';
				}

				if ( $font['type'] == 'typekit' ) {
					$value = $font['css'];
				}
				elseif ( $font['type'] !== 'custom' ) {
					$value = $font['family'];
				}

				$prefix = $suffix = '"';
				break;
			default:
				break;
		}

		$output = $property . ': ';
		$output .= $prefix;
		$output .= $value;
		$output .= $suffix;
		$output .= '; ';

		return $output;
	}
}