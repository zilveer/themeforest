<?php
/**
 * Muttley Framework
 *
 * @package     MuttleyPanel
 * @subpackage  code_editor
 * @author      Mariusz Rek
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MuttleyPanel_code_editor' ) ) {
	class MuttleyPanel_code_editor extends MuttleyPanel {

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

				wp_enqueue_style( 'code_mirror_css', $path . '/fields/' . self::$_option['type'] . '/code_mirror/lib/codemirror.css' );
				wp_enqueue_script( 'code_mirror', $path . '/fields/' . self::$_option['type'] . '/code_mirror/lib/codemirror.js', false, false, true );
				wp_enqueue_script( 'code_mirror_js_css', $path . '/fields/' . self::$_option['type'] . '/code_mirror/mode/css/css.js', false, false, true );
				wp_enqueue_script( 'code_mirror_js_javascript', $path . '/fields/' . self::$_option['type'] . '/code_mirror/mode/javascript/javascript.js', false, false, true );
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
			echo '<textarea id="' . self::$_option['id'] . '" name="' . self::$_option['id'] . '" style="height:' . self::$_option['height'] . 'px" class="code-editors">' . self::$_option['std'] . '</textarea>';

			echo '<div class="help-box">';
			$this->e_esc( self::$_option['desc'] );
			echo '</div>';
			echo '</div>';
			
		}

	}
}