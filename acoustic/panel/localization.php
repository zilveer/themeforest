<?php
//
// Translation support for the CSSIgniter Panel options
//
// Currently supported (in order of preference):
//   * WPML
//   * Polylang
//   * qTranslate (no custom fields)
//

add_action( 'wp_loaded', 'ci_handle_register_panel_translations' );
if( ! function_exists('ci_handle_register_panel_translations') ):
function ci_handle_register_panel_translations()
{
	global $ci;
	ci_register_panel_translation($ci);
}
endif;

if( ! function_exists('ci_register_panel_translation') ):
function ci_register_panel_translation($options)
{
	if(is_array($options))
	{
		foreach($options as $key => $value)
		{
			if( is_array($value) ) {
				ci_register_panel_translation($value);
			}
			else {
				ci_register_string_translation($key, $value, 'Panel');
			}
		}
	}
}
endif;


if( ! function_exists('ci_register_string_translation') ):
/**
 * Registers a string for translation. Needs a supported translation plugin active.
 * Parameters should be identical to respective calls of ci_get_string_translation()
 *
 * @param string $name A description of the value, e.g. 'Booking - Button Text'
 * @param string $value The text to be registered for translation, e.g. 'Book Now'
 * @param string $context A context for grouping and disambiguation of the value, e.g. 'Widgets'
 * @return string The string $value passed.
 */
function ci_register_string_translation($name, $value, $context)
{
	// WPML support
	if(function_exists('icl_register_string'))
	{
		icl_register_string($context, $name.' - '.md5($value) , $value);
	}
	// Polylang support
	elseif(function_exists('pll_register_string'))
	{
		// Must be run in every pageload.
		pll_register_string($context.' - '.$name, $value);
	}
	// qTranslate seems to be working out of the box.

	// Return the $value so that the function can be used in nested calls.
	// E.g.: $value = ci_register_string_translation( $name, sanitize_text_field($value), $context );
	return $value;
}
endif;


if( ! function_exists('ci_get_string_translation') ):
/**
 * Retrieves the translation for a string, if available. Needs a supported translation plugin active.
 * Parameters should be identical to respective call of ci_register_string_translation()
 *
 * @param string $name A description of the value, e.g. 'Booking - Button Text'
 * @param string $value The text to be registered for translation, e.g. 'Book Now'
 * @param string $context A context for grouping and disambiguation of the value, e.g. 'Widgets'
 * @return string A translation of $value if available, else $value.
 */
function ci_get_string_translation($name, $value, $context)
{
	$translation = $value;

	// WPML support
	if(function_exists('icl_t'))
	{
		$translation = icl_t($context, $name.' - '.md5($value), $value);
	}
	// Polylang support
	elseif(function_exists('pll__'))
	{
		// Doesn't work before the 'wp' action.
		$translation = pll__($value);
	}
	// qTranslate seems to be working out of the box.

	return $translation;
}
endif;


add_action( 'wp', 'ci_handle_panel_translation' );
if( ! function_exists('ci_handle_panel_translation') ):
function ci_handle_panel_translation()
{
	global $ci;
	ci_load_panel_translation($ci);
}
endif;

if( ! function_exists('ci_load_panel_translation') ):
function ci_load_panel_translation(&$options)
{
	if(is_array($options))
	{
		foreach($options as $key => $value)
		{
			if( is_array($value) ) {
				$options[$key] = ci_load_panel_translation($value);
			}
			else {
				$options[$key] = ci_get_string_translation($key, $value, 'Panel');
			}
		}
	}
	return $options;
}
endif;


//
// Helper functions
//

if( ! function_exists('ci_translate_post_id') ):
function ci_translate_post_id($post_id, $return_default=false, $post_type='post', $lang=false)
{
	// WPML support
	if(function_exists('icl_object_id'))
	{
		if( empty($lang) ) $lang = null;

		// Returns null if a translation is not found.
		$trans = icl_object_id($post_id, $post_type, false, $lang);
		if(!empty($trans))
			return $trans;
		elseif($return_default)
			return $post_id;
		else
			return false;
	}
	// Polylang support
	elseif(function_exists('pll_get_post'))
	{
		if( empty($lang) ) $lang = '';

		// Returns false if a translation is not found.
		$trans = pll_get_post($post_id, $lang);
		if(!empty($trans))
			return $trans;
		elseif($return_default)
			return $post_id;
		else
			return false;
	}
	// qTranslate doesn't need this as translations are stored in a single post.

	// No plugin detected.
	return $post_id;
}
endif;

if( !function_exists('ci_localize_datepicker') ):
/**
 * Translates the jQuery UI DatePicker widget, according to the current language.
 * Must be called (once) before the datepicker is instantiated, i.e. before it's actually used in a JS file.
 */
function ci_localize_datepicker()
{
	global $wp_locale;
	$lang = 'en_US';
	if( defined('WPLANG') && WPLANG ) {
		$lang = WPLANG;
	}
	$translations = apply_filters('ci_datepicker_translation', array(
		'langCode'       => $lang,
		'prevText'       => __('Previous', 'ci_theme'),
		'nextText'       => __('Next', 'ci_theme'),
		'closeText'       => __('Close', 'ci_theme'),
		'currentText'     => __('Today', 'ci_theme'),
		// array_values() makes sure we get zero-based arrays
		'monthNames'      => array_values($wp_locale->month),
		'monthNamesShort' => array_values($wp_locale->month_abbrev),
		'dayNames'        => array_values($wp_locale->weekday),
		'dayNamesShort'   => array_values($wp_locale->weekday_abbrev),
		'dayNamesMin'     => array_values($wp_locale->weekday_initial),
		'dateFormat'      => date_format_php_to_datepicker(get_option('date_format')),
		'firstDay'        => get_option('start_of_week'),
		'isRTL'           => $wp_locale->text_direction == 'rtl' ? true : false
	));

	wp_enqueue_script('jquery-ui-datepicker');
	wp_enqueue_script('jquery-ui-datepicker-localize');
	wp_localize_script('jquery-ui-datepicker-localize', 'jquidp', $translations);
}
endif;

if( !function_exists('date_format_php_to_datepicker') ):
/**
 * Converts a PHP date format string, to a jQueryUI DatePicker compatible format.
 *
 * @param string $format A valid PHP date format string
 * @return string A valid jQueryUI DatePicker format string
 */
function date_format_php_to_datepicker( $format )
{
	// Thanks Tristan Jahier for the conversion table.
	// http://tristan-jahier.fr/blog/2013/08/convertir-un-format-de-date-php-en-format-de-date-jqueryui-datepicker

	$php2js = array(
		// Day
		'd' => 'dd',
		'D' => 'D',
		'j' => 'd',
		'l' => 'DD',
		'N' => '',
		'S' => '',
		'w' => '',
		'z' => 'o',
		// Week
		'W' => '',
		// Month
		'F' => 'MM',
		'm' => 'mm',
		'M' => 'M',
		'n' => 'm',
		't' => '',
		// Year
		'L' => '',
		'o' => '',
		'Y' => 'yy',
		'y' => 'y',
		// Time
		'a' => '',
		'A' => '',
		'B' => '',
		'g' => '',
		'G' => '',
		'h' => '',
		'H' => '',
		'i' => '',
		's' => '',
		'u' => ''
	);

	$js_array = array();
	$escape = false;
	$format_array = str_split($format);
	foreach($format_array as $char)
	{
		if($escape === true)
		{
			$js_array[] = $char;
			$escape = false;
			continue;
		}
		if($char == '\\')
		{
			$escape = true;
			continue;
		}
		if(isset($php2js[$char]))
			$js_array[] = $php2js[$char];
		else
			$js_array[] = $char;
	}

	return implode('', $js_array);
}
endif;

?>