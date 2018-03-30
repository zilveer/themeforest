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
 * Copyright 2012, Andrea Gandino & Simone Maranzana
 *
 * Licensed under The MIT License
 * Redistribuitions of files must retain the above copyright notice.
 *
 * @package Helpers
 * @author The Happy Bit <thehappybit@gmail.com>
 * @copyright Copyright 2012, Andrea Gandino & Simone Maranzana
 * @link http://
 * @since The Happy Framework v 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

/**
 * Open a style tag.
 *
 * @param string $id The style id tag.
 * @return void
 */
if( !function_exists('thb_css_start') ) {
	function thb_css_start( $id='' ) {
		echo '<style type="text/css"';
		echo !empty($id) ? ' id="' . $id . '">' : '>';
	}
}

/**
 * Close a style tag.
 *
 * @return void
 */
if( !function_exists('thb_css_end') ) {
	function thb_css_end() {
		echo '</style>';
	}
}

/**
 * Echo a CSS selector.
 *
 * @param string $selector The CSS selector.
 * @param string $rules The CSS selector rules.
 * @return void
 */
if( !function_exists('thb_css_selector') ) {
	function thb_css_selector( $selector, $rules ) {
		echo thb_get_css_selector($selector, $rules);
	}
}

/**
 * Return a CSS selector.
 *
 * @param string $selector The CSS selector.
 * @param string $rules The CSS selector rules.
 * @return string
 */
if( !function_exists('thb_get_css_selector') ) {
	function thb_get_css_selector( $selector, $rules ) {
		$sel = '';

		if( !empty($rules) ) {
			$sel = $selector . ' { ';
			foreach( $rules as $rule ) {
				$sel .= $rule . ' ';
			}
			$sel .= ' } ';
		}

		return $sel;
	}
}

/**
 * Echo a CSS rule.
 *
 * @param string $rule The CSS rule.
 * @param string $value The CSS rule value.
 * @param string $prefix The CSS rule prefix.
 * @param string $suffix The CSS rule suffix.
 * @return void
 */
if( !function_exists('thb_css_rule') ) {
	function thb_css_rule( $rule, $value, $prefix='', $suffix='' ) {
		echo thb_get_css_rule($rule, $value, $prefix, $suffix);
	}
}

/**
 * Return a CSS rule.
 *
 * @param string $rule The CSS rule.
 * @param string $value The CSS rule value.
 * @param string $prefix The CSS rule prefix.
 * @param string $suffix The CSS rule suffix.
 * @return string
 */
if( !function_exists('thb_get_css_rule') ) {
	function thb_get_css_rule( $rule, $value, $prefix='', $suffix='' ) {
		if( $value !== '' ) {
			if( $rule == 'font-family' ) {
				$value = str_replace('+', ' ', $value);
			}
			elseif( $rule == 'text-variant' ) {
				$font_style = thb_text_contains('italic', $value) ? 'italic' : 'normal';
				$font_weight = str_replace('italic', '', $value);
				if( thb_text_contains('regular', $font_weight) || empty($font_weight) ) {
					$font_weight = 'normal';
				}

				return thb_get_css_rule('font-weight', $font_weight) . ' ' . thb_get_css_rule('font-style', $font_style);
			}

			return $rule . ': ' . $prefix . $value . $suffix . ';';
		}

		return '';
	}
}

/**
 * Render or return a CSS mixin.
 *
 * @param string $mixin The mixin name.
 * @param string $value The mixin value parameter.
 * @param string $selector The mixin selector.
 * @return mixed
 */
if( !function_exists('thb_mixin') ) {
	function thb_mixin( $mixin=null, $value=null, $selector=null ) {
		$post = !$mixin && !$value && !$selector && !empty($_POST);

		if( $post ) {
			$mixin = $_POST['mixin'];
			$value = $_POST['value'];
			$selector = $_POST['selector'];	
		}

		if( function_exists($mixin) ) {
			$css = call_user_func($mixin, $value, $selector);

			if( $post ) {
				echo $css;
				die();
			}
			else {
				return $css;
			}
		}
	}

	add_action('wp_ajax_nopriv_thb_mixin', 'thb_mixin');
	add_action('wp_ajax_thb_mixin', 'thb_mixin');
}

/**
 * Return the appropriate prefix and suffix for the CSS rule.
 *
 * @param string $rule The CSS rule.
 * @return string
 */
if( !function_exists('thb_css_prefix_suffix') ) {
	function thb_css_prefix_suffix( $rule ) {
		$prefix = '';
		$suffix = '';

		switch( $rule ) {
			case 'font-family':
				$prefix = $suffix = '"';
				break;
			case 'font-size':
				$suffix = 'px';
				break;
			case 'letter-spacing':
				$suffix = 'px';
				break;
			case 'background-image':
				$prefix = 'url(';
				$suffix = ')';
				break;
		}

		return array($prefix, $suffix);
	}
}

if( ! function_exists('thb_css_get_column_class_name') ) {
	function thb_css_get_column_class_name( $size=1, $module=1 ) {
		if( $size == $module ) {
			return "full";
		}

		$html_class = '';

		switch( (int) $size ) {
			case 1:
				$html_class .= "one";
				break;
			case 2:
				$html_class .= "two";
				break;
			case 3:
				$html_class .= "three";
				break;
			case 4:
				$html_class .= "three";
				break;
		}

		$html_class .= "-";

		switch( (int) $module ) {
			case 2:
				$html_class .= "half";
				break;
			case 3:
				$html_class .= "third";
				break;
			case 4:
				$html_class .= "fourth";
				break;
		}

		if( (int) $size > 1 ) {
			$html_class .= "s";
		}

		return $html_class;
	}
}