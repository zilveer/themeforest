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
if (!class_exists('Mk_Options_Framework_Fields_Header_Styles')) {
    
    class Mk_Options_Framework_Fields_Header_Styles extends Mk_Options_Framework
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
            
            $output = '<div id="mk-header-switcher">';
            $output.= '<div class="header-style-unit">';
            
            $output.= '<div class="mk-header-preview"><div></div></div>';
            
            $output.= '<div class="mk-header-styles-number">';
            $output.= '<span rel="4">4</span>';
            $output.= '<span rel="3">3</span>';
            $output.= '<span rel="2">2</span>';
            $output.= '<span rel="1">1</span>';
            $output.= '</div>';
            
            $output.= '<div class="mk-header-style-tools">';
            $output.= '<div class="mk-header-align">';
            $output.= '<div class="label">' . __('Align', 'mk_framework') . '</div>';
            $output.= '<span rel="left" class="header-align-left"></span>';
            $output.= '<span rel="center" class="header-align-center"></span>';
            $output.= '<span rel="right" class="header-align-right"></span>';
            $output.= '</div>';
            
            $output.= '<div class="mk-header-toolbar-toggle">';
            $output.= '<div class="label">' . __('Toolbar', 'mk_framework') . '</div>';
            $output.= '<span class="header-toolbar-toggle-button"></span>';
            $output.= '</div>';
            
            $output.= '</div>';
            
            $output.= '</div>';
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
