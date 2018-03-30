<?php

class SG_Form {

	public static function open($action = NULL, array $attributes = NULL)
	{
		if ($action === NULL) {
			// Use the current URI
			$action = '';
		}

		if ($action === '') {
			// Use only the base URI
			$action = '/';
		} elseif (strpos($action, '://') === FALSE) {
			// Make the URI absolute
			$action = SG_URL::site($action);
		}

		// Add the form action to the attributes
		$attributes['action'] = $action;

		// Only accept the default character set
		$attributes['accept-charset'] = get_bloginfo('charset', 'display');

		if (!isset($attributes['method'])) {
			// Use POST method
			$attributes['method'] = 'post';
		}

		return '<form' . SG_HTML::attributes($attributes) . '>';
	}

	public static function close()
	{
		return '</form>';
	}

	public static function input($name, $value = NULL, array $attributes = NULL)
	{
		// Set the input name
		$attributes['name'] = $name;

		// Set the input value
		$attributes['value'] = $value;

		if (!isset($attributes['type'])) {
			// Default type is text
			$attributes['type'] = 'text';
		}

		return '<input' . SG_HTML::attributes($attributes) . ' />';
	}

	public static function hidden($name, $value = NULL, array $attributes = NULL)
	{
		$attributes['type'] = 'hidden';

		return SG_Form::input($name, $value, $attributes);
	}

	public static function password($name, $value = NULL, array $attributes = NULL)
	{
		$attributes['type'] = 'password';

		return SG_Form::input($name, $value, $attributes);
	}

	public static function file($name, array $attributes = NULL)
	{
		$attributes['type'] = 'file';

		return SG_Form::input($name, NULL, $attributes);
	}

	public static function checkbox($name, $value = NULL, $checked = FALSE, array $attributes = NULL)
	{
		$attributes['type'] = 'checkbox';

		if ($checked === TRUE) {
			// Make the checkbox active
			$attributes['checked'] = 'checked';
		}

		return SG_Form::input($name, $value, $attributes);
	}

	public static function radio($name, $value = NULL, $checked = FALSE, array $attributes = NULL)
	{
		$attributes['type'] = 'radio';

		if ($checked === TRUE) {
			// Make the radio active
			$attributes['checked'] = 'checked';
		}

		return SG_Form::input($name, $value, $attributes);
	}

	public static function textarea($name, $body = '', array $attributes = NULL, $double_encode = TRUE)
	{
		// Set the input name
		$attributes['name'] = $name;

		// Add default rows and cols attributes (required)
		$attributes += array('rows' => 10, 'cols' => 50);

		return '<textarea' . SG_HTML::attributes($attributes) . '>' . SG_HTML::chars($body, $double_encode) . '</textarea>';
	}

	public static function select($name, array $options = NULL, $selected = NULL, array $attributes = NULL)
	{
		// Set the input name
		$attributes['name'] = $name;

		if (is_array($selected)) {
			// This is a multi-select, god save us!
			$attributes['multiple'] = 'multiple';
		}

		if (!is_array($selected)) {
			if ($selected === NULL) {
				// Use an empty array
				$selected = array();
			} else {
				// Convert the selected options to an array
				$selected = array((string) $selected);
			}
		}

		if (empty($options)) {
			// There are no options
			$options = '';
		} else {
			foreach ($options as $value => $name) {
				if (is_array($name)) {
					// Create a new optgroup
					$group = array('label' => $value);

					// Create a new list of options
					$_options = array();

					foreach ($name as $_value => $_name) {
						// Force value to be string
						$_value = (string) $_value;

						// Create a new attribute set for this option
						$option = array('value' => $_value);

						if (in_array($_value, $selected)) {
							// This option is selected
							$option['selected'] = 'selected';
						}

						// Change the option to the HTML string
						$_options[] = '<option' . SG_HTML::attributes($option) . '>' . SG_HTML::chars($_name, FALSE) . '</option>';
					}

					// Compile the options into a string
					$_options = "\n" . implode("\n", $_options) . "\n";

					$options[$value] = '<optgroup' . SG_HTML::attributes($group) . '>' . $_options . '</optgroup>';
				} else {
					// Force value to be string
					$value = (string) $value;

					// Create a new attribute set for this option
					$option = array('value' => $value);

					if (in_array($value, $selected)) {
						// This option is selected
						$option['selected'] = 'selected';
					}

					// Change the option to the HTML string
					$options[$value] = '<option' . SG_HTML::attributes($option) . '>' . SG_HTML::chars($name, FALSE) . '</option>';
				}
			}

			// Compile the options into a single string
			$options = "\n" . implode("\n", $options) . "\n";
		}

		return '<select' . SG_HTML::attributes($attributes) . '>' . $options . '</select>';
	}

	public static function submit($name, $value, array $attributes = NULL)
	{
		$attributes['type'] = 'submit';

		return SG_Form::input($name, $value, $attributes);
	}

	public static function image($name, $value, array $attributes = NULL)
	{
		if (!empty($attributes['src'])) {
			if (strpos($attributes['src'], '://') === FALSE) {
				// Add the base URL
				$attributes['src'] = SG_URL::base() . $attributes['src'];
			}
		}

		$attributes['type'] = 'image';

		return SG_Form::input($name, $value, $attributes);
	}

	public static function button($name, $body, array $attributes = NULL)
	{
		// Set the input name
		$attributes['name'] = $name;

		return '<button' . SG_HTML::attributes($attributes) . '>' . $body . '</button>';
	}

	public static function label($input, $text = NULL, array $attributes = NULL)
	{
		if ($text === NULL) {
			// Use the input name as the text
			$text = ucwords(preg_replace('/\W+/', ' ', $input));
		}

		// Set the label target
		$attributes['for'] = $input;

		return '<label' . SG_HTML::attributes($attributes) . '>' . $text . '</label>';
	}

}
