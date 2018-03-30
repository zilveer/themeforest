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
if (!class_exists('Mk_Options_Framework_Fields_Toggle')) {
    
    class Mk_Options_Framework_Fields_Toggle extends Mk_Options_Framework
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
            $this->dependency = isset($value['dependency']) ? $value['dependency'] : '';
        }
        
        public function render() {
            
            $output = '<span class="mk-toggle-button"><span class="toggle-handle"></span><input type="hidden" value="' . $this->default . '" name="' . $this->id . '" id="' . $this->id . '"/></span>';
            
            return parent::field_wrapper($this->id, $this->name, $this->description, $output, parent::dependency_builder($this->dependency));
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
