<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Don't duplicate me!
if ( ! class_exists( 'ReduxFramework_upload' ) ) {

    /**
     * Main ReduxFramework_media class
     *
     * @since       1.0.0
     */
    class ReduxFramework_upload {

        /**
         * Field Constructor.
         * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct( $field = array(), $value = '', $parent ) {
            $this->parent = $parent;
            $this->field  = $field;
            $this->value  = $value;
        }

        /**
         * Field Render Function.
         * Takes the vars and outputs the HTML for the field in the settings
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        public function render() {

            // No errors please
            $defaults = array(
                'id'        => '',
                'url'       => ''
            );

            $this->value = wp_parse_args( $this->value, $defaults );

            if (isset($this->field['mode']) && $this->field['mode'] == false) {
                $this->field['mode'] = 0;
            }

            if ( ! isset( $this->field['mode'] ) ) {
                $this->field['mode'] = "image";
            }

            if (!isset($this->field['library_filter'])) {
                $libFilter = '';
            } else {
                if (!is_array($this->field['library_filter'])) {
                    $this->field['library_filter'] = array($this->field['library_filter']);
                }

                $mimeTypes = get_allowed_mime_types();

                $libArray = $this->field['library_filter'];

                $jsonArr = array();

                // Enum mime types
                foreach ($mimeTypes as $ext => $type) {
                    if (strpos($ext,'|')) {
                        $expArr = explode('|', $ext);

                        foreach($expArr as $ext){
                            if (in_array($ext, $libArray )) {
                                $jsonArr[$ext] = $type;
                            }
                        }
                    } elseif (in_array($ext, $libArray )) {
                        $jsonArr[$ext] = $type;
                    }

                }

                $libFilter = urlencode(json_encode($jsonArr));
            }

            if ( empty( $this->value ) && ! empty( $this->field['default'] ) ) { // If there are standard values and value is empty
                if ( is_array( $this->field['default'] ) ) {
                    if ( ! empty( $this->field['default']['id'] ) ) {
                        $this->value['id'] = $this->field['default']['id'];
                    }

                    if ( ! empty( $this->field['default']['url'] ) ) {
                        $this->value['url'] = $this->field['default']['url'];
                    }
                } else {
                    if ( is_numeric( $this->field['default'] ) ) { // Check if it's an attachment ID
                        $this->value['id'] = $this->field['default'];
                    } else { // Must be a URL
                        $this->value['url'] = $this->field['default'];
                    }
                }
            }


            if ( empty( $this->value['url'] ) && ! empty( $this->value['id'] ) ) {
                $this->value['url']                    =  wp_get_attachment_url( $this->value['id']);
            }

            $hide = 'hide ';

            if ( ( ! empty( $this->field['url'] ) && $this->field['url'] === true ) ) {
                $hide = '';
            }

            $placeholder = isset( $this->field['placeholder'] ) ? $this->field['placeholder'] : esc_html__( 'No file selected', 'redux-framework' );

            $readOnly = ' readonly="readonly"';
            if ( isset( $this->field['readonly'] ) && $this->field['readonly'] === false ) {
                $readOnly = '';
            }

            echo '<input placeholder="' . $placeholder . '" type="text" class="' . $hide . 'upload regular-text ' . $this->field['class'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[url]" id="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][url]" value="' . $this->value['url'] . '"' . $readOnly . '/>';
            echo '<input type="hidden" class="data" data-mode="' . $this->field['mode'] . '" />';
            echo '<input type="hidden" class="library-filter" data-lib-filter="' . $libFilter . '" />';
            echo '<input type="hidden" class="upload-id ' . $this->field['class'] . '" name="' . $this->field['name'] . $this->field['name_suffix'] . '[id]" id="' . $this->parent->args['opt_name'] . '[' . $this->field['id'] . '][id]" value="' . $this->value['id'] . '" />';

            //Preview
            $hide = '';

            if ( empty( $this->value['url'] ) ) {
                $hide = 'hide ';
            }

            //Upload controls DIV
            echo '<div class="upload_button_div">';

            //If the user has WP3.5+ show upload/remove button
            echo '<span class="button upload_upload_button" id="' . $this->field['id'] . '-upload">' . esc_html__( 'Upload', 'redux-framework' ) . '</span>';

            $hide = '';
            if ( empty( $this->value['url'] ) || $this->value['url'] == '' ) {
                $hide = ' hide';
            }

            echo '<span class="button remove-image' . $hide . '" id="reset_' . $this->field['id'] . '" rel="' . $this->field['id'] . '">' . esc_html__( 'Remove', 'redux-framework' ) . '</span>';

            echo '</div>';
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
            if ( function_exists( 'wp_enqueue_media' ) ) {
                wp_enqueue_media();
            } else {
                wp_enqueue_script( 'media-upload' );
            }

            wp_enqueue_script(
                'redux-field-upload-js',
                ReduxFramework::$_url . 'inc/fields/upload/field_upload.js',
                array( 'jquery', 'redux-js' ),
                time(),
                true
            );

            if ($this->parent->args['dev_mode']) {
                wp_enqueue_style('redux-field-media-css');
            }
        }
    }
}