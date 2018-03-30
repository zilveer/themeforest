<?php

class SG_URL {

	public static function base($protocol = FALSE)
	{
		if ($protocol === TRUE) {
			if (!empty($_SERVER['HTTPS']) AND filter_var($_SERVER['HTTPS'], FILTER_VALIDATE_BOOLEAN)) {
				// This request is secure
				$protocol = 'https';
			} else {
				$protocol = 'http';
			}
		}

		// Start with the configured base URL
		$base_url = '/';

		if (is_string($protocol)) {
			if (parse_url($base_url, PHP_URL_HOST)) {
				// Remove everything but the path from the URL
				$base_url = parse_url($base_url, PHP_URL_PATH);
			}

			// Add the protocol and domain to the base URL
			$base_url = $protocol . '://' . $_SERVER['HTTP_HOST'] . $base_url;
		}

		return $base_url;
	}

	public static function site($uri = '', $protocol = FALSE)
	{
		// Get the path from the URI
		$path = trim(parse_url($uri, PHP_URL_PATH), '/');

		if ($query = parse_url($uri, PHP_URL_QUERY)) {
			// ?query=string
			$query = '?' . $query;
		}

		if ($fragment = parse_url($uri, PHP_URL_FRAGMENT)) {
			// #fragment
			$fragment = '#' . $fragment;
		}

		// Concat the URL
		return SG_URL::base($protocol) . $path . $query . $fragment;
	}

	public static function query(array $params = NULL)
	{
		if ($params === NULL) {
			// Use only the current parameters
			$params = $_GET;
		} else {
			// Merge the current and new parameters
			$params = array_merge($_GET, $params);
		}

		if (empty($params)) {
			// No query parameters
			return '';
		}

		$query = http_build_query($params, '', '&');

		// Don't prepend '?' to an empty string
		return ($query === '') ? '' : '?' . $query;
	}

}