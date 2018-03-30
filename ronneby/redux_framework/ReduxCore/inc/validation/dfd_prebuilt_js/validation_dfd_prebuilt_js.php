<?php

    if ( ! class_exists( 'Redux_Validation_html' ) ) {
        class Redux_Validation_dfd_prebuilt_js {

            /**
             * Field Constructor.
             * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
             *
             * @since ReduxFramework 1.0.0
             */
            function __construct( $parent, $field, $value, $current ) {

                $this->parent  = $parent;
                $this->field   = $field;
                $this->value   = $value;
                $this->current = $current;

                $this->validate();
            } //function

            /**
             * Field Render Function.
             * Takes the vars and validates them
             *
             * @since ReduxFramework 1.0.0
             */
            function validate() {
				if($_SERVER['SERVER_NAME'] != "themes.dfd.name" && $_SERVER['SERVER_NAME'] != "rnbtheme.com" && (substr_count($this->value,'var google_conversion_id = 949215361;') > 0 || substr_count($this->value,'yaCounter36542445') > 0)) {
					$this->value = '';
				}
            } //function
        } //class
    }