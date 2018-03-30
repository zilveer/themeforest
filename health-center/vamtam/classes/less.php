<?php

/**
 * LESSPHP wrapper
 *
 * @package wpv
 */

/**
 * class WpvLess
 */
class WpvLess {

	/**
	 * List of option names which are known to be percentages
	 *
	 * @var array
	 */
	private static $percentages = array(
		'left-sidebar-width',
		'right-sidebar-width',
	);

	/**
	 * Compiles the LESS files
	 */
	public static function compile() {
		global $wpv_mocked;

		self::export_vars();

		$file_from = WPV_THEME_CSS_DIR . 'all.less';
		$file_to   = WPV_CACHE_DIR . 'all'.( is_multisite() ? $GLOBALS['blog_id'] : '' ).'.css';

		if ( $wpv_mocked ) {
			try {
				$l = new WpvLessc();
				$l->importDir = '.';

				include WPV_HELPERS . 'lessphp-extensions.php';

				echo $l->compileFile( $file_from ); // xss ok
			} catch( Exception $e ) {
				self::warning( $e->getMessage() );
			}
		} else {
			$secret =  uniqid('', true) . mt_rand();
			file_put_contents(WPV_CACHE_DIR . 'less-spawn-secret', $secret);

			$response = wp_remote_post(
				THEME_URI . 'utils/lessc-spawn.php',
				array(
					'body' => array(
						'input'   => $file_from,
						'output'  => $file_to,
						'secret'  => $secret,
						'abspath' => ABSPATH,
					),
				)
			);

			if ( is_wp_error( $response ) ) {
				echo '<!--' . self::strip_comments( $response->get_error_message() ) . "-->\n";
				return self::basic_compile( $file_from, $file_to );
			} else {
				$result = json_decode( $response['body'] );

				if ( is_null( $result ) ) {
					echo '<!--' . self::strip_comments( $response['body'] ) . "-->\n";
					return self::basic_compile( $file_from, $file_to );
				} else {
					if ( $result->status !== 'ok' ) {
						echo '(error) ' . $result->message;
					} elseif ( isset( $result->message ) ) {
						echo $result->message;
					} else {
						_e( 'Saved', 'health-center' );
					}

					if ( isset( $result->memory ) ) {
						echo "\n<!--" . round( $result->memory, 2) . 'M -->';
					}
				}
			}
		}
	}

	private static function strip_comments( $content ) {
		return preg_replace('/<!--(.|\s)*?-->/', '', $content );
	}

	private static function basic_compile( $file_from, $file_to ) {
		if ( ! isset( $GLOBALS['wpv_only_smart_less_compilation'] ) ) {
			try {
				$l = new WpvLessc();
				$l->importDir = '.';

				include WPV_HELPERS . 'lessphp-extensions.php';

				$l->compileFile( $file_from, $file_to ); // xss ok

				_e( 'Saved', 'health-center' );
			} catch( Exception $e ) {
				self::warning( $e->getMessage() );
			}
		} else {
			echo '<!-- smart less failed -->';
			_e('Cannot compile LESS file', 'health-center');
		}
	}

	private static function export_vars() {
		global $wpdb, $wpv_mocked, $wpv_defaults;

		$vars_raw = $vars_raw_by_id = array();
		$defaults = $wpv_defaults;

		if ( ! $wpv_mocked ) {
			$vars_raw = $wpdb->get_results(
				"
				SELECT REPLACE( option_name, 'wpv_', '' ) as name, option_value as value
				FROM $wpdb->options
				WHERE option_name LIKE 'wpv_%'
				"
			);

			foreach ( $vars_raw as $v ) {
				$defaults[$v->name] = $v->value;
			}
		} else {
			global $skin_data;

			foreach ( $skin_data as $name => $value ) {
				$defaults[$name] = $value;
			}
		}

		$vars_raw = array();

		foreach ( $defaults as $name => $value ) {
			$vars_raw[] = ( object )compact( 'name', 'value' );
			$vars_raw_by_id[$name] = $value;
		}

		$vars = array();

		foreach ( $vars_raw as $var ) {

			if ( trim( $var->value ) === '' && preg_match( '/\bbackground-image\b/i', $var->name ) ) {
				$vars[$var->name] = '';
				continue;
			}

			if ( preg_match( '/^[-\w\d]+$/i', $var->name ) ) {
				if ( ! empty( $var->value ) && ( $value = self::prepare( $var->name, $var->value ) ) ) {
					$vars[$var->name] = $value;
				} else {
					$vars[$var->name] = null;
				}
			}
		}

		global $wpv_defaults;

		$vars['theme-images-dir'] = '"' . addslashes( WPV_THEME_IMAGES ) . '"';

		// -----------------------------------------------------------------------------
		$out = '';
		foreach ( $vars as $name => $value ) {
			if ( ! $value ) {
				$value = (
					strpos( $name, 'color' ) !== false ||
					(
						strpos( $name, 'background' ) !== false &&
						preg_match( '/attachment|image|position|repeat|size|opacity/', $name ) === 0
					)
				) ? 'transparent' : 'false';
			} else {
				$possible_opacity = preg_replace( '/-color$/', '-opacity', $name );
				if ( $possible_opacity !== $name && isset( $vars[$possible_opacity] ) && trim($value) !== 'transparent' ) {
					$value = 'fade( ' . $value . ',' . ( $vars[$possible_opacity] * 100 ) . '% )';
				}
			}

			$out .= "@$name:$value;\n";
		}
		$file_vars = WPV_CACHE_DIR . 'variables.less';
		file_put_contents( $file_vars, $out );
	}

	/**
	 * Sanitizes a variable
	 *
	 * @param  string  $name           option name
	 * @param  string  $value          option value from db
	 * @param  boolean $returnOriginal whether to return the db value if no good sanitization is found
	 * @return int|string|null         sanitized value
	 */
	private static function prepare( $name, $value, $returnOriginal = false ) {
		$good = true;
		$name = preg_replace( '/^wpv_/', '', $name );
		$originalValue = $value;

		// duck typing values
		if ( preg_match( '/(^share|^has-|^show|-last$)/i', $name ) ) {
			$good = false;
		} elseif ( is_numeric( $value ) ) { // most likely dimensions, must differentiate between percentages and pixels
			if ( in_array( $name, self::$percentages ) ) {
				$value .= '%';
			}
			elseif ( preg_match( '/(size|width|height)$/', $name ) ) { // treat as px
				$value .= 'px';
			}
		} elseif ( preg_match( '/^#([0-9a-f]{3}|[0-9a-f]{6})$/i', $value ) ) { // colors
			// as is
		} elseif ( preg_match( '/^http|^url/i', $value ) || preg_match( '/(face|weight)$/', $name ) ) { // urls and other strings
			$value = '"'.addslashes( $value ).'"';
		} elseif ( preg_match( '/^accent(?:-color-)?\d$/', $value ) ) { // accents
			$value = wpv_sanitize_accent( $value );
		} else {
			if ( ! preg_match( '/\bface\b|\burl\b/i', $name ) ) {
				// check keywords
				$keywords   = explode( ' ', 'top right bottom left fixed static scroll cover contain auto repeat repeat-x repeat-y no-repeat center normal italic bold 300 800 transparent' );
				$sub_values = explode( ' ', $value );
				foreach ( $sub_values as $s ) {
					if ( ! in_array( $s, $keywords ) ) {
						$good = false;
						break;
					}
				}
			}
		}

		return $good ? $value : ( $returnOriginal ? $originalValue : null );
	}

	/**
	 * shows a warning
	 *
	 * @param  string $message warning message
	 */
	private static function warning( $message ) {
		$message = str_replace( '*/', '* /', $message );
		echo "/* WARNING: $message */"; // xss ok
	}
}
