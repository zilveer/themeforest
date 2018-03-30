<?php

/**
 * Muttley Framework
 *
 * @package     MuttleyPanel
 * @subpackage  sortable_list
 * @author      Mariusz Rek
 * @version     1.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

if ( ! class_exists( 'MuttleyPanel_sortable_list' ) ) {

	class MuttleyPanel_sortable_list extends MuttleyPanel {

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

			echo '<div class="box-row clearfix">';
			
			if ( isset(self::$_option['button_text']) && self::$_option['button_text'] != '' ) {
			    $button_text = self::$_option['button_text'];
			 } else {
			    $button_text = __( 'Add New Item', 'muttleypanel' );
			}
			
			if ( isset( self::$_option['name'] ) && ( self::$_option['name'] != '' ) ) {	
				echo '<label >' . self::$_option['name'] . '</label>';
			}

			echo '<div class="clear"></div>';
			
			/* Hidden items */
			echo '<div class="new-item" style="display:none">';
			echo '<ul>';
			echo '<li>';
			echo '<span class="delete-item"><i class="fa fa-times"></i></span>';
			echo '<span class="drag-item"><i class="fa fa-arrows-alt"></i></span>';
			echo '<div class="content">';
			echo '<input type="hidden" value="" name="' . self::$_option['array_name'] . '_hidden[]"/>';
			foreach ( self::$_option['id'] as $count => $item ) {
			    echo '<label>' . $item['label'] . '</label>';
				echo '<input type="text" value="" name="' . $item['id'] . '[]"/>';
			}
			echo '</div>';
			echo '</li>';
			echo '</ul>';
			echo '</div>';
			
			if ( self::$_option['sortable'] == true ) 
				$sort = 'sortable';
			else 
				$sort = '';

			if ( isset( self::$_saved_options[self::$_option['array_name']] ) && is_array( self::$_saved_options[self::$_option['array_name']] ) )
			  $list_class = self::$_option['array_name'];
			else 
			  $list_class = '';

			echo '<ul class="sortable-list ' . $list_class . ' ' . $sort .'">';
				
			if ( isset( self::$_saved_options[self::$_option['array_name']] ) && is_array( self::$_saved_options[self::$_option['array_name']] ) ) {
				foreach ( self::$_saved_options[self::$_option['array_name']] as $items ) {
					echo '<li>';
					echo '<span class="delete-item"><i class="fa fa-times"></i></span>';
					echo '<span class="drag-item"><i class="fa fa-arrows-alt"></i></span>';
					echo '<div class="content">';
					echo '<input type="hidden" value="" name="' . self::$_option['array_name'] . '_hidden[]"/>';
					foreach ( self::$_option['id'] as $count => $item ) {
						echo '<label>' . $item['label'] . '</label>';
						if ( isset( $items[$item['name']] ) ) {
						    echo '<input type="text" class="input" value="' . htmlentities($items[$item['name']]) . '" name="' . $item['id'] . '[]"/>';
						} else {
						    echo '<input type="text" class="input" value="" name="' . $item['id'] . '[]"/>';
						}
					}
					echo '</div>';
					echo '</li>';
				}
			}
			echo '</ul>';
	        echo '<div class="clear"></div>';
			echo '<button class="_button add-new-item"><i class="icon fa-plus"></i>' . $button_text . '</button>';
			echo '<div class="help-box">';
			$this->e_esc( self::$_option['desc'] );
			echo '</div>';
			echo '</div>';

		}

	}
}