<?php
/**
 * @package        wpgrade
 * @category       functions
 * @author         Pixel Grade Team
 * @deprecated kept for legacy reasons
 */
class wpgrade {
	/**
	 * @return string the lowercase version of the name
	 * @deprecated used only in pixtypes now
	 */
	static function shortname() {
		return 'pile';
	}

	/**
	 * @return string theme prefix
	 * @deprecated used only in pixtypes now
	 */
	static function prefix() {
		return '_pile_';
	}

	/** @var WP_Theme */
	protected static $theme_data = null;

	/**
	 * @return WP_Theme
	 */
	static function themedata() {
		if ( self::$theme_data === null ) {
			if ( is_child_theme() ) {
				$theme_name       = get_template();
				self::$theme_data = wp_get_theme( $theme_name );
			} else {
				self::$theme_data = wp_get_theme();
			}
		}

		return self::$theme_data;
	}

	/**
	 * @return string
	 */
	static function themeversion() {
		return wpgrade::themedata()->Version;
	}

	/**
	 * @return string
	 */
	static function template_folder() {
		return wpgrade::themedata()->Template;
	}

	/**
	 * Helper for registering scripts based on a wpgrade configuration pattern.
	 * Used in wpgrade-system/hook for reading wpgrade-config values
	 *
	 * @param array   scripts
	 * @param boolean place scripts in footer?
	 */
	protected static function register_scripts( $scripts, $in_footer ) {
		foreach ( $scripts as $scriptname => $conf ) {
			// the child theme may be allowed to overwrite the configuration in
			// which case we support for null configuration, ie. child theme turned
			// the resource off
			if ( $conf !== null ) {
				if ( is_string( $conf ) ) {
					$path       = $conf;
					$require    = array();
					$cache_bust = '';

				} else { // array configuration passed
					$path = $conf['path'];

					// compute requirements
					if ( isset( $conf['require'] ) ) {
						if ( is_string( $conf['require'] ) ) {
							$require = array( $conf['require'] );
						} else { // assume array
							$require = $conf['require'];
						}
					} else { // no dependencies
						$require = array();
					}

					// compute cache bust
					if ( isset( $conf['cache_bust'] ) ) {
						$cache_bust = $conf['cache_bust'];
					} else { // no cache bust
						$cache_bust = '';
					}
				}

				wp_register_script( $scriptname, $path, $require, $cache_bust, $in_footer );
			}
		}
	}

	/**
	 * Get an array with all queued scripts
	 *
	 * @return array
	 */
	static function get_queued_scripts() {
		global $wp_scripts;

		$loading_scripts = array();
		foreach ( $wp_scripts->queue as $key => $handle ) {

			// ensure a proper script src ( highjacked from wordpress core )
			$src = $wp_scripts->registered[ $handle ]->src;

			if ( !preg_match('|^(https?:)?//|', $src) && ! ( $wp_scripts->content_url && 0 === strpos($src, $wp_scripts->content_url) ) ) {
				$src = $wp_scripts->base_url . $src;
			}

			$loading_scripts[ $handle ] = $src;
		}

		return $loading_scripts;
	}

	/**
	 * Get an array with all queued styles
	 *
	 * @return array
	 */
	static function get_queued_styles() {
		global $wp_styles;

		$loading_styles = array();
		foreach ( $wp_styles->queue as $key => $handle ) {

			// ensure a proper script src ( highjacked from wordpress core )
			$src = $wp_styles->registered[ $handle ]->src;

			if ( !preg_match('|^(https?:)?//|', $src) && ! ( $wp_styles->content_url && 0 === strpos($src, $wp_styles->content_url) ) ) {
				$src = $wp_styles->base_url . $src;
			}

			$loading_styles[ $handle ] = $src;
		}
		return $loading_styles;
	}

	/*
	 * Inserts a new key/value after the key in the array.
	 *
	 * @param $key
	 *   The key to insert after.
	 * @param $array
	 *   An array to insert in to.
	 * @param $new_key
	 *   The key to insert.
	 * @param $new_value
	 *   An value to insert.
	 *
	 * @return
	 *   The new array if the key exists, FALSE otherwise.
	 *
	 * @see array_insert_before()
	 */
	static function array_insert_after($key, array &$array, $new_key, $new_value) {
		if (array_key_exists($key, $array)) {
			$new = array();
			foreach ($array as $k => $value) {
				$new[$k] = $value;
				if ($k === $key) {
					$new[$new_key] = $new_value;
				}
			}
			return $new;
		}
		return FALSE;
	}
} # class
