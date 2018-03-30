<?php
/**
 * Muttley Framework
 *
 * @package     MuttleyPanel
 * @subpackage  cufon_fonts
 * @author      Mariusz Rek
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MuttleyPanel_cufon_fonts' ) ) {

	class MuttleyPanel_cufon_fonts extends MuttleyPanel {

		private static $_initialized = false;
		private static $_args;
		private static $_saved_options;
		private static $_option;
		private static $_cufon_fonts;


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

				// Admin Footer
				add_action( 'admin_footer', array( &$this, 'admin_footer' ) );

				$path = get_template_directory_uri() . self::$_args['admin_dir'];

				// Load script
				$handle = self::$_option['type'] . '.js';
				if ( ! wp_script_is( $handle, 'enqueued' ) ) {
					wp_enqueue_script( $handle, $path . '/fields/' . self::$_option['type'] . '/cufon-yui.js', false, false, true );
				}

				$i = 0;
				if ( is_dir( self::$_option[ 'cufon_path' ] ) ) {
					if ( $open_dir = opendir( self::$_option[ 'cufon_path' ] ) ) {
						while ( ( $font = readdir( $open_dir ) ) !== false ) {
							if ( stristr( $font, '.js' ) !== false ) {
								$fgc_func = 'file_'.'get_'.'contents';
								$font_content = $fgc_func( self::$_option[ 'cufon_path' ] . $font );
								if ( preg_match( '/font-family":"(.*?)"/i', $font_content, $match ) ) {
									wp_enqueue_script( 'panel_cufon_font' . $i , self::$_option[ 'cufon_path_uri' ] . $font , false, false, true );
									self::$_cufon_fonts[$i]['name'] = $match[1];
									self::$_cufon_fonts[$i]['file_name'] = $font;
									self::$_cufon_fonts[$i]['file_path'] = self::$_option[ 'cufon_path_uri' ] . $font;
								}
								$i++;
							}
						}
					}
				}

			}
		}


		/**
         * Render HTML code in admin footer
         *
         * @since 		1.0.0
         * @access  	public
        */
		public function admin_footer() {

			// Cufon Fonts 
			if ( isset( self::$_cufon_fonts ) ) {
				$i = 0;
				$fonts_script = "<script type='text/javascript'>\njQuery(document).ready(function($) {\n";
																							
				foreach ( self::$_cufon_fonts as $font ) {
					$fonts_script .= stripslashes( "Cufon.replace('#cufon-font-$i', { fontFamily: '" . $font['name'] . "' });\n" );
					$i++;
				}
				echo "\n" . $fonts_script . "});\n</script>";
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
				echo '<label>' . self::$_option['name'] . '</label>';
			}

			$i = 0;
			$saved_fonts = explode( '|', self::$_option['std'] );
			
			echo '<div class="hidden" id="cufon-id">' . self::$_option['id'] . '</div>';

			if ( isset( self::$_cufon_fonts ) ) {

	        	echo '<ul id="cufon-list">';
			
				foreach ( self::$_cufon_fonts as $font ) {
					
					if ( $i % 2 == 0 ) 
						$classes = 'odd';
					else 
						$classes = '';
					
					/* Get saved fonts */
					if ( is_array( $saved_fonts ) ) {
						foreach ( $saved_fonts as $save_font ) {
							if ( $save_font == $font['file_name'] ) {
								$classes .= ' selected';
							}
						}
					}
					
					echo '<li class="' . esc_attr( $classes ) . '">';
					echo '<h3 id="cufon-font-' . esc_attr( $i ) . '">' . $font['name'] . '</h3>';
					echo '<div class="hidden cufon-file-name">' . $font['file_name'] . '</div>';
					echo '<div class="hidden cufon-font-name">' . $font['name'] . '</div>';
					echo '</li>';
					$i++;
				}
			
				echo '</ul>';
			}
			echo '<input id="cufon-fonts" type="hidden" name="' . self::$_option['id'] . '" value="' . self::$_option['std'] . '" />';
			echo '<div class="help-box">';
			echo self::$_option['desc'];
			echo '</div>';
			echo '</div>';
			
		}

	}
}