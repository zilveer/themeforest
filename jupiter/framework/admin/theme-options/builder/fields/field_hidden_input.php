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
if (!class_exists('Mk_Options_Framework_Fields_Hidden_Input')) {
    
    class Mk_Options_Framework_Fields_Hidden_Input extends Mk_Options_Framework
    {
        
        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($value) {
            
            $this->id = $value['id'];
            $this->default = parent::saved_default_value($this->id, $value['default']);
        }
        
        public function render() {
            
            $output = '<input class="hidden-input-'. $this->id .'" type="hidden" value="'.esc_attr($this->default).'" name="' . $this->id . '" id="' . $this->id . '"/>';
            
            return $output;
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
