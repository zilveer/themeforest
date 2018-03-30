<?php

/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Color
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_font_size' ) ) {

    /**
     * Main ReduxFramework_color class
     *
     * @since       1.0.0
     */
    class ReduxFramework_font_size {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since         1.0.0
         * @access        public
         * @return        void
         */
        function __construct( $field = array(), $value = '', $parent ) {

            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;

			if ( empty( $this->extension_dir ) ) {
				$this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
				$this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
			}    

			// Set default args for this field to avoid bad indexes. Change this to anything you use.
			$defaults = array(
				'stylesheet'        => '',
				'output'            => true,
				'enqueue'           => true,
				'enqueue_frontend'  => true,
				'style'				=> '',
			);
			$this->field = wp_parse_args( $this->field, $defaults );            

        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since         1.0.0
         * @access        public
         * @return        void
         */
        public function render() {
        	if(!isset($this->value['size'])) {
        		$this->value['size'] = '';
        	}
        	$unit = 'px';

            echo '<div class="input-append"><input class="span2 redux-typography redux-typography-size mini typography-input" data-id="' . $this->field['id'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[size]" id="' . $this->field['id'] . '-font_size" class="redux-font_size redux-font_size-init ' . $this->field['class'] . '"  type="text" value="' . $this->value['size'] . '"  /><span class="add-on">' . $unit . '</span></div>';
        }

        /**
         * Enqueue Function.
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since         1.0.0
         * @access        public
         * @return        void
         */
        public function enqueue() {
        	$extension = ReduxFramework_extension_font_size::getInstance();
        }

        public function output() {
            if ( isset($this->value['size']) && ! empty( $this->value['size'] ) ) {

                if ( ! empty( $this->field['output'] ) && is_array( $this->field['output'] ) ) {
                    $keys = implode( ",", $this->field['output'] );
                    $this->parent->outputCSS .= $keys . "{ font-size:".$this->value['size']."px}";
                }

            }
        }
    }
}
