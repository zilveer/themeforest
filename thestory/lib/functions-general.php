<?php
/**
 * General functions.
 */


if ( !function_exists( 'pexeto_convert_to_class' ) ) {

	/**
	 * Converts a name that consists of more words and different characters to 
	 * a class (id).
	 * @param  string $name the name to be converted
	 * @return string       the converted name
	 */
	function pexeto_convert_to_class( $name ) {
		return strtolower( str_replace( array( ' ', ',', '.', '"', "'", '/', "\\", 
			'+', '=', ')', '(', '*', '&', '^', '%', '$', '#', '@', '!', '~', '`', 
			'<', '>', '?', '[', ']', '{', '}', '|', ':', ';' ), '', $name ) );
	}
}
