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
if (!class_exists('Mk_Options_Framework_Fields_Groupset')) {
    
    class Mk_Options_Framework_Fields_Groupset extends Mk_Options_Framework
    {
        
        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($value) {
            
            $this->heading = $value['heading'];
            $this->title = $value['title'];
            $this->fields = $value['fields'];
            $this->styles = isset($value['styles']) ? $value['styles'] : '';
            $this->dependency = isset($value['dependency']) ? $value['dependency'] : '';
        }
        
        public function render() {
            
            $output= '<div class="mk-groupset-holder" style="'.$this->styles.'"'.parent::dependency_builder($this->dependency).'>';
            $output .= '<div class="mk-groupset-heading">' . $this->heading . '</div>';
            $output.= '<h3>' . $this->title . '</h3>';
            //print_r($this->fields);
            foreach ($this->fields as $option) {
                $output.= parent::build_fields($option);
            }
            $output.= '</div>';
            
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
