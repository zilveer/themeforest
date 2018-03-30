<?php

/**
	Validation Library :: Air Framework

	The contents of this file are subject to the terms of the GNU General
	Public License Version 2.0. You may not use this file except in
	compliance with the license. Any of the license terms and conditions
	can be waived if you get permission from the copyright holder.

	Copyright (c) 2012 WPBandit
	Jermaine Maree

		@package AirValidate
		@version 1.1
**/

// AirValidate
class AirValidate extends Air {

	protected static
		$error = FALSE;

	/**
		Initialize theme validation
			@public
	**/
	static function init_theme($input) {
		// Get section
		$section = esc_attr($input['section']);
		// Get current options
		$valid = self::$options;
		// Load section settings
		require ( AIR_THEME . '/config/settings-'.$section.'.php' );
		// Add settings fields
		AirSettings::add_fields($fields);
		// Validate theme options
		if ( !isset($input['reset']) ) {
			$valid = self::validate($input,$valid);
		}
		// Reset theme options
		if ( isset($input['reset']) ) {
			$valid = self::reset($valid);
		}
		// Process validation actions
		do_action('air_validate_theme_options',$section,$valid);
		// Return validated options
		return $valid;
	}

	/**
		Initialize module validation
			@public
	**/
	static function init_module($input) {
		// If no input, return
		if (!$input)
			return;
		
		// Get module
		$module = esc_attr($input['module']);
		// Get current options
		$valid = get_option('air-'.$module);
		// Load module settings
		require ( AIR_MODULES . '/' . $module . '/' . $module.'-settings.php' );
		// Add settings fields
		AirSettings::add_fields($fields);
		// Validate module options
		$valid = self::validate($input,$valid);
		// Return validated options
		return $valid;
	}

	/**
		Validate options
			@private
	**/
	private static function validate($input,$valid) {
		// Loop through fields
		foreach ( AirSettings::get_settings() as $field ) {

			// Switch to field type
			switch ( $field['type'] ) {
				
				// Validate category dropdown
				case 'category-dropdown':
					$valid[$field['id']] = esc_attr($input[$field['id']]);
					break;

				// Validate checkbox field
				case 'checkbox':
					foreach ($field['choices'] as $id=>$value ) {
						$valid[$id] = isset($input[$id])?'1':'0';
					}
					break;

				// Validate colorpicker field (text)
				case 'colorpicker':
					$valid[$field['id']] = esc_attr($input[$field['id']]);
					break;

				// Validate image field (text)
				case 'image':
					$valid[$field['id']] = esc_url($input[$field['id']]);
					break;

				// Validate radio field
				case 'radio':
					$valid[$field['id']] = esc_attr($input[$field['id']]);
					break;

				// Validate select field
				case 'select':
					$valid[$field['id']] = esc_attr($input[$field['id']]);
					break;

				// Validate text field
				case 'text':
					$valid[$field['id']] = $input[$field['id']];
					break;

				// Validate textarea field
				case 'textarea':
					$valid[$field['id']] = $input[$field['id']];
					break;

				// Validate URL field (text)
				case 'url':
					$valid[$field['id']] = esc_url($input[$field['id']]);
					break;

			} // end switch

		} // end foreach

		// Return validated options
		return $valid;
	}

	/**
		Reset options
			@private
	**/
	private static function reset($valid) {
		// Loop through fields
		foreach ( AirSettings::get_settings() as $field ) {
			// Set default values for non-checkbox fields
			if ( !in_array($field['type'], array('category-dropdown','checkbox','radio')) ) {
				if ( isset($field['default']) ) {
					$valid[$field['id']] = $field['default'];
				} else {
					$valid[$field['id']] = '';
				}
			}

			// Set default values for category dropdown fields
			if ( $field['type'] == 'category-dropdown' ) {
				$valid[$field['id']] = '0';
			}

			// Set default values for checkbox fields
			if ( $field['type'] == 'checkbox' ) {
				foreach ( $field['choices'] as $key=>$value ) {
					if ( isset($field['default'][$key]) ) {
						$valid[$key] = $field['default'][$key];
					} else {
						$valid[$key] = '0';
					}
				}
			}

			// Set default values for radio fields
			if ( $field['type'] == 'radio' ) {
				$array_key = key($field['choices']);
				foreach ( $field['choices'] as $key=>$value ) {
					if ( isset($field['default']) ) {
						$valid[$field['id']] = $field['default'];
					} else {
						$valid[$field['id']] = (string)$array_key;
					}
				}
			}
		}
		// Return reset + validated options
		return $valid;
	}

}
