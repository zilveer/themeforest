<?php

/**
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.0
 * @package     artbees
 */

// Exit if accessed directly
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

// Don't duplicate me!
if (!class_exists('Mk_Options_Framework_Fields_Upload')) {
    
    class Mk_Options_Framework_Fields_Upload extends Mk_Options_Framework
    {
        
        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($value) {
            
            $this->field = $value['type'];
            $this->name = $value['name'];
            $this->id = $value['id'];
            $this->default = parent::saved_default_value($this->id, $value['default']);
            $this->description = $value['desc'];
        }
        
        public function render() {
            
            $output = '<input class="mk-upload-url" type="text" id="' . $this->id . '" name="' . $this->id . '" size="50"  value="' . esc_attr($this->default) . '" />';
            
            $output.= '<a class="secondary-button option-upload-button thickbox" id="' . $this->id . '_button" href="#">' . __('Upload', 'mk_framework') . '</a>';
            
            $output.= '<span id="' . $this->id . '-preview" class="show-upload-image" alt="' . $this->name . '"><img src="' . $this->default . '" title="" /></span>';
            
            return parent::field_wrapper($this->id, $this->name, $this->description, $output);
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
        }
    }
}
