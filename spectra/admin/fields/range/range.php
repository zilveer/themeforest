<?php
/**
 * Muttley Framework
 *
 * @package     MuttleyPanel
 * @subpackage  range
 * @author      Mariusz Rek
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MuttleyPanel_range' ) ) {

	class MuttleyPanel_range extends MuttleyPanel {

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
				echo '<label for="' . self::$_option['id'] . '" >' . self::$_option['name'] . '</label>';
			}
			echo '<div class="range">';
			echo '<div class="range-slider"></div>';
			echo '<input name="' . self::$_option['id'] . '" id="' . self::$_option['id'] . '" type="text" class="range-input" value="' . self::$_option['std'] . '"';

			if ( isset( self::$_option['min'] ) ) {
				echo ' data-min="' . self::$_option['min'] . '"';
			} else {
				echo ' data-min="0"';
			}
			if ( isset( self::$_option['max'] ) ) {
				echo ' data-max="' . self::$_option['max'] . '"';
			} else {
				echo ' data-max="100"';
			}
			if ( isset( self::$_option['step'] ) ) {
				echo ' data-step="' . self::$_option['step'] . '"';
			} else {
				echo ' data-step="1"';
			}
			echo '/>';
			if ( isset( self::$_option['unit'] ) && self::$_option['unit']) {
				echo '<span class="range-unit">' . self::$_option['unit'] . '</span>';
			}
			echo '</div>';
			echo '<div class="help-box">';
			$this->e_esc( self::$_option['desc'] );
			echo '</div>';
			echo '</div>';

		}

	}
}