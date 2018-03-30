<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * HTML helpers.
 *
 * This file contains HTML-related utility functions.
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
 * Display a link tag.
 *
 * @param string $rel The link rel attribute.
 * @param string $href The link href attribute.
 * @param string $type The link type attribute.
 * @param array $attributes The link attributes.
 * @param string $title The link title attribute.
 * @return void
 */
if( !function_exists('thb_link') ) {
	function thb_link( $rel, $href, $type=null, $attributes=array(), $title=null ) {
		$link = '';

		if( !empty($rel) && !empty($href) ) {
			$link .= "<link rel=\"$rel\" href=\"$href\"";
		}

		if( !empty($type) ) {
			$link .= " type=\"$type\"";
		}

		foreach( $attributes as $k => $v ) {
			if( !empty($v) ) {
				$link .= " $k=\"$v\"";
			}
		}

		if( !empty($title) ) {
			$link .= " title=\"$title\"";
		}

		$link .= " />\n";

		echo $link;
	}
}

/**
 * Display a checkbox control.
 *
 * @param string $name The name of the control.
 * @param boolean $checked True if the checkbox control needs to be checked.
 * @return void
 */
if( !function_exists('thb_input_checkbox') ) {
	function thb_input_checkbox( $name, $checked=false ) {
		$checked_attribute = $checked ? 'checked="checked"' : '';

		echo "<input type=\"hidden\" name=\"$name\" value=\"0\">
		<input type=\"checkbox\" name=\"$name\" value=\"1\" $checked_attribute>";
	}
}

/**
 * Display a meta tag.
 *
 * @param string $name The meta name.
 * @param string $content The meta content.
 * @return void
 */
if( !function_exists('thb_meta') ) {
	function thb_meta( $name, $content ) {
		if( !empty($name) && !empty($content) ) {
			echo "<meta name=\"$name\" content=\"$content\" />\n";
		}
	}
}

/**
 * Display a script.
 *
 * @param string $url The script URL.
 * @return void
 */
if( !function_exists('thb_script') ) {
	function thb_script( $url ) {
		global $wp_version;

		$sep = '?';
		if( strpos($url, '?') !== false ) {
			$sep = '&';
		}

		echo '<script type="text/javascript" src="' . $url . $sep . 'ver=' . $wp_version . '"></script>';
	}
}

/**
 * Display a stylesheet.
 *
 * @param string $url The stylesheet URL.
 * @param string $media The stylesheet media.
 * @return void
 */
if( !function_exists('thb_stylesheet') ) {
	function thb_stylesheet( $url, $media='all' ) {
		thb_link( 'stylesheet', $url, 'text/css', array('media' => $media) );
	}
}

/**
 * Concat a list of HTML attributes.
 *
 * @param array $atts The element attributes.
 * @param string $prefix Optional array key prefix.
 * @return void
 */
if( !function_exists('thb_get_attributes') ) {
	function thb_get_attributes( $atts=array(), $prefix='' ) {
		$attributes = '';
		foreach( $atts as $key => $value ) {
			$attributes .= ' ' . $prefix . $key . '="' . $value . '"';
		}
		return $attributes;
	}
}

/**
 * Concat and echo a list of HTML attributes.
 *
 * @param array $atts The element attributes.
 * @param string $prefix Optional array key prefix.
 * @return void
 */
if( !function_exists('thb_attributes') ) {
	function thb_attributes( $atts=array(), $prefix='' ) {
		echo thb_get_attributes($atts, $prefix);
	}
}

/**
 * Concat a list of HTML5 data attributes.
 *
 * @param array $atts The element attributes.
 * @return void
 */
if( !function_exists('thb_get_data_attributes') ) {
	function thb_get_data_attributes( $atts=array() ) {
		return thb_get_attributes($atts, 'data-');
	}
}

/**
 * Concat and echo a list of HTML5 data attributes.
 *
 * @param array $atts The element attributes.
 * @return void
 */
if( !function_exists('thb_data_attributes') ) {
	function thb_data_attributes( $atts=array() ) {
		echo thb_get_data_attributes($atts, 'data-');
	}
}

/**
 * Concat a list of parameters for a querystring.
 *
 * @param array $pars The querystring parameters.
 * @return void
 */
if( !function_exists('thb_get_querystring') ) {
	function thb_get_querystring( $pars=array() ) {
		$querystring = '';

		$i=0;
		foreach( $pars as $key => $value ) {
			if( $i>0 ) {
				$querystring .= '&amp;';
			}

			$querystring .= $key . '=' . $value;

			$i++;
		}

		return $querystring;
	}
}

/**
 * Concat and echo a list of parameters for a querystring.
 *
 * @param array $pars The querystring parameters.
 * @return void
 */
if( !function_exists('thb_querystring') ) {
	function thb_querystring( $pars=array() ) {
		echo thb_get_attributes($pars);
	}
}