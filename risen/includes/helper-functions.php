<?php
/**
 * Helper Functions
 *
 * Utility type functions. Also see posts.php for helper functions relating to posts and taxonomiess
 */

/**
 * Merge an array into another array after a specific key
 *
 * Meant for one dimensional associative arrays
 * Used to insert post type overview columns
 */

if ( ! function_exists( 'risen_array_merge_after_key' ) ) {
	 
	function risen_array_merge_after_key( $original_array, $insert_array, $after_key ) {

		$modified_array = array();

		// loop original array items
		foreach( $original_array as $item_key => $item_value ) {
		
			// rebuild the array one item at a time
			$modified_array[$item_key] = $item_value;
			
			// insert array after specific key
			if ( $item_key == $after_key ) {
				$modified_array = array_merge( $modified_array, $insert_array );
			}
		
		}

		return $modified_array;

	}
	
}

/** 
 * Retrieve the URI of the highest priority template file that exists. 
 *
 * Searches in the stylesheet directory before the template directory so themes 
 * which inherit from a parent theme can just overload one file. 
 * 
 * This is from here (should be available in future version of WP):
 * http://core.trac.wordpress.org/attachment/ticket/18302/18302.2.2.patch
 * http://core.trac.wordpress.org/ticket/18302
 * 
 * @param string|array $template_names Template file(s) to search for, in order. 
 * @return string The URI of the file if one is located. 
 */

if ( ! function_exists( 'risen_locate_template_uri' ) ) {
	 
	function risen_locate_template_uri( $template_names ) {
	
		$located = ''; 
		
		foreach ( (array) $template_names as $template_name ) { 
		
			if ( ! $template_name ) 
			
				continue; 
				
				if ( file_exists( get_stylesheet_directory() . '/' . $template_name ) ) { 
					$located = get_stylesheet_directory_uri() . '/' . $template_name; 
					break; 					
				} else if ( file_exists(get_template_directory() . '/' . $template_name ) ) { 
					$located = get_template_directory_uri() . '/' . $template_name; 
					break; 
				} 
				
			}
			
		return $located; 

	}
	
}

/**
 * Get current URL
 */
 
function risen_current_url() {

	$url = 'http';
	if ( ( ! empty( $_SERVER['HTTPS'] ) && $_SERVER['HTTPS'] !== 'off' ) || 443 == $_SERVER['SERVER_PORT'] ) {
		$url .= 's';
	}
	
	$url .= '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

	return $url;

}

/**
 * Check if string is a URL
 *
 * @since 2.0
 * @param string $string String to check for URL format
 * @return bool True if string i=s URL
 */
function risen_is_url( $string ) {

	$bool = false;

	$url_pattern = '/^(http(s*)):\/\//i';

	if ( preg_match( $url_pattern, $string ) ) { // URL
		$bool = true;
	}

	return apply_filters( 'risen_is_url', $bool, $string );

}

/**
 * http or https protocol
 *
 * @since 2.0
 * @return string http or https protocol
 */
function risen_current_protocol() {

	$protocol = is_ssl() ? 'https' : 'http';

	return apply_filters( 'risen_current_protocol', $protocol );

}

/**
 * Check if URL is local
 *
 * @since 2.0
 * @param string $url URL to test
 * @return bool True if URL is local
 */ 
function risen_is_local_url( $url ) {

	$bool = false;

	if ( risen_is_url( $url ) && preg_match( '/^' . preg_quote( site_url(), '/' ) . '/', $url ) ) {
		$bool = true;
	}

	return apply_filters( 'risen_is_local_url', $bool, $url );

}

/**
 * Return output from get_template_part()
 *
 * This is handy for outputting template content with shortcodes
 */

if ( ! function_exists( 'risen_get_template_part_contents' ) ) {
	 
	function risen_get_template_part_contents( $slug, $name = false ) {

		// start output buffer
		ob_start();
		
		// load template
		get_template_part( $slug, $name );
		
		// capture the output
		$content = ob_get_contents();
		
		// clear the buffer
		ob_end_clean();

		// return the output
		return $content;

	}
	
}

/**
 * Return output from locate_template()
 *
 * Similar to risen_get_template_part_contents() but able to get template files in any directory
 * This is handy for outputting template content with shortcodes
 */

if ( ! function_exists( 'risen_locate_template_contents' ) ) {
	 
	function risen_locate_template_contents( $template ) {

		// start output buffer
		ob_start();
		
		// load template
		locate_template( $template, true );
		
		// capture the output
		$content = ob_get_contents();
		
		// clear the buffer
		ob_end_clean();

		// return the output
		return $content;

	}
	
}

/**
 * Shorten string within character limit while preserving words
 *
 * An alternative to wp_trim_words().
 * Useful when need strict character limit but don't want to cut words in half.
 */
function risen_shorten( $string, $max_chars ) {

	$max_chars = absint( $max_chars );

	// Shorten to within X characters without cutting words in half
	if ( $max_chars && strlen( $string ) > $max_chars ) {

		// Shorten
		$haystack = substr( $string, 0, $max_chars );
		$length = strrpos( $haystack, ' ' );
		$processed_string = substr( $string, 0, $length );

		// Append ... if string was shortened
		if ( strlen( $processed_string ) < strlen( $string ) ) {
			/* translators: ... after shortened string */
			$processed_string .= _x( '&hellip;', 'shortened text', 'risen' );
		}

	}

	// Use original string if none shortened
	if ( empty( $processed_string ) ) {
		$processed_string = $string;
	}

	// Return filtered
	return apply_filters( 'risen_shorten', $processed_string, $string, $max_chars );

}