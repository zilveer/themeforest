<?php

    if ( ! defined( 'ABSPATH' ) ) {
        exit;
    }

    if ( ! class_exists( 'ReduxFramework_thumbnail_size' ) ) {
        class ReduxFramework_thumbnail_size {

            /**
             * Field Constructor.
             * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
             *
             * @since ReduxFramework 1.0.0
             */
            function __construct( $field = array(), $value = '', $parent ) {
                $this->parent = $parent;
                $this->field  = $field;
                $this->value  = $value;
            } //function

            /**
             * Field Render Function.
             * Takes the vars and outputs the HTML for the field in the settings
             *
             * @since ReduxFramework 1.0.0
             */
            function render() {

                /*
                 * So, in_array() wasn't doing it's job for checking a passed array for a proper value.
                 * It's wonky.  It only wants to check the keys against our array of acceptable values, and not the key's
                 * value.  So we'll use this instead.  Fortunately, a single no array value can be passed and it won't
                 * take a dump.
                 */

                // No errors please
                $defaults = array(
                    'width'             => true,
                    'height'            => true,
                    'hard_crop'         => true,
                    // 'units'          => 'px',
                    // 'mode'           => array(
                    //     'width'  => false,
                    //     'height' => false,
                    // ),
                );
                // width 
                // height 
                // hard_crop 
                // class 

                $this->field = wp_parse_args( $this->field, $defaults );

                $defaults = array(
                    'width'  => '',
                    'height' => '',
                    'hard_crop'  => false
                );

                $this->value = wp_parse_args( $this->value, $defaults );

                // if ( isset( $this->value['unit'] ) ) {
                //     $this->value['units'] = $this->value['unit'];
                // }

                /*
                 * Acceptable values checks.  If the passed variable doesn't pass muster, we unset them
                 * and reset them with default values to avoid errors.
                 */

                // If units field has a value but is not an acceptable value, unset the variable
                // if ( isset( $this->field['units'] ) && ! Redux_Helpers::array_in_array( $this->field['units'], array(
                //         '',
                //         false,
                //         '%',
                //         'in',
                //         'cm',
                //         'mm',
                //         'em',
                //         'ex',
                //         'pt',
                //         'pc',
                //         'px',
                //         'rem'
                //     ) )
                // ) {
                //     unset( $this->field['units'] );
                // }

                //if there is a default unit value  but is not an accepted value, unset the variable
                // if ( isset( $this->value['units'] ) && ! Redux_Helpers::array_in_array( $this->value['units'], array(
                //         '',
                //         '%',
                //         'in',
                //         'cm',
                //         'mm',
                //         'em',
                //         'ex',
                //         'pt',
                //         'pc',
                //         'px'
                //     ) )
                // ) {
                //     unset( $this->value['units'] );
                // }

                /*
                 * Since units field could be an array, string value or bool (to hide the unit field)
                 * we need to separate our functions to avoid those nasty PHP index notices!
                 */

                // if field units has a value and IS an array, then evaluate as needed.
                /*if ( isset( $this->field['units'] ) && ! is_array( $this->field['units'] ) ) {

                    //if units fields has a value but units value does not then make units value the field value
                    if ( isset( $this->field['units'] ) && ! isset( $this->value['units'] ) || $this->field['units'] == false ) {
                        $this->value['units'] = $this->field['units'];

                        // If units field does NOT have a value and units value does NOT have a value, set both to blank (default?)
                    } else if ( ! isset( $this->field['units'] ) && ! isset( $this->value['units'] ) ) {
                        $this->field['units'] = 'px';
                        $this->value['units'] = 'px';

                        // If units field has NO value but units value does, then set unit field to value field
                    } else if ( ! isset( $this->field['units'] ) && isset( $this->value['units'] ) ) {
                        $this->field['units'] = $this->value['units'];

                        // if unit value is set and unit value doesn't equal unit field (coz who knows why)
                        // then set unit value to unit field
                    } elseif ( isset( $this->value['units'] ) && $this->value['units'] !== $this->field['units'] ) {
                        $this->value['units'] = $this->field['units'];
                    }

                    // do stuff based on unit field NOT set as an array
                } elseif ( isset( $this->field['units'] ) && is_array( $this->field['units'] ) ) {
                    // nothing to do here, but I'm leaving the construct just in case I have to debug this again.
                }*/

                echo '<fieldset id="' . $this->field['id'] . '" class="redux-thumbnail-size-container" data-id="' . $this->field['id'] . '">';

                // if ( isset( $this->field['select2'] ) ) { // if there are any let's pass them to js
                //     $select2_params = json_encode( $this->field['select2'] );
                //     $select2_params = htmlspecialchars( $select2_params, ENT_QUOTES );

                //     echo '<input type="hidden" class="select2_params" value="' . $select2_params . '">';
                // }


                // This used to be unit field, but was giving the PHP index error when it was an array,
                // so I changed it.
                // echo '<input type="hidden" class="field-units" value="' . $this->value['units'] . '">';

                /**
                 * Width
                 * */
                if ( $this->field['width'] === true ) {
                    if ( ! empty( $this->value['width'] ) ) {
                        $this->value['width'] = filter_var( $this->value['width'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
                    }
                    echo '<div class="field-thumbnail-size-input input-prepend">';
                    echo '<span class="add-on"><i class="el el-resize-horizontal icon-large"></i></span>';
                    // echo '<input type="text" class="redux-thumbnail-size-input redux-thumbnail-size-width mini ' . $this->field['class'] . '" placeholder="' . esc_html__( 'Width', 'outdoor' ) . '" rel="' . $this->field['id'] . '-width" value="' . filter_var( $this->value['width'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) . '">';
                    echo '<label for="' . $this->field['id'] . '-width">' . esc_html__( 'Width ', 'outdoor' ) . '</label>';
                    echo '<input type="text" id="' . $this->field['id'] . '-width" placeholder="' . esc_html__( 'Width', 'outdoor' ) . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[width]' . '" value="' . $this->value['width'] . '"></div>';
                }

                echo '<div class="field-thumbnail-size-input input-prepend"><span  class="ts-add-on"> x </span></div>';

                /**
                 * Height
                 * */
                if ( $this->field['height'] === true ) {
                    if ( ! empty( $this->value['height'] ) ) {
                        $this->value['height'] = filter_var( $this->value['height'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
                        
                    }
                    echo '<div class="field-thumbnail-size-input input-prepend">';
                    echo '<span class="add-on"><i class="el el-resize-vertical icon-large"></i></span>';
                    // echo '<input type="text" class="redux-thumbnail-size-input redux-thumbnail-size-height mini ' . $this->field['class'] . '" placeholder="' . esc_html__( 'Height', 'outdoor' ) . '" rel="' . $this->field['id'] . '-height" value="' . filter_var( $this->value['height'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) . '">';
                    echo '<label for="' . $this->field['id'] . '-height">' . esc_html__( 'Height ', 'outdoor' ) . '</label>';
                    echo '<input type="text" id="' . $this->field['id'] . '-height" placeholder="' . esc_html__( 'Height', 'outdoor' ) . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[height]' . '" value="' . $this->value['height'] . '"></div>';
                }

                echo '<div class="field-thumbnail-size-input input-prepend"><span class="ts-add-on"> px </span></div>';

                /**
                 * Hard_Crop
                 * */
                if ( $this->field['hard_crop'] === true ) {
                    // if ( ! empty( $this->value['hard_crop'] ) ) {
                    //     $this->value['hard_crop'] = filter_var( $this->value['hard_crop'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION );
                        
                    // }
                    echo '<div class="field-thumbnail-size-input input-hard_crop">';
                    // echo '<span class="add-on"><i class="el el-resize-vertical icon-large"></i></span>';
                    // echo '<input type="text" class="redux-thumbnail-size-input redux-thumbnail-size-hard_crop mini ' . $this->field['class'] . '" placeholder="' . esc_html__( 'Height', 'outdoor' ) . '" rel="' . $this->field['id'] . '-hard_crop" value="' . filter_var( $this->value['hard_crop'], FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION ) . '">';
                    echo '<label for="' . $this->field['id'] . '-hard_crop">';
                    echo '<input type="checkbox" id="' . $this->field['id'] . '-hard_crop" name="' . $this->field['name'] . $this->field['name_suffix'] . '[hard_crop]' . '" value="1"';
                    if(isset($this->value['hard_crop']) && $this->value['hard_crop'] == 1){
                        echo ' checked="checked"';
                    }

                    echo  '>'.esc_html__( 'Hard Crop ', 'outdoor' ) . '</label>';
                    
                    echo '</div>';
                }

                /**
                 * Units
                 * */
                // If units field is set and units field NOT false then
                // fill out the options object and show it, otherwise it's hidden
                // and the default units value will apply.
                // if ( isset( $this->field['units'] ) && $this->field['units'] !== false ) {
                //     echo '<div class="select_wrapper dimensions-units" original-title="' . __( 'Units', 'redux-framework' ) . '">';
                //     echo '<select data-id="' . $this->field['id'] . '" data-placeholder="' . __( 'Units', 'redux-framework' ) . '" class="redux-dimensions redux-dimensions-units select ' . $this->field['class'] . '" original-title="' . __( 'Units', 'redux-framework' ) . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[units]' . '">';

                //     //  Extended units, show 'em all
                //     if ( $this->field['units_extended'] ) {
                //         $testUnits = array( 'px', 'em', 'rem', '%', 'in', 'cm', 'mm', 'ex', 'pt', 'pc' );
                //     } else {
                //         $testUnits = array( 'px', 'em', 'rem', '%' );
                //     }

                //     if ( $this->field['units'] != "" && is_array( $this->field['units'] ) ) {
                //         $testUnits = $this->field['units'];
                //     }

                //     if ( in_array( $this->field['units'], $testUnits ) ) {
                //         echo '<option value="' . $this->field['units'] . '" selected="selected">' . $this->field['units'] . '</option>';
                //     } else {
                //         foreach ( $testUnits as $aUnit ) {
                //             echo '<option value="' . $aUnit . '" ' . selected( $this->value['units'], $aUnit, false ) . '>' . $aUnit . '</option>';
                //         }
                //     }
                //     echo '</select></div>';
                // };
                echo "</fieldset>";
            } //function

            /**
             * Enqueue Function.
             * If this field requires any scripts, or css define this function and register/enqueue the scripts/css
             *
             * @since ReduxFramework 1.0.0
             */
            function enqueue() {
                wp_enqueue_style( 'redux-add-fields' , get_template_directory_uri() . '/includes/redux_add_fields/redux-add-fields.css');

                // wp_enqueue_script(
                //     'redux-field-dimensions-js',
                //     ReduxFramework::$_url . 'inc/fields/dimensions/field_dimensions' . Redux_Functions::isMin() . '.js',
                //     array( 'jquery', 'select2-js', 'redux-js' ),
                //     time(),
                //     true
                // );

                // if ( $this->parent->args['dev_mode'] ) {
                //     wp_enqueue_style(
                //         'redux-field-dimensions-css',
                //         ReduxFramework::$_url . 'inc/fields/dimensions/field_dimensions.css',
                //         array(),
                //         time(),
                //         'all'
                //     );
                // }
            } //function

            

            
        } //class
    }


