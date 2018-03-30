<?php
/**
 * Muttley Framework
 *
 * @package     MuttleyPanel
 * @subpackage  select
 * @author      Mariusz Rek
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MuttleyPanel_select' ) ) {

	class MuttleyPanel_select extends MuttleyPanel {

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
			
			if ( isset( self::$_option['group'] ) && self::$_option['group'] != '' ) {
				$group_class = 'select-group';
				$group_id = self::$_option['group'];
			} else {
				$group_class = '';
				$group_id = '';
			}
			
			echo '<div class="box-row clearfix">';
			if ( isset( self::$_option['name'] ) && ( self::$_option['name'] != '' ) ) {	
				echo '<label for="' . self::$_option['id'] . '" >' . self::$_option['name'] . '</label>';
			}
			echo '<select name="' . self::$_option['id'] . '" id="' . self::$_option['id'] . '" size="1" data-main-group="main-group-' . $group_id . '" class="' . $group_class . '">';
			if (isset( self::$_option['options'] ) ) {
				foreach ( self::$_option['options'] as $option ) {
					if ( isset( self::$_option['std'] ) && self::$_option['std'] == $option['value'] ) $selected = 'selected="selected"';
					else $selected = '';
					echo "<option $selected value='" . $option['value'] . "'>" . $option['name'] . "</option>";
				}
			}
			echo '</select>';
			echo '<div class="clear"></div>';
			echo '<div class="help-box">';
			$this->e_esc( self::$_option['desc'] );
			echo '</div>';
			echo '</div>';

		}
	}
}