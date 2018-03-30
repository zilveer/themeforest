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
if (!class_exists('Mk_Options_Framework_Fields_Range')) {
    
    class Mk_Options_Framework_Fields_Range extends Mk_Options_Framework
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
            $this->default_value = 'data-value="' . esc_attr($this->default) . '" ';
            $this->min = isset($value['min']) ? ('data-min="' . $value['min'] . '" ') : '';
            $this->max = isset($value['max']) ? ('data-max="' . $value['max'] . '" ') : '';
            $this->step = isset($value['step']) ? ('data-step="' . $value['step'] . '" ') : '';
            $this->unit = $value['unit'];
            $this->description = isset($value['desc']) ? $value['desc'] : '';
            $this->dependency = isset($value['dependency']) ? $value['dependency'] : '';
        }
        
        public function render() {
            
            $output = '<div class="mk-ui-input-slider">';
            $output.= '<div class="mk-range-input" ' . $this->default_value . $this->min . $this->max . $this->step . '></div>';
            $output.= '<input class="range-input-selector" name="' . $this->id . '" id="' . $this->id . '" type="text" value="' . esc_attr($this->default) . '" />';
            if (isset($this->unit)) {
                $output.= '<span class="unit">' . $this->unit . '</span>';
            }
            $output.= '</div>';
            if(is_rtl()) {
                $output .= '<div class="clearboth"></div>';
            }
            
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
