<?php
/**
 * Redux Framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * Redux Framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Redux Framework. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     ReduxFramework
 * @subpackage  Field_Color_Gradient
 * @author      Luciano "WebCaos" Ubertini
 * @author      Daniel J Griffiths (Ghost1227)
 * @author      Dovy Paukstys
 * @version     3.0.0
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_nav_color' ) ) {

    /**
     * Main ReduxFramework_link_color class
     *
     * @since       1.0.0
     */
    class ReduxFramework_nav_color extends ReduxFramework {
    
        /**
         * Field Constructor.
         *
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value ='', $parent ) {
        
            parent::__construct( $parent->sections, $parent->args );
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            $defaults = array(
                'regular' => true,
                'hover' => true,
                'bg' => false,
                'bg-hover' => false
            );
            $this->field = wp_parse_args( $this->field, $defaults );

            $defaults = array(
                'regular' => '',
                'hover' => '',
                'bg' => '',
                'bg-hover' => '',
            );

            $this->value = wp_parse_args( $this->value, $defaults );  

            $this->field['default'] = wp_parse_args( $this->field['default'], $defaults );          
        
        }

        /**
         * Field Render Function.
         *
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

            if ( $this->field['regular'] === true && $this->field['default']['regular'] !== false ):
                echo '<span class="linkColor"><strong>' . __( 'Regular', 'mk_framework' ) . '</strong><input id="' . $this->field['id'] . '-regular" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][regular]" value="'.$this->value['regular'].'" class="redux-color redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['regular'] . '" /></span><br>';
            endif;

            if ( $this->field['hover'] === true && $this->field['default']['hover'] !== false ):
                echo '<span class="linkColor"><strong>' . __( 'Hover', 'mk_framework' ) . '</strong><input id="' . $this->field['id'] . '-hover" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][hover]" value="' . $this->value['hover'] . '" class="redux-color redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['hover'] . '" /></span><br>';
            endif;

            if ( $this->field['bg'] === true && $this->field['default']['bg'] !== false ):
                echo '<span class="linkColor"><strong>' . __( 'Background Color', 'mk_framework' ) . '</strong><input id="' . $this->field['id'] . '-bg" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][bg]" value="' . $this->value['bg'] . '" class="redux-color redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['bg'] . '" /></span><br>';
            endif;            

            if ( $this->field['bg-hover'] === true && $this->field['default']['bg-hover'] !== false ):
                echo '<span class="linkColor"><strong>' . __( 'Hover Background Color', 'mk_framework' ) . '</strong><input id="' . $this->field['id'] . '-bg-hover" name="' . $this->args['opt_name'] . '[' . $this->field['id'] . '][bg-hover]" value="' . $this->value['bg-hover'] . '" class="redux-color redux-color-init ' . $this->field['class'] . '"  type="text" data-default-color="' . $this->field['default']['bg-hover'] . '" /></span>';
            endif;
        
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


               wp_enqueue_script(
                    'redux-field-link-color-js',
                    ReduxFramework::$_url . 'inc/fields/link_color/field_link_color' . Redux_Functions::isMin() . '.js',
                    array( 'jquery', 'wp-color-picker', 'redux-js' ),
                    time(),
                    true
                );
            }
    
    }
}
?>
