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
if (!class_exists('Mk_Options_Framework_Fields_Group')) {
    
    class Mk_Options_Framework_Fields_Group extends Mk_Options_Framework
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
            $this->menu = $value['menu'];
            $this->fields = $value['fields'];
        }
        
        public function render() {
            
                $output = '<div id="'.$this->id.'" class="mk-main-pane">';
                $output .= '<ul class="mk-sub-navigator">';

                foreach ( $this->menu as $key => $option ) {
                    $output.= '<li  class="'.$key.'"><a href="#'.$key.'">'.$option.'</a></li>';
                }

                $output.= '</ul>';
                $output.= '<div class="mk-sub-panes">';
                //print_r($this->fields);
                foreach ($this->fields as $field) {
                    $output.= parent::build_fields($field);
                }
                
                $output.= '</div>';
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
