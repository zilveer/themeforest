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
if (!class_exists('Mk_Options_Framework_Fields_Sub_Group')) {
    
    class Mk_Options_Framework_Fields_Sub_Group extends Mk_Options_Framework
    {
        
        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($value) {
            
            $this->fields = $value['fields'];
            $this->id = $value['id'];
            $this->name = $value['name'];
            $this->desc = $value['desc'];
        }
        
        public function render() {
            
            $output = '<div id="' . $this->id . '" class="mk-sub-pane">';
            $output.= '<div class="mk-heading-option">';
            $output.= '<span class="mk-page-heading">' . $this->name . '</span>';
            
            if (isset($this->desc)) {
                $output.= '<span class="option-desc">' . $this->desc . '</span>';
            }
            $output.= '</div>';
            //print_r($this->fields);
            foreach ($this->fields as $option) {
                $output.= parent::build_fields($option);
            }
            $output .= '</div>';

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
