<?php

/**
	Settings Library :: Air Framework
	Manages framework settings via Settings API

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Maree

		@package AirSettings
		@version 1.1
**/

// AirSettings
class AirSettings {

	//@{ Global variables
	protected static
		// Option name
		$option_name,
		// Options
		$options,
		// Sections,
		$sections,
		// Settings
		$settings;
	//@}

	/**
		Set option name
			@public
	**/
	static function set_option_name($name) {
		self::$option_name = $name;
		self::$options = get_option(self::$option_name);
	}

	/**
		Get option
			@private
	**/
	private static function get_option($key, $default=FALSE) {
		$value = isset(self::$options[$key])?self::$options[$key]:$default;
		return $value;
	}

	/**
		Get settings
			@public
	**/
	static function get_settings() {
		return self::$settings;
	}

	/**
		Add sections
			@public
	**/
	static function add_sections($sections, $page) {
		// Prefix $page
		$page = 'air-'.$page;

		// Defaults
		$defaults = array(
			'title'		=> 'Default Title',
			'desc'		=>	'',
			'callback'	=> __CLASS__.'::print_section_desc'
		);

		// Loop through sections
		foreach ( $sections as $section ) {

			// Merge arguments with defaults
			extract(wp_parse_args($section, $defaults));

			// Add section
			add_settings_section($id, $title, $callback, $page);

			// Store section
			self::$sections[$id] = array(
				'desc'	=> $desc,
				'page'	=> $page
			);

		} // end foreach loop
	}

	/**
		Print section description
			@public
	**/
	static function print_section_desc($args) {
		extract($args);
		if ( self::$sections[$id]['desc'] ) {
			echo '<p>'.self::$sections[$id]['desc'].'</p>';
		}
	}

	/**
		Fields
			@public
	**/
	static function add_fields($fields) {
		// Store fields
		self::$settings = $fields;

		// Defaults
		$defaults = array(
			'std'			=> '',
			'class'			=> '',
			'choices'		=> array(),
			'callback'		=> __CLASS__.'::print_field',
			'vertical'		=> TRUE,
			'placeholder'	=> '',
			'rows'			=> '8',
			'cols'			=> '50'
		);
		
		// Loop through fields
		foreach ( $fields as $field ) {

			// Merge arguments with defaults
			extract(wp_parse_args($field, $defaults));
			
			// Set arguments
			$args = array(
				'id'		=> $id,
				'name'		=> self::$option_name.'['.$id.']',
				'std'		=> $std,
				'type'		=> $type,
				'class'		=> $class,
				'choices'	=> $choices,
				'vertical'	=> $vertical
			);

			// Add placeholder attribute
			if ( in_array($type, array('colorpicker', 'text', 'url')) ) {
				$args['placeholder'] = $placeholder;
			}

			// Add rows and cols atrributes
			if('textarea' === $type) {
				$args['rows'] = $rows;
				$args['cols'] = $cols;
			}

			# Set tab
			$page = self::$sections[$section]['page'];
			
			# Add field
			add_settings_field($id,$label,$callback,$page,$section,$args);

		} // end foreach loop
	}

	/**
		Print field
			@public
	**/
	static function print_field($args) {
		// Get field type
		$type = $args['type'];
		unset($args['type']);
		
		// Create field
		switch ($type) {
			// Category dropdown
			case 'category-dropdown':
				$output = self::field_category_dropdown($args);
				break;
			// Checkbox
			case 'checkbox':
				$output = self::field_checkbox($args);
				break;
			// Color
			case 'colorpicker':
				$output = self::field_colorpicker($args);
				break;
			// Image
			case 'image':
				$output = self::field_image($args);
				break;
			case 'radio':
				$output = self::field_radio($args);
				break;
			// Select
			case 'select':
				$output = self::field_select($args);
				break;
			// Text
			case 'text':
				$output = self::field_text($args);
				break;
			// Textarea
			case 'textarea':
				$output = self::field_textarea($args);
				break;
			// URL
			case 'url':
				$output = self::field_text($args);
				break;
		}

		// Print field
		echo $output;
	}

	/**
		Category dropdown field
			@private
	**/
	private static function field_category_dropdown($args) {
		extract($args);
		// Get value
		$value = self::get_option($id)?self::get_option($id):$std;
		
		// Set arguments
		$args = array(
			'show_option_all'	=> 'All',
			'id'				=> 'air-'.$id,
			'name'				=> $name,
			'selected'			=> $value,
			'echo'				=> 0,
			'hide_if_empty'		=> TRUE
		);
		
		// Create dropdown
		$field = wp_dropdown_categories( $args );
		
		// Return field
		return $field;
	}

	/**
		Checkbox field
			@private
	**/
	private static function field_checkbox($args) {
		extract($args);
		$field = '';
		foreach($choices as $key=>$label) {
			// Get value
			$value = self::get_option($key)?self::get_option($key):$std;
			// Set attributes
			$attrs = array(
				'id'	=> 'air_'.$key,
				'name'	=> self::$option_name.'['.$key.']',
				'class'	=> $class
			);
			// Create checkbox field
			$field .= AirForm::checkbox($attrs,$value);
			$field .= ' <label for="'.$attrs['name'].'">'.$label.'</label><br />';
		}
		// Return field
		return $field;
	}

	/**
		Colorpicker field
			@private
	**/
	private static function field_colorpicker($args) {
		extract($args);
		// Get value
		$value = self::get_option($id)?self::get_option($id):$std;
		// Colorpicker color
		$bg = $value?$value:($placeholder?$placeholder:'ccc');
		// Colorpicker div
		$field = '<div class="air-colorpicker"><div style="background-color:#'.$bg.';"></div></div>';
		// Set attributes
		$attrs = array(
			'id'			=> 'air_'.$id,
			'name'			=> $name,
			'class'			=> 'small-text',
			'maxlength'		=> '6',
			'placeholder'	=> $placeholder?$placeholder:''
		);
		// Create text field
		$field .= AirForm::text($attrs,$value);
		// Return field
		return $field;
	}

	/**
		Image field
			@private
	**/
	private static function field_image($args) {
		extract($args);
		// Get value
		$value = self::get_option($id)?self::get_option($id):$std;
		// Set text attributes
		$attrs = array(
			'id'	=> 'air_'.$id,
			'name'	=> $name,
			'class'	=> $class?$class:'regular-text'
		);
		// Create text field
		$field = AirForm::text($attrs,$value);
		// Set button attributes
		$attrs2 = array(
			'id'	=> $id.'_button',
			'class'	=> 'button-secondary air-image-button',
			'value' => __('Select Image','air')
		);
		// Create button
		$field .= AirForm::button($attrs2);
		$field .= '<div class="air-image-placeholder"></div>';
		// Return field
		return $field;
	}

	/**
		Radio field
			@private
	**/
	private static function field_radio($args) {
		extract($args);
		$field = '';

		// Get selected value
		$selected = self::get_option($id);

		if ( !$selected && ($selected !== '0') )
			$selected = $std;

		// Set default
		if ( !$selected ) $selected = key($choices);

		foreach($choices as $key=>$label) {
			// Set attributes
			$attrs = array(
				'name'	=> self::$option_name.'['.$id.']',
				'class'	=> $class
			);

			// Create radio field
			$field .= AirForm::radio($attrs,$key,$selected);

			// Add valign class if vertical
			if(!$vertical) {
				$field .= ' <label class="air-halign-radio">'.$label.'</label>';
			} else {
				$field .= ' <label>'.$label.'</label><br>';
			}
		}

		// Return field
		return $field;
	}

	/**
		Select field
			@private
	**/
	private static function field_select($args) {
		extract($args);
		// Get value
		$value = self::get_option($id)?self::get_option($id):$std;

		// Set attributes
		$attrs = array(
			'id'	=> 'air_'.$id,
			'name'	=> $name,
			'class'	=> $class
		);

		// Create select field
		$field = AirForm::select($attrs,$value,$choices);

		// Return field
		return $field;
	}

	/**
		Text field
			@private
	**/
	private static function field_text($args) {
		extract($args);
		// Get value
		$value = self::get_option($id)?self::get_option($id):$std;
		// Set attributes
		$attrs = array(
			'id'			=> 'air_'.$id,
			'name'			=> $name,
			'class'			=> $class?$class:'regular-text',
			'placeholder'	=> $placeholder?$placeholder:''
		);
		// Create text field
		$field = AirForm::text($attrs,$value);
		// Return field
		return $field;
	}

	/**
		Textarea field
			@private
	**/
	private static function field_textarea($args) {
		extract($args);
		// Get value
		$value = self::get_option($id)?self::get_option($id):$std;
		// Set attributes
		$attrs = array(
			'id'	=> 'air_'.$id,
			'name'	=> $name,
			'class'	=> $class?$class:'large-text',
			'cols'	=> $cols,
			'rows'	=> $rows,
		);
		// Create textarea field
		$field = '<p>'.AirForm::textarea($attrs,$value).'</p>';
		// Return field
		return $field;
	}

	/**
		Set default options
			@public
	**/
	static function set_default_options() {
		// Set theme name and version
		$defaults = array(
			'theme-name' 	=> Air::get('theme-name'),
			'theme-version' => Air::get('theme-version')
		);
		// Set empty fields array
		$fields = array();
		// Loop through options menu
		foreach ( Air::get_options_menu() as $key=>$value ) {
			// Define settings file
			$file = AIR_THEME . '/config/' . 'settings-'.$key.'.php';
			// Load settings file
			if ( is_file($file) ) { require ( $file  ); }
		}
		// Loop through fields
		foreach ( $fields as $field ) {
			// Set default values for each field
			if ( isset($field['default']) ) {
				if ( $field['type'] != 'checkbox' ) {
					$defaults[$field['id']] = $field['default'];
				} else {
					foreach ( $field['default'] as $key=>$value ) {
						$defaults[$key] = $value;
					}
				}
			}
		}
		// Save default options to database
		update_option(Air::get('theme-options'),$defaults);
	}
}
