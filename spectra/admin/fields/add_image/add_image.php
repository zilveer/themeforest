<?php

/**
 * Muttley Framework
 *
 * @package     MuttleyPanel
 * @subpackage  add_image
 * @author      Mariusz Rek
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MuttleyPanel_add_image' ) ) {

	class MuttleyPanel_add_image extends MuttleyPanel {

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

	            // Ajax
	            add_action( 'wp_ajax_muttleypanel_thumbnail', array( &$this, 'muttleypanel_thumbnail' ) );
	        	
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
			
			// Set button title
			if ( isset( self::$_option['button_title'] ) && self::$_option['button_title'] ) { 
				$button_title = self::$_option['button_title'];
			} else { 
			 	$button_title = __( 'Add File', 'muttleypanel' );
			}

			// ID
			if ( isset( self::$_option['by_id'] ) && self::$_option['by_id'] == true ) { 
				$by_id = true;
				$input_type = 'hidden';
				$get_url = 'false';
			} else { 
			 	$by_id = false;
			 	$input_type = 'text';
			 	$get_url = 'true';
			}

			// Set message
			if ( isset( self::$_option['msg'] ) && self::$_option['msg'] ) { 
				$msg = self::$_option['msg'];
			} else { 
			 	$msg = __( 'Currently you don\'t have images, you can add them by clicking on the button below.', 'muttleypanel' );
			}

			if ( ! isset( self::$_option['std'] ) || self::$_option['std'] == '' ) {
				$display = 'block';
				$del_display = 'none';
			} else {
				$del_display = 'inline-block';
				$display = 'none';
			}

			echo '<div class="box-row clearfix">';
			if ( isset( self::$_option['name'] ) && ( self::$_option['name'] != '' ) ) {	
				echo '<label>' . self::$_option['name'] . '</label>';
			}

			// Input
			echo '<input type="' . $input_type . '" value="' . self::$_option['std'] . '" id="' . self::$_option['id'] . '" name="' . self::$_option['id'] . '" class="image-input"/>';
			echo '<div class="image-holder" data-width="' . self::$_option['width'] . '" data-height="' . self::$_option['height'] . '" data-crop="' . self::$_option['crop'] . '" data-get_url="' . $get_url . '">';

			/* Image preview */
			if ( isset( self::$_option['std'] ) && self::$_option['std'] != '' ) {

					// By ID
					if ( $by_id ) {

						// Get image data
						$image = wp_get_attachment_image_src( self::$_option['std'], 'thumbnail' );
						$image = $image[0];

					} else {
						// If image is in WP database
						if ( $this->get_image_by_url( self::$_option['std'] ) ) {
							$image = $this->get_image_by_url( self::$_option['std'] );
						} else {
							$image = $this->get_image( self::$_option['std'] );
						}
					}

					// If image exists
					if ( $image ) {
						echo '<img src="' . $image . '" alt="' . __( 'Preview Image', 'muttleypanel' ) . '">';
					} else {
						$display = 'block';
						$del_display = 'none';
					}

			}
			echo '</div>';

			// Message
			echo '<div class="msg-dotted" style="display:' . $display . '">' . $msg . '</div>';

			echo '<p class="msg msg-error" style="display:none">' . __( 'The link is incorrect or the image does not exist.', 'muttleypanel' ) . '</p>';
				
			// Button
			echo '<button class="_button upload-image" style="display:' . $display . '"><i class="fa icon fa-plus"></i>' . $button_title . '</button>';

			echo '<button class="_button ui-button-delete delete-image" style="display:' . $del_display . '"><i class="fa icon fa-trash-o"></i>' . __( 'Remove', 'muttleypanel' ) . '</button>';

			// Ajax loader
			echo '<img class="ajax-loader" src="' . esc_url(admin_url('images/wpspin_light.gif')) . '" alt="Loading..." style="display:none" />';
			

			echo '<div class="help-box">';
			$this->e_esc( self::$_option['desc'] );
			echo '</div>';
			echo '</div>';

		}

		/* Thumb Generator */
		function muttleypanel_thumbnail() {

			$id = $_POST['id'];
			$width = $_POST['width'];
			$height = $_POST['height'];
			$crop = $_POST['crop'];
			
			// Check image exists
			$img = $this->get_image($id);
			
			// If icon
		   	if ( strpos( $img, ".ico" ) !== false ) {
		   		$this->e_esc( $img );
		   		exit();
		   	}

			if ( $img ) {

				// If image is in WP database
				if ( $this->get_image_by_url( $img) ) {
					$this->e_esc( $this->get_image_by_url( $img ) );
				} else {
					$this->e_esc( $img );
				}
			} else {
				echo 'error';
			}

			exit;
		}

	}
}