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
if (!class_exists('Mk_Options_Framework_Fields_Visual_Selector')) {
    
    class Mk_Options_Framework_Fields_Visual_Selector extends Mk_Options_Framework
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
            $this->options = $value['options'];
            $this->selector_type = isset($value['selector_type']) ? $value['selector_type'] : '';
            $this->id = $value['id'];
            $this->default = parent::saved_default_value($this->id, $value['default']);
            $this->description = isset($value['desc']) ? $value['desc'] : '';
        }
        
        public function render() {
            $output = '<div class="mk-visual-selector">';
            foreach ($this->options as $key => $option) {
                if($this->selector_type  == 'html') {
                    $output.= '<a href="#" rel="'. $key .'">'. $option .'</a>' ;    
                }else {
                    $output.= '<a href="#" rel="' . $key . '"><img  src="' . THEME_ADMIN_ASSETS_URI . '/images/' . $option . '" /></a>';
                }
            }
            $output.= '<input type="hidden" value="' . esc_attr($this->default) . '" name="' . $this->id . '" id="' . $this->id . '"/>';
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
