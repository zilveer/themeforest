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
if( !class_exists( 'ReduxFramework_social_profiles' ) ) {

    /**
     * Main ReduxFramework_custom_field class
     *
     * @since       1.0.0
     */
    class ReduxFramework_social_profiles extends ReduxFramework {
    
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

            $default_val = array(
                'ids' => '',
                'socials' => ''
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
            global $socialIcons;
            // global $redux;
            // HTML output goes here
            $output = '';
            // $output .= '<div class="input-wrapper social-field-wrapper">';
            //     $output .= '<label for="social_title" class="redux-text-label">'. __( 'Social profile title', 'BERG' ) .'</label>';
            //     $output .= '<input type="text" id="social-title" name="" class="regular-text" value="" />';
            // $output .= '</div>';

            // $output .= '<div class="input-wrapper social-field-wrapper">';
            //     $output .= '<label for="social_link" class="redux-text-label">'. __( 'Social profile URL link', 'BERG' ) .'</label>';
            //     $output .= '<input type="text" id="social-link" name="" class="regular-text" value="" />';
            // $output .= '</div>';

            $output .= '<div class="input-wrapper social-field-wrapper">';
                // $output .= '<label for="icon-manager-select" class="redux-text-label">'. __( 'Select icon manager', 'BERG' ) .'</label>';
                $output .= '<select id="icon-manager-select" style="margin-bottom: 20px;">';
                    $output .= '<option value="iconpicker" selected="selected">'. __( 'Icon picker', 'BERG' ) .'</option>';
                    $output .= '<option value="uploder">'. __( 'Image uploader', 'BERG' ) .'</option>';
                $output .= '</select>';
                $output .= '<div class="iconpicker">';
                    // $output .= '<i id="pick-icon" class="el el-plus"></i>';
                    $output .= '<a id="pick-icon" href="javascript:void(0);" class="button-secondary">'. __( 'Select icon', 'BERG' ) .'</a>';
                    $output .= '<span class="icon-prev"><i class="monoadmin monosymbol"></i></span>';
                    $output .= '<input type="hidden" value="" id="icon-content" name=""/>';
                    $output .= '<ul class="icon-set-container">';

                    foreach ($socialIcons as $value) {
                        foreach($value as $key => $icon) {

                            $output .= '<li><i class="'.$key.'"></i></li>';
                        }
                    }
                    $output .= '</ul>';
                $output .= '</div>';
                $output .= '<div class="input-wrapper social-field-wrapper icon-image-manager social-hidden" style="display: table-cell">';
                    $output .= '<div class="img-prev">';
                    $output .= '</div>';
                    $output .= '<input type="hidden" id="icon-img-url" value="" name=""/>';
                    $output .= '<div class="image-upload-controls">';
                        $output .= '<a href="javascript:void(0);" id="add-image" class="button-secondary">'. __( 'Upload Icon Image', 'BERG' ) .'</a>';
                        $output .= '<a href="javascript:void(0);" id="remove-image" class="button-secondary social-hidden">'. __( 'Remove', 'BERG' ) .'</a>';
                    $output .= '</div>';
                $output .= '</div>';
            $output .= '</div>';
            $output .= '<a href="javascript:void(0);" id="add-new-social-profile" class="button-secondary">'. __( 'Add social', 'BERG' ) .'</a>';

            $output .= '<div class="input-wrapper social-list-container" id="social-list">';
                $output .= '<ul class="ui-sortable" id="social-items-sorting">';

                    if ( !empty($this->value['ids']) && !empty($this->value['socials']) ) {
                        $socialsProf = array();
                        $ids_order = explode(',', $this->value['ids']);
                        $socialsArr = explode('|', $this->value['socials']);

                        foreach ( $socialsArr as $socialStr ) {
                            foreach ( json_decode($socialStr, true) as $id => $data ) {
                                $socialsProf[$id] = $data[0];
                            }
                        }

                        foreach ($ids_order as $id_order ) {
                            $output .= '<li class="social-item" id="'. $id_order .'">';
                                $output .= '<div class="social-item-wrapper">';
                                        $output .= '<div class="soc-content">';
                                            $output .= '<div class="icon-wrapper pull-left">';
                                            if ( filter_var( $socialsProf[$id_order]['icon'], FILTER_VALIDATE_URL ) ) {
                                                $output .= '<img class="soc-icon-img" src="'. $socialsProf[$id_order]['icon'] .'">';
                                            } else {
                                                $output .= '<i class="'. $socialsProf[$id_order]['icon'].'"></i>';
                                            }
                                            $output .= '</div>';
                                            $output .= '<span class="social-title"> '. $socialsProf[$id_order]['title'] .'</span>';
                                        $output .= '</div>';
                                    $output .= '<p class="link-url"><span>URL: </span>'. $socialsProf[$id_order]['link'] .'</p>';
                                    $output .= '<a href="javascript:void(0);" data-id="'. $id_order .'" class="button-secondary remove-social-item pull-right">'. __( 'Remove item', 'BERG' ) .'</a>';
                                $output .= '</div>';
                            $output .= '</li>';
                        }
                    }

                $output .= '</ul>';
                $output .= '<input type="hidden" value="'. $this->value['ids'] .'" id="'. $this->field['id'] .'" name="'. $this->field['name'] .$this->field['name_suffix'].'[ids]"/>';
                $output .= '<input type="hidden" value="'. htmlspecialchars($this->value['socials']) .'" id="socials-string" name="'. $this->field['name'] .$this->field['name_suffix'].'[socials]" />';
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

            $extension = ReduxFramework_extension_social_profiles::getInstance();
            
            wp_enqueue_script('jquery-ui-sortable');

            wp_enqueue_script(
                'redux-field-socials-js', 
                $this->extension_url . 'field_social_profiles.js', 
                array( 'jquery' ),
                time(),
                true
            );

            $button_name = array(
                'btn_name' => __( 'Remove item', 'BERG' )
            );

            wp_localize_script('redux-field-socials-js', 'php_data', $button_name );

            wp_enqueue_style(
                'redux-field-socials-css', 
                $this->extension_url . 'field_social_profiles.css',
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
