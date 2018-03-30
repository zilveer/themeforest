<?php
/**
 * Muttley Framework
 *
 * @package     MuttleyPanel
 * @subpackage  textarea
 * @author      Mariusz Rek
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MuttleyPanel_textarea' ) ) {

	class MuttleyPanel_textarea extends MuttleyPanel {

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
			if ( isset( self::$_option['tinymce'] ) && self::$_option['tinymce'] == 'true') {
				echo '<div class="custom-tiny-editor" style="padding:0;border:none" data-id="'.self::$_option['id'].'">';
				wp_editor( self::$_option['std'], self::$_option['id'], $settings = array() );
			    echo '</div>';
			} else {
				echo '<textarea id="' . self::$_option['id'] . '" name="' . self::$_option['id'] . '" style="height:' . self::$_option['height'] . 'px" >' . self::$_option['std'] . '</textarea>';
			}
			echo '<div class="help-box">';
			$this->e_esc( self::$_option['desc'] );
			echo '</div>';
			echo '</div>';

		}

	}
}