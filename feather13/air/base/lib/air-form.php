<?php

/**
	Form Library :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Marée

		@package AirForm
		@version 1.2
**/

// Creates form fields
class AirForm {

	/**
		Button
			@return string
			@param $atts array
			@public
	**/
	static function button(array $atts) {
		// Default attributes
		$defaults = array(
			'type'	=> 'button',
			'value'	=> __('Save Changes','air')
		);

		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);

		// Create field
		return '<input'.air_attrs($atts).'/>';
	}

	/**
		Checkbox
			@return string
			@param $atts array
			@param $value string
			@param $std string
			@public
	**/
	static function checkbox(array $atts,$value,$std='1') {
		// Default attributes
		$defaults = array(
			'name'	=> '',
			'type'	=> 'checkbox',
			'value'	=> $std
		);
		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);
		// Checked ?
		if ( $std==$value ) { $atts['checked'] = 'checked'; }
		// Create field
		$field = '<input'.air_attrs($atts).'/>';
		return $field;
	}

	/**
		Radio
			@return string
			@param $atts array
			@param $value string
			@param $selected string
			@public
	**/
	static function radio(array $atts,$value,$selected) {
		// Default attributes
		$defaults = array(
			'name'	=> '',
			'type'	=> 'radio',
			'value'	=> $value
		);
		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);

		// Checked ?
		if ( (string)$selected === (string)$value ) { $atts['checked'] = 'checked'; }
		// Create field
		$field = '<input' . air_attrs($atts) . '/>';
		return $field;
	}

	/**
		Select
			@return string
			@param $atts array
			@param $value string
			@param $options array
			@public
	**/
	static function select(array $atts,$value,array $options) {
		// Default attributes
		$defaults = array('name'=>'');
		// Parse args
		$atts = wp_parse_args($atts,$defaults);
		// Create field
		$field = '<select' . air_attrs($atts) . '>';
		// Build options
		foreach ( $options as $ovalue=>$oname ) {
			// Option attributes
			$oattrs = array('value'=>$ovalue);
			if ( $value==$ovalue ) { $oattrs['selected'] = 'selected'; }
			// Option
			$field .= '<option' . air_attrs($oattrs) . '>' . $oname . '</option>';
			// Reset $oattrs
			unset($oattrs);
		}
		$field .= '</select>';
		return $field;
	}

	/**
		Text
			@return string
			@param $atts array
			@param $value string
			@public
	**/
	static function text(array $atts,$value='') {
		// Default attributes
		$defaults = array(
			'name'	=> '',
			'type'	=> 'text',
			'value'	=> $value
		);
		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);
		// Create field
		$field = '<input' . air_attrs($atts) . '/>';
		return $field;
	}

	/**
		Textarea
			@return string
			@param $atts array
			@param $value string
			@public
	**/
	static function textarea(array $atts,$value='') {
		// Default attributes
		$defaults = array('name'=>'');
		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);
		// Create field
		$field = '<textarea' . air_attrs($atts) . '>' . $value . '</textarea>';
		return $field;
	}




	/*-----------------------------------------------------------------------*/
	/* WIDGET FIELDS
	/*-----------------------------------------------------------------------*/


	/**
		Category dropdown field
			@return string
			@param $args array
			@private
	**/
	static function widget_category_dropdown(array $atts,$value='',$label) {
		// Default attributes
		$defaults = array(
			'id'	=> '',
			'name'	=> ''
		);

		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);

		// Set arguments
		$args = array(
			'show_option_all'	=> 'All',
			'name'				=> $atts['name'],
			'class'				=> 'widefat',
			'selected'			=> $value,
			'echo'				=> 0,
			'hide_if_empty'		=> TRUE
		);
		
		// Build field
		$field  = '<p><label for="'.$atts['id'].'">'.$label.'</label>';
		$field .= wp_dropdown_categories($args).'</p>';
		
		// Return field
		return $field;
	}

	/**
		Widget checkbox field
			@return string
			@public
	**/
	static function widget_checkbox(array $atts,$value='',$label,$before='<p>',$after='</p>') {
		// Default attributes
		$defaults = array(
			'id'	=> '',
			'type'	=> 'checkbox',
			'class'	=> 'checkbox'
		);

		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);

		// Build text field
		$field  = $before.self::checkbox($atts,$value);
		$field .= ' <label for="'.$atts['id'].'">'.$label.'</label>'.$after;
		
		// Return field
		return $field;
	}

	/**
		Widget select field
			@public
	**/
	static function widget_select(array $atts,$value='',$opts,$label,$before='<p>',$after='</p>') {
		// Default attributes
		$defaults = array(
			'id'	=> '',
			'class'	=> 'widefat',
		);

		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);

		// Build dropdown
		$field  = $before.'<label for="'.$atts['id'].'">'.$label.'</label>';
		$field .= self::select($atts,$value,$opts).$after;

		// Return field
		return $field;
	}

	/**
		Widget text field
			@return string
			@param $atts array
			@param $value string
			@param $label string
			@public
	**/
	static function widget_text(array $atts,$value='',$label,$before='<p>',$after='</p>') {
		// Default attributes
		$defaults = array(
			'id'	=> '',
			'type'	=> 'text',
			'class'	=> 'widefat',
			'value' => $value
		);

		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);
		
		// Build text field
		$field  = $before.'<label for="'.$atts['id'].'">'.$label.'</label>';
		$field .= self::text($atts).$after;
		
		// Return field
		return $field;
	}

	/**
		Widget textarea field
			@return string
			@param $atts array
			@param $value string
			@param $label string
			@public
	**/
	static function widget_textarea( array $atts,$value='',$label,$before='<p>',$after='</p>') {
		// Default attributes
		$defaults = array('name'=>'');

		// Parse $atts and merge with $defaults
		$atts = wp_parse_args($atts,$defaults);
		
		// Create field
		$field  = $before.'<label for="'.$atts['id'].'">'.$label.'</label>';
		$field .= self::textarea($atts,$value).$after;

		// Return field
		return $field;
	}

}
