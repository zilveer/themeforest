<?php
/**
 * MediaCenter Class
 *
 * @author   Transvelo
 * @package  mediacenter
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'MediaCenter' ) ) :

	/**
	 * The main MediaCenter class
	 */
	class MediaCenter {

		private static $structured_data;

		/**
		 * Setup Class
		 */
		public function __construct() {
			add_action( 'wp_footer',  array( $this, 'get_structured_data' ) );
		}

		/**
		 * Check if the passed $json variable is an array and store it into the property...
		 */
		public static function set_structured_data( $json ) {
			if ( ! is_array( $json ) ) {
				return;
			}

			self::$structured_data[] = $json;
		}

		/**
		 * If self::$structured_data is set, wrap and echo it...
		 * Hooked into the `wp_footer` action.
		 */
		public function get_structured_data() {
			if ( ! self::$structured_data ) {
				return;
			}

			$json['@context'] = 'http://schema.org/';

			if ( count( self::$structured_data ) > 1 ) {
				$json['@graph'] = self::$structured_data;
			} else {
				$json = $json + self::$structured_data[0];
			}

			echo '<script type="application/ld+json">' . wp_json_encode( $json ) . '</script>';
		}
	}

endif;

return new MediaCenter();