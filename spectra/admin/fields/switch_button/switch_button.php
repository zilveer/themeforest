<?php
/**
 * Muttley Framework
 *
 * @package     MuttleyPanel
 * @subpackage  switch_button
 * @author      Mariusz Rek
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MuttleyPanel_switch_button' ) ) {
	class MuttleyPanel_switch_button extends MuttleyPanel {

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

	            // Enqueue
				add_action( 'admin_enqueue_scripts', array( &$this, 'enqueue' ) );         
	            
	        }

		}


		/**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
        */
		public function enqueue() {
			
			// Display only on admin page
			$current_screen = get_current_screen();
			$current_page = 'toplevel_page_'.self::$_args['page_name'];

			if ( $current_screen->base === $current_page  ) {

				$path = get_template_directory_uri() . self::$_args['admin_dir'];

				// Load script
				$handle = self::$_option['type'] . '.js';
				if ( ! wp_script_is( $handle, 'enqueued' ) ) {
					wp_enqueue_script( $handle, $path . '/fields/' . self::$_option['type'] . '/' . self::$_option['type'] . '.js', false, false, true );
				}

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

			if ( isset( self::$_option['group']) && self::$_option['group'] != '' ) {
				$group_class = 'switch-group';
				$group_id = self::$_option['group'];
			} else {
				$group_class = '';
				$group_id = '';
			}

			/* Row */
			echo '<div class="box-row clearfix">';
			if ( isset( self::$_option['name'] ) && ( self::$_option['name'] != '' ) ) {	
				echo '<label for="' . self::$_option['id'] . '" class="switch-label">' . self::$_option['name'] . '</label>';
			}

			echo '<div class="switch-wrap">';
			echo '<select class="' . $group_class . '" name="' . self::$_option['id'] . '" id="' . self::$_option['id'] . '" data-highlight="true" data-main-group="main-group-' . $group_id . '">';

			if (self::$_option['std'] == 'on') {
				$selected = 'selected';
			} else {
				$selected = '';
			}
	        echo '<option value="on" ' . $selected . '>On</option>';
	        if (self::$_option['std'] == 'off') {
	        	$selected = 'selected';
	        } else { 
	        	$selected = '';
	        }
	        echo '<option value="off" ' . $selected . '>Off</option>';
	      	echo '</select>';
			echo '</div>';

			/* Help */
			echo '<div class="help-box">';
			$this->e_esc( self::$_option['desc'] );
			echo '</div>';

			echo '</div>';
			
		}

	}
}