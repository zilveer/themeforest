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
if (!class_exists('Mk_Options_Framework_Fields_Multiselect')) {
    
    class Mk_Options_Framework_Fields_Multiselect extends Mk_Options_Framework
    {
        
        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($value) {
            
            //$this->saved_options = parent::$saved_options;
            $this->field = $value['type'];
            $this->name = $value['name'];
            $this->id = $value['id'];
            $this->options = $value['options'];
            //$this->target = $value['target'];
            $this->default = isset($value['default']) ? parent::saved_default_value($this->id, $value['default']) : '';
            $this->description = $value['desc'];
        }
        
        public function render() {
            
            /*if (isset($this->target)) {
                if (isset($this->options)) {
                    $this->options = $this->options + parent::get_select_target_options($this->target);
                } 
                else {
                    $this->options = parent::get_select_target_options($this->target);
                }
            }*/
            
            $output = '<select class="mk-select mk-chosen" style="width:500px;" name="' . $this->id . '[]" id="' . $this->id . '" multiple="multiple">';
            if (!empty($this->options) && is_array($this->options)) {
                foreach ($this->options as $key => $option) {
                    $output.= '<option value="' . $key . '"';
                    if (isset($this->default)) {
                        if (is_array($this->default)) {
                            if (in_array($key, $this->default)) {
                                $output.= ' selected="selected"';
                            }
                        }
                    } 
                    else if (in_array($key, $this->default)) {
                        $output.= ' selected="selected"';
                    }
                    $output.= '>' . $option . '</option>';
                }
            }
            $output.= '</select>';
            
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
