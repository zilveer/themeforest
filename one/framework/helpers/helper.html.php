<?php if( !defined('THB_FRAMEWORK_NAME') ) exit('No direct script access allowed.');

/**
 * HTML helpers.
 *
 * This file contains HTML-related utility functions.
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

if( ! function_exists( 'thb_input_label' ) ) {
	/**
	 * Output a label element.
	 *
	 * @param string $for
	 * @param string $label
	 * @param array $classes
	 * @param string $help
	 */
	function thb_input_label( $for, $label, $classes = array(), $help = '' ) {
		$classes = (array) $classes;

		echo '<div class="thb-label-help-wrapper">';
			echo '<p class="thb-field-label">';
				printf( '<label for="%s" class="%s">%s</label>', $for, implode( ' ', $classes ), $label );
			echo '</p>';

			if ( ! empty( $help ) ) {
				echo '<p class="thb-field-help">';
					echo $help;
				echo '</p>';
			}
		echo '</div>';
	}
}

if( ! function_exists( 'thb_input_text' ) ) {
	/**
	 * Output a text input element.
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $value
	 * @param array $attrs
	 */
	function thb_input_text( $name, $label, $value, $attrs = array() ) {
		$name = esc_attr( $name );
		$attrs = wp_parse_args( $attrs, array(
			'type'        => 'text',
			'name'        => $name,
			'class'       => '',
			'placeholder' => '',
			'value'       => $value,
			'help'        => ''
		) );

		echo '<div class="thb-field-row">';
			if ( $label != '' ) {
				thb_input_label( $name, $label, array(), $attrs['help'] );
			}

			echo '<div class="thb-field-content-wrapper">';
				printf( '<input %s>', thb_get_attributes( $attrs ) );
			echo '</div>';
		echo '</div>';
	}
}

if( ! function_exists( 'thb_input_textarea' ) ) {
	/**
	 * Output a textarea input element.
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $value
	 * @param array $attrs
	 */
	function thb_input_textarea( $name, $label, $value, $attrs = array() ) {
		$name = esc_attr( $name );
		$attrs = wp_parse_args( $attrs, array(
			'name'        => $name,
			'class'       => '',
			'placeholder' => '',
			'help'        => ''
		) );

		echo '<div class="thb-field-row">';
			if ( $label != '' ) {
				thb_input_label( $name, $label, array(), $attrs['help'] );
			}

			echo '<div class="thb-field-content-wrapper">';
				printf( '<textarea %s>%s</textarea>', thb_get_attributes( $attrs ), $value );
			echo '</div>';
		echo '</div>';
	}
}

if( ! function_exists( 'thb_input_select' ) ) {
	/**
	 * Display a select control.
	 *
	 * @param string $name The name of the control.
	 * @param array $options The select options.
	 * @param string $value
	 * @param array $attrs The select attributes.
	 */
	function thb_input_select( $name, $options = array(), $value = '', $attrs = array() ) {
		$name = esc_attr( $name );
		$has_optgroups = thb_array_depth( $options ) > 1;
		$value = (array) $value;

		printf( '<select name="%s"%s>', $name, thb_get_attributes($attrs) );
			if ( $has_optgroups ) {
				foreach ( $options as $optgroup => $opts ) {
					printf( '<optgroup label="%s">', $optgroup );
						foreach ( $opts as $v => $l ) {
							$v = esc_attr( $v );
							$l = esc_html( $l );

							$selected = in_array( $v, $value ) ? ' selected="selected"' : '';

							printf( '<option value="%s"%s>%s</option>', $v, $selected, $l );
						}
					echo '</optgroup>';
				}
			}
			else {
				foreach ( $options as $v => $l ) {
					$v = esc_attr( $v );
					$l = esc_html( $l );

					$selected = in_array( $v, $value ) ? ' selected="selected"' : '';

					printf( '<option value="%s"%s>%s</option>', $v, $selected, $l );
				}
			}
		echo '</select>';
	}
}

if( ! function_exists( 'thb_input_selectize' ) ) {
	/**
	 * Display a selectize control.
	 *
	 * @param string $name The name of the control.
	 * @param array $options The select options.
	 * @param string $value
	 * @param array $attrs The select attributes.
	 */
	function thb_input_selectize( $name, $options = array(), $value = '', $attrs = array() ) {
		$attrs = wp_parse_args( $attrs, array(
			'multiple'    => 'multiple',
			'data-target' => "[name='$name']",
			'class'       => 'thb-selectize'
		) );

		$exploded_value = explode( ',', $value );

		thb_input_select( '', $options, $exploded_value, $attrs );
		printf( '<input type="hidden" name="%s" value="%s">', $name, $value );
	}
}

if( ! function_exists('thb_normalize_label_id') ) {
	/**
	 * Normalize the for/id attributes for labels and input fields.
	 *
	 * @param  string $name
	 * @return string
	 */
	function thb_normalize_label_id( $name = '' ) {
		$id = str_replace('[', '', $name);
		$id = str_replace(']', '', $id);

		return $id;
	}
}

if( ! function_exists( 'thb_input_checkbox' ) ) {
	/**
	 * Display a checkbox control.
	 *
	 * @param string $name The name of the control.
	 * @param string $value "0" or "1".
	 * @param string $label The text of the label.
	 */
	function thb_input_checkbox( $name, $value = '0', $label = false ) {
		$name = esc_attr( $name );
		$id = thb_normalize_label_id( $name );
		$id = $name;

		$checked = ! empty( $value );
		$checked_attribute = esc_attr( $checked ? 'checked="checked"' : '' );

		$classes = array();
		$classes[] = 'thb-checkbox-field-label';
		$classes[] = $checked ? 'checked' : '';

		// echo "<input type=\"hidden\" name=\"$name\" value=\"0\">
		echo "<input class=\"thb-checkbox\" type=\"hidden\" id=\"$id\" name=\"$name\" value=\"$value\" $checked_attribute>";

		if ( $label === false ) {
			$classes[] = 'thb-label-hidden';
		}

		printf( '<label for="%s" class="%s">%s</label>', $id, implode(' ', $classes), $label );
	}
}

if( ! function_exists( 'thb_meta' ) ) {
	/**
	 * Display a meta tag.
	 *
	 * @param string $name The meta name.
	 * @param string $content The meta content.
	 */
	function thb_meta( $name, $content ) {
		if( !empty($name) && !empty($content) ) {
			$name = esc_attr( $name );
			$content = esc_attr( $content );

			echo "<meta name=\"$name\" content=\"$content\" />\n";
		}
	}
}

if( ! function_exists( 'thb_get_attributes' ) ) {
	/**
	 * Concat a list of HTML attributes.
	 *
	 * @param array $atts The element attributes.
	 * @param string $prefix Optional array key prefix.
	 */
	function thb_get_attributes( $atts = array(), $prefix = '' ) {
		$attributes = '';
		foreach( $atts as $key => $value ) {
			$attributes .= ' ' . $prefix . $key . '="' . esc_attr( $value ) . '"';
		}
		return $attributes;
	}
}

if( ! function_exists( 'thb_attributes' ) ) {
	/**
	 * Concat and echo a list of HTML attributes.
	 *
	 * @param array $atts The element attributes.
	 * @param string $prefix Optional array key prefix.
	 */
	function thb_attributes( $atts = array(), $prefix = '' ) {
		echo thb_get_attributes($atts, $prefix);
	}
}

if( ! function_exists( 'thb_get_data_attributes' ) ) {
	/**
	 * Concat a list of HTML5 data attributes.
	 *
	 * @param array $atts The element attributes.
	 */
	function thb_get_data_attributes( $atts = array() ) {
		return thb_get_attributes($atts, 'data-');
	}
}

if( ! function_exists( 'thb_data_attributes' ) ) {
	/**
	 * Concat and echo a list of HTML5 data attributes.
	 *
	 * @param array $atts The element attributes.
	 */
	function thb_data_attributes( $atts = array() ) {
		echo thb_get_data_attributes($atts, 'data-');
	}
}

if ( ! function_exists( 'thb_classes' ) ) {
	/**
	 * Concatenate a series of CSS classes to be put in a "class" element attribute.
	 *
	 * @param array $classes An array of class names.
	 * @return string
	 */
	function thb_get_classes( $classes = array() ) {
		return esc_attr( implode( ' ', $classes ) );
	}
}

if ( ! function_exists( 'thb_classes' ) ) {
	/**
	 * Print a series of CSS classes to be put in a "class" element attribute.
	 *
	 * @param array $classes An array of class names.
	 */
	function thb_classes( $classes = array() ) {
		echo thb_get_classes( $classes );
	}
}

if( !function_exists('thb_link') ) {
	/**
	 * Display a link tag.
	 *
	 * @param string $rel The link rel attribute.
	 * @param string $href The link href attribute.
	 * @param string $type The link type attribute.
	 * @param array $attributes The link attributes.
	 * @param string $title The link title attribute.
	 */
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

if( ! function_exists( 'thb_input_icon' ) ) {
	/**
	 * Output an icon input element.
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $value
	 * @param array $attrs
	 */
	function thb_input_icon( $name, $label, $value, $attrs = array() ) {
		$attrs = wp_parse_args( $attrs, array( 'class' => 'thb-iconpicker' ) );

		thb_input_text( $name, $label, $value, $attrs );
	}
}

if( ! function_exists( 'thb_input_color' ) ) {
	/**
	 * Output an color input element.
	 *
	 * @param string $name
	 * @param string $label
	 * @param string $value
	 * @param array $attrs
	 */
	function thb_input_color( $name, $label, $value, $attrs = array() ) {
		$attrs = wp_parse_args( $attrs, array( 'class' => 'thb-colorpicker' ) );

		thb_input_text( $name, $label, $value, $attrs );
	}
}