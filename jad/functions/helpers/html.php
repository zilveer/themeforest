<?php

class SG_HTML {

	public static $attribute_order = array
	(
		'action',
		'method',
		'type',
		'id',
		'name',
		'value',
		'href',
		'src',
		'width',
		'height',
		'cols',
		'rows',
		'size',
		'maxlength',
		'rel',
		'media',
		'accept-charset',
		'accept',
		'tabindex',
		'accesskey',
		'alt',
		'title',
		'class',
		'style',
		'selected',
		'checked',
		'readonly',
		'disabled',
	);
	
	public static $windowed_urls = FALSE;

	public static function chars($value, $double_encode = TRUE)
	{
		return htmlspecialchars((string) $value, ENT_QUOTES, get_bloginfo('charset', 'display'), $double_encode);
	}

	public static function entities($value, $double_encode = TRUE)
	{
		return htmlentities((string) $value, ENT_QUOTES, get_bloginfo('charset', 'display'), $double_encode);
	}

	public static function anchor($uri, $title = NULL, array $attributes = NULL, $protocol = NULL)
	{
		if ($title === NULL) {
			// Use the URI as the title
			$title = $uri;
		}

		if ($uri === '') {
			// Only use the base URL
			$uri = SG_URL::base($protocol);
		} else {
			if (strpos($uri, '://') !== FALSE) {
				if (SG_HTML::$windowed_urls === TRUE AND empty($attributes['target'])) {
					// Make the link open in a new window
					$attributes['target'] = '_blank';
				}
			} elseif ($uri[0] !== '#') {
				// Make the URI absolute for non-id anchors
				$uri = SG_URL::site($uri, $protocol);
			}
		}

		// Add the sanitized link to the attributes
		$attributes['href'] = $uri;

		return '<a' . SG_HTML::attributes($attributes) . '>' . $title . '</a>';
	}

	public static function file_anchor($file, $title = NULL, array $attributes = NULL, $protocol = NULL)
	{
		if ($title === NULL) {
			// Use the file name as the title
			$title = basename($file);
		}

		// Add the file link to the attributes
		$attributes['href'] = SG_URL::base($protocol) . $file;

		return '<a' . SG_HTML::attributes($attributes) . '>' . $title . '</a>';
	}

	public static function obfuscate($string)
	{
		$safe = '';
		foreach (str_split($string) as $letter) {
			switch (rand(1, 3)) {
				// HTML entity code
				case 1: $safe .= '&#' . ord($letter) . ';';
					break;
				// Hex character code
				case 2: $safe .= '&#x' . dechex(ord($letter)) . ';';
					break;
				// Raw (no) encoding
				case 3: $safe .= $letter;
			}
		}

		return $safe;
	}

	public static function email($email)
	{
		// Make sure the at sign is always obfuscated
		return str_replace('@', '&#64;', SG_HTML::obfuscate($email));
	}

	public static function mailto($email, $title = NULL, array $attributes = NULL)
	{
		// Obfuscate email address
		$email = SG_HTML::email($email);

		if ($title === NULL) {
			// Use the email address as the title
			$title = $email;
		}

		return '<a href="&#109;&#097;&#105;&#108;&#116;&#111;&#058;' . $email . '"' . SG_HTML::attributes($attributes) . '>' . $title . '</a>';
	}

	public static function style($file, array $attributes = NULL)
	{
		if (strpos($file, '://') === FALSE) {
			// Add the base URL
			$file = SG_URL::base() . $file;
		}

		// Set the stylesheet link
		$attributes['href'] = $file;

		// Set the stylesheet rel
		$attributes['rel'] = 'stylesheet';

		// Set the stylesheet type
		$attributes['type'] = 'text/css';

		return '<link' . SG_HTML::attributes($attributes) . ' />';
	}

	public static function script($file, array $attributes = NULL)
	{
		if (strpos($file, '://') === FALSE) {
			// Add the base URL
			$file = SG_URL::base() . $file;
		}

		// Set the script link
		$attributes['src'] = $file;

		// Set the script type
		$attributes['type'] = 'text/javascript';

		return '<script' . SG_HTML::attributes($attributes) . '></script>';
	}

	public static function image($file, array $attributes = NULL)
	{
		if (strpos($file, '://') === FALSE) {
			// Add the base URL
			$file = SG_URL::base() . $file;
		}

		// Add the image link
		$attributes['src'] = $file;

		return '<img' . SG_HTML::attributes($attributes) . ' />';
	}

	public static function attributes(array $attributes = NULL)
	{
		if (empty($attributes))
			return '';

		$sorted = array();
		foreach (SG_HTML::$attribute_order as $key) {
			if (isset($attributes[$key])) {
				// Add the attribute to the sorted list
				$sorted[$key] = $attributes[$key];
			}
		}

		// Combine the sorted attributes
		$attributes = $sorted + $attributes;

		$compiled = '';
		foreach ($attributes as $key => $value) {
			if ($value === NULL) {
				// Skip attributes that have NULL values
				continue;
			}

			// Add the attribute value
			$compiled .= ' ' . $key . '="' . htmlspecialchars($value, ENT_QUOTES, get_bloginfo('charset', 'display')) . '"';
		}

		return $compiled;
	}

}
