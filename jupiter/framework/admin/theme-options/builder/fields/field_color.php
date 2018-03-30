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
if (!class_exists('Mk_Options_Framework_Fields_Color')) {
    
    class Mk_Options_Framework_Fields_Color extends Mk_Options_Framework
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
            $this->field_default = $value['default'];
            $this->default = parent::saved_default_value($this->id, $value['default']);
            $this->description = isset($value['desc']) ? $value['desc'] : '';
        }
        
        public function render() {
            
            $output = '<div class="color-picker-holder">';
            $output.= '<input name="' . $this->id . '" id="' . $this->id . '" size="8" data-default-color="' . esc_attr($this->field_default) . '" class="color-picker" value="' . esc_attr($this->default) . '" />';
            $output.= '</div>';
            
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
