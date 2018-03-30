<?php
/**
 * Muttley Framework
 *
 * @package     MuttleyPanel
 * @subpackage  cufon_code 
 * @author      Mariusz Rek
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MuttleyPanel_cufon_code' ) ) {

	class MuttleyPanel_cufon_code extends MuttleyPanel {

		private static $_initialized = false;
		private static $_args;
		private static $_saved_options;
		private static $_option;


		/**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
        */
		public function __construct( $option, $args, $saved_options ) {

			// Variables
			self::$_args = $args;
			self::$_saved_options = $saved_options;
			self::$_option = $option;
			
			// Only for first instance
			if ( ! self::$_initialized ) {
	            self::$_initialized = true;
	        }

		}


		/**
         * Field Render Function.
         * Takes the vars and outputs the HTML
         *
         * @since 		1.0.0
         * @access  	public
        */
		public function render() {

			if ( isset( self::$_saved_options[self::$_option['id']] ) ) {
				self::$_option['std'] = self::$_saved_options[self::$_option['id']];
			}
			
			echo '<div class="box-row clearfix">';
			if ( isset( self::$_option['name'] ) && ( self::$_option['name'] != '' ) ) {	
				echo '<label for="cufon-code" >' . self::$_option['name'] . '</label>';
			}
			echo '<textarea id="cufon-code" name="' . self::$_option['id'] . '" style="height:' . self::$_option['height'] . 'px">' . self::$_option['std'] . '</textarea>';
			echo '<div id="cufon-tags"></div>';
			echo '<div class="help-box">';
			echo self::$_option['desc'];
			echo '</div>';
			echo '</div>';

		}

	}
}