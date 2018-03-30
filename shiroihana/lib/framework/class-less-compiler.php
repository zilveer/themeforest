<?php if ( ! defined( 'ABSPATH' ) ) {
	die( 'Cheatin&#8217; uh?' );
}

/**
 * Youxi LESS Compiler
 *
 * This class provides the necessary methods to compile LESS files
 *
 * @package   Youxi Themes Theme Utils
 * @author    Mairel Theafila <maimairel@yahoo.com>
 * @copyright Copyright (c) 2014-2015, Mairel Theafila
 */

final class Youxi_LESS_Compiler {

	private $_less_parser_defaults = array(
		'use_cache' => false, 
		'compress'  => true
	);

	private $_less_parser;

	private static $_instance;

	private function __construct() {
		
		/* Include LESS parser */
		if( ! class_exists( 'Less_Parser' ) ) {
			require get_template_directory() . '/lib/vendor/lessphp/less.php';
		}
	}

	public static function get() {
		if( ! is_a( self::$_instance, get_class() ) ) {
			self::$_instance = new Youxi_LESS_Compiler();
		}

		return self::$_instance;
	}

	private function serialize_vars( $vars ) {
		return Less_Parser::serializeVars( $vars );
	}

	private function get_parser( $parser_args = array(), $reset = true ) {

		/* If the parser already exists */
		if( is_a( $this->_less_parser, 'Less_Parser' ) ) {
			if( $reset ) {
				$this->reset_parser( $parser_args );
			}
			return $this->_less_parser;
		}

		/* Determine parser options */
		$parser_options = wp_parse_args( $this->_less_parser_defaults, $parser_args );

		return ( $this->_less_parser = new Less_Parser( $parser_options ) );
	}

	private function reset_parser( $parser_args = array() ) {

		if( is_a( $this->_less_parser, 'Less_Parser' ) ) {

			/* Determine parser options */
			$parser_options = wp_parse_args( $this->_less_parser_defaults, $parser_args );

			/* Reset Parser */
			$this->_less_parser->reset( $parser_options );
		}
	}

	private function get_cache_key() {
		return apply_filters( 'youxi_less_cache_key', 'youxi_less_cache' );
	}

	private function read_cache( $less_files ) {

		/* Get the cache object from wp_options table */
		$cache = get_option( $this->get_cache_key(), array() );

		/* Calculate hash key for the current less file */
		$cache_hash = md5( implode( ',', (array) $less_files ) );

		/* Return the cache if valid */
		if( isset( $cache[ $cache_hash ] ) && is_array( $cache[ $cache_hash ] ) ) {
			return $cache[ $cache_hash ];
		}

		return array();
	}

	private function update_cache( $less_files, $updated ) {

		/* Get the cache object from wp_options table */
		$cache = get_option( $this->get_cache_key(), array() );

		/* Calculate hash key for the current less file */
		$cache_hash = md5( implode( ',', (array) $less_files ) );

		/* Store the updated cache */
		if( ! empty( $updated ) ) {
			$cache[ $cache_hash ] = $updated;
		} else {
			unset( $cache[ $cache_hash ] );
		}

		if( ! add_option( $this->get_cache_key(), $cache, '', 'no' ) ) {
			update_option( $this->get_cache_key(), $cache );
		}
	}

	private function is_valid_cache( $cache, $key, $hash ) {

		if( ! is_array( $cache ) || ! isset( $cache[ $key ] ) ) {
			return false;
		}

		if( ! isset( $cache[ $key ]['hash'], $cache[ $key ]['css'] ) ) {
			return false;
		}

		return $hash == $cache[ $key ]['hash'] && is_string( $cache[ $key ]['css'] );
	}

	public function compile( $less_files, $var_sets, $invalidate = false ) {

		global $wp_version;

		/* Get the cache entry for this less file */
		$cache = $this->read_cache( $less_files );
		$cache_modified = false;

		/* Make sure cache is an array */
		if( ! is_array( $cache ) ) {
			$cache = array();
		}

		/* Get files modification time */
		$hash_suffix = array();
		foreach( (array) $less_files as $file ) {
			$filename = trailingslashit( get_template_directory() ) . trim( $file, '/\\' );
			if( is_readable( $filename ) ) {
				$hash_suffix[] = filemtime( $filename );
			}
		}

		/* Get theme version */
		$theme     = wp_get_theme();
		$theme_ver = ( $theme->exists() ? $theme->get( 'Version' ) : 1 );

		$hash_suffix[] = $theme_ver;
		$hash_suffix[] = $wp_version;

		/* Create hash postfix */
		$hash_suffix = implode( '_', $hash_suffix );

		/* Prepare output */
		$output = '';
		$has_error = false;

		/* Parse and generate the styles */
		foreach( $var_sets as $vars_key => $vars ) {

			/* Serialize final vars */
			$serialized_vars = $this->serialize_vars( $vars );	

			/* Calculate hash from serialized vars, files modification time, theme version and WP version */
			$vars_hash = md5( $serialized_vars . '_' . $hash_suffix );

			/* Validate the cache by checking for keys and comparing variable hash */
			if( $invalidate || ! $this->is_valid_cache( $cache, $vars_key, $vars_hash ) ) {

				/* Get the parser again to also reset it */
				$parser = $this->get_parser();

				try {

					/* Parse the files first */
					foreach( (array) $less_files as $file ) {
						$parser->parseFile(
							trailingslashit( get_template_directory() ) . trim( $file, '/\\' ), 
							trailingslashit( get_template_directory_uri() ) . trim( $file, '/\\' )
						);
					}

					/* Now parse the variables */
					/* Remember! http://lesscss.org/features/#variables-feature-default-variables */
					$parser->parse( $serialized_vars );
					
					$css_output = trim( $parser->getCss() );

					if( ! empty( $css_output ) ) {

						/* Store the result in the current cache */
						$cache[ $vars_key ] = array(
							'hash' => $vars_hash, 
							'css'  => $css_output
						);
					} else {

						/* Remove empty CSS from cache */
						unset( $cache[ $vars_key ] );
					}

					/* We've modified the cache */
					$cache_modified = true;

				} catch( Exception $e ) {

					if( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
						error_log( $e->getMessage() );
					}

					/* Return immediately when an error occured */
					if( $e instanceof Less_Exception_Parser ) {
						return new WP_Error( 'less', $e->getMessage(), $e );
					} else {
						return new WP_Error();
					}
					
					/* Remove the style in case of errors */
					unset( $cache[ $vars_key ] );
				}
			}

			/* Concantenate the style if it is valid */
			if( $this->is_valid_cache( $cache, $vars_key, $vars_hash ) ) {
				$output .= $cache[ $vars_key ]['css'];
			}
		}

		/* If the cache is modified */
		if( $cache_modified ) {
			$this->update_cache( $less_files, $cache );
		}

		return $output;
	}
}