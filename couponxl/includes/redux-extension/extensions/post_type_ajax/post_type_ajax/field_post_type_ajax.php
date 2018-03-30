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
 * @author      Dovy Paukstys
 * @version     3.1.5
 */

// Exit if accessed directly
if( !defined( 'ABSPATH' ) ) exit;

// Don't duplicate me!
if( !class_exists( 'ReduxFramework_post_type_ajax' ) ) {

    /**
     * Main ReduxFramework_post_type_ajax class
     *
     * @since       1.0.0
     */
    class ReduxFramework_post_type_ajax extends ReduxFramework {
    
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
        
            
            $this->parent = $parent;
            $this->field = $field;
            $this->value = $value;

            if ( empty( $this->extension_dir ) ) {
                $this->extension_dir = trailingslashit( str_replace( '\\', '/', dirname( __FILE__ ) ) );
                $this->extension_url = site_url( str_replace( trailingslashit( str_replace( '\\', '/', ABSPATH ) ), '', $this->extension_dir ) );
            }    

            // Set default args for this field to avoid bad indexes. Change this to anything you use.
            $defaults = array(
                'post_type'          => '',
                'multi'             => false,
                'sortable'          => false,
                'additional'        => array()
            );
            $this->field = wp_parse_args( $this->field, $defaults );
            
        
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
            $multi = ( isset( $this->field['multi'] ) && $this->field['multi'] ) ? 'true' : 'false';

            $sortable = ( isset( $this->field['sortable'] ) && $this->field['sortable'] ) ? 'true' : 'false';

            $placeholder = ( isset( $this->field['placeholder'] ) ) ? esc_attr( $this->field['placeholder'] ) : __( 'Select an item', 'redux-framework' );

            if ( ! empty( $this->field['width'] ) ) {
                $width = ' style="' . $this->field['width'] . '"';
            } else {
                $width = ' style="width: 40%;"';
            }

            $selected = array();
            if( !is_array( $this->value ) ){
                $this->value = explode( ',', $this->value );
            }
            if( empty( $this->value ) ){
                $this->value = array();
            }
            if( !empty( $this->value ) ){
                foreach ( $this->value as $value ) {
                    $post = get_post( $value );
                    if( !empty( $post ) ){
                        $selected[] = array(
                            'id' => $post->ID,
                            'text' => $post->post_title
                        );
                    }
                }
            }
            $selected = json_encode( $selected );

            echo '<input data-additional="'.htmlspecialchars( json_encode( $this->field['additional'] ) ).'" data-post_type="'.esc_attr( $this->field['post_type'] ).'" data-multiple="'.$multi.'" data-sortable="'.$sortable.'" type="hidden" value="'.esc_attr( join( ',', $this->value ) ).'" data-placeholder="' . $placeholder . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '" class="redux-select-item post-type-ajax' . $this->field['class'] . '"' . $width . ' rows="6" data-selected="'.esc_html__( $selected ).'"/>';
        }      
    
        /**
         * Enqueue Function.
         *
         * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function enqueue() {

            wp_enqueue_script(
                'redux-field-post-type-ajax', 
                $this->extension_url . 'field_post_type_ajax.js', 
                array( 'jquery' ),
                time(),
                true
            );
        
        }
        
        /**
         * Output Function.
         *
         * Used to enqueue to the front-end
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */        
        public function output() {

            if ( $this->field['enqueue_frontend'] ) {
                
            }
            
        }        
        
    }
}
