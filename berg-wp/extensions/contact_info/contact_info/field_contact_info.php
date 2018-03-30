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
if( !class_exists( 'ReduxFramework_contact_info' ) ) {

    /**
     * Main ReduxFramework_custom_field class
     *
     * @since       1.0.0
     */
    class ReduxFramework_contact_info extends ReduxFramework {
    
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
                'enqueue_frontend'  => true,
            );
            $this->field = wp_parse_args( $this->field, $defaults );  

            $default_val = array(
                'ids' => '',
                'contact' => ''
            );

            $this->value = wp_parse_args( $this->value, $default_val);          
            
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
            // global $socialIcons;
            global $redux;
            // HTML output goes here

            $output = '';
         
            $output .= '<div class="button-contact"><a href="javascript:void(0);" id="add-new-contact-info" class="button-add button button-primary">'. __( 'Add contact info', 'BERG' ) .'</a></div></fieldset></td></tr>';

            $output .= '<tr class="contact-list-field"><th scope="row"><div class="redux_field_th">'.__('Your contact info', 'BERG').'</div></th><td><div class="input-wrapper contact-list-container" id="contact-list">';
                $output .= '<ul class="ui-sortable" id="contact-items-sorting">';
                    if ( !empty($this->value['ids']) && !empty($this->value['contact']) ) {
                        $contactMember = array();
                        $ids_order = explode(',', $this->value['ids']);
                        $contactArr = explode('|x;|', $this->value['contact']);

                        foreach ( $contactArr as $contactStr ) {
                            foreach ( json_decode($contactStr, true) as $id => $data ) {
                                $contactMember[$id] = $data[0];
                            }
                        }

                        foreach ($ids_order as $id_order ) {
                            $output .= '<li class="contact-item" id="'. $id_order .'">';
                                $output .= '<div class="contact-item-wrapper">';
                                        // $output .= '<div class="contact-content">';
                                            // $output .= '<div class="icon-wrapper pull-left">';
                                            // if ( filter_var( $contactMember[$id_order]['icon'], FILTER_VALIDATE_URL ) ) {
                                            //     $output .= '<img class="soc-icon-img" src="'. $contactMember[$id_order]['icon'] .'">';
                                            // } else {
                                            //     $output .= '<i class="'. $contactMember[$id_order]['icon'].'"></i>';
                                            // }
                                            // $output .= '</div>';
                                            $output .= '<p class="contact-name"><span>'.__('Name', 'BERG').': </span>'. $contactMember[$id_order]['name'] .'</p>';
                                        // $output .= '</div>';
                                             $output .= '<div class="contact-desc"><span>'.__('Info', 'BERG').': </span>'. $contactMember[$id_order]['desc'] .'</div>';
                                $output .= '</div>';
                                $output .= '<a href="javascript:void(0);" data-id="'. $id_order .'" class="button button-secondary button-remove-contact remove-contact-item pull-right">'. __( 'Remove item', 'BERG' ) .'</a>';
                                
                            $output .= '</li>';
                        }
                    }

                $output .= '</ul>';
                $output .= '<input type="hidden" value="'. $this->value['ids'] .'" id="'. $this->field['id'] .'" name="'. $this->field['name'] .$this->field['name_suffix'].'[ids]"/>';
                $output .= '<input type="hidden" value="'. htmlspecialchars($this->value['contact']) .'" id="contact-string" name="'. $this->field['name'] .$this->field['name_suffix'].'[contact]" />';
            $output .= '</div>';
            
            echo $output;
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

            $extension = ReduxFramework_extension_contact_info::getInstance();
            
            wp_enqueue_script('jquery-ui-sortable');

            wp_enqueue_script(
                'redux-field-contact-js', 
                $this->extension_url . 'field_contact_info.js', 
                array( 'jquery' ),
                time(),
                true
            );

            $button_name = array(
                'btn_name' => __( 'Remove item', 'BERG' )
            );

            wp_localize_script('redux-field-contact-js', 'php_data', $button_name );

            wp_enqueue_style(
                'redux-field-contact-css', 
                $this->extension_url . 'field_contact_info.css',
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
