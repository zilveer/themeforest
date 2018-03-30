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
if( !class_exists( 'ReduxFramework_portfolio_custom_field' ) ) {

    /**
     * Main ReduxFramework_custom_field class
     *
     * @since       1.0.0
     */
    class ReduxFramework_portfolio_custom_field extends ReduxFramework {
    
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
                'options'           => array(),
                'stylesheet'        => '',
                'output'            => true,
                'enqueue'           => true,
                'enqueue_frontend'  => true
            );
            $this->field = wp_parse_args( $this->field, $defaults );    

            $def_keys = array();
           
            $this->value = wp_parse_args( $this->value, $def_keys );        
        
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

            $content = '';
            $settings = array(
                'media_buttons' => false,
                'teeny'         => true,
                'textarea_rows' => 6,
                'quicktags'     => false,
                'tinymce'      => array(
                    'toolbar1' => 'bold,italic,strikethrough,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,unlink'
                ),
            );

            // HTML output goes here
            echo '<ul class="portfolio-field-list">';
            $arr_size = count($this->value);
            if ( !empty($this->value) ) {
                foreach ( $this->value as $key => $value ) {
                    
                    $settings['textarea_name'] = $this->field['name'] .'['. $key .'][content]';
                    $content = $value['content'];

                    echo '<li class="portfolio-custom-field-wrapper" data-id="'. $key .'">';
                        echo '<div class="input-wrapper custom-field-input-wrapper">';
                            echo '<label class="redux-text-label" for="'. $this->field['id'] .'_header_'. $key .'">'. __( 'Insert header:', 'BERG' ) .'</label>';
                            echo '<input type="text" id="'. $this->field['id'] .'_header_'. $key .'" name="'. $this->field['name'].'['. $key .'][header]" class="regular-text" value="'. $value['header'] .'" />';
                        echo '</div>';
                        echo '<div class="input-wrapper custom-field-input-wrapper">';
                            echo '<label class="redux-text-label" for="'. $this->field['id'] .'_content_'. $key .'">'. __( 'Insert content:', 'BERG' ) .'</label>';
                            wp_editor( $content, $this->field['id']. '_content_'. $key , $settings );
                        echo '</div>';
                        if ( $arr_size > 1 ) {
                            echo '<a href="javascript:void(0);" id="'. $key .'" class="button-secondary remove-custom-field">'. __( 'remove', 'BERG' ) .'</a>';
                        }
                    echo '</li>';
                }
            } else {

                $settings['textarea_name'] = $this->field['name'] .'[0][content]';

                echo '<li class="portfolio-custom-field-wrapper" data-id="0">';
                    echo '<div class="input-wrapper custom-field-input-wrapper">';
                        echo '<label class="redux-text-label" for="'. $this->field['id'] .'_header_0">'. __( 'Insert header:', 'BERG' ) .'</label>';
                        echo '<input type="text" id="'. $this->field['id'] .'_header_0" name="'. $this->field['name'].'[0][header]" class="regular-text" value="" />';
                    echo '</div>';
                    echo '<div class="input-wrapper custom-field-input-wrapper">';
                        echo '<label class="redux-text-label" for="'. $this->field['id'] .'_content_0">'. __( 'Insert content:', 'BERG' ) .'</label>';
                        wp_editor( $content, $this->field['id']. '_content_0', $settings );
                    echo '</div>';
                echo '</li>';
            }
            
            echo '</ul>';
            echo '<a href="javascript:void(0);" id="add-text" class="button-primary">'. __( 'Add more', 'BERG' ) .'</a>';

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

            $extension = ReduxFramework_extension_portfolio_custom_field::getInstance();
        
            wp_enqueue_script(
                'redux-portfolio-custom-field-js', 
                $this->extension_url . 'field_custom_field.js', 
                array( 'jquery' ),
                time(),
                true
            );

            $arr_data = array(
                'label_input' => __( 'Insert header:', 'BERG' ),
                'label_textarea' => __( 'Insert content:', 'BERG' ),
                'button_remove' => __( 'remove', 'BERG' )
            );

            wp_localize_script('redux-portfolio-custom-field-js', 'data_strings', $arr_data);

            wp_enqueue_style(
                'redux-field-icon-select-css', 
                $this->extension_url . 'field_custom_field.css',
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
