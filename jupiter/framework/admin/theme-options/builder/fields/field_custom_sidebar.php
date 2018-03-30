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
if (!class_exists('Mk_Options_Framework_Fields_Custom_Sidebar')) {
    
    class Mk_Options_Framework_Fields_Custom_Sidebar extends Mk_Options_Framework
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
            
            if (!empty($this->default)) {
                $this->sidebars = explode(',', $this->default);
            } 
            else {
                $this->sidebars = array();
            }
        }
        
        public function render() {
            
            $output = '<div class="custom-sidebar-wrapper">';
            $output.= '<input type="text" id="add_sidebar" name="add_sidebar" size="50" /><a href="#" class="secondary-button" id="add_sidebar_item">' . __('Create', 'mk_framework') . '</a>';
            $output.= '</div>';
            
            $output.= '<span class="option-title-sub" style="margin-bottom:20px;">' . __('Current sidebars', 'mk_framework') . '</span>';
            
            $output.= '<div id="selected-sidebar" class="selected-sidebar">';
            $output.= '<div id="sidebar-item" class="default-sidebar-item">';
            $output.= '<div class="slider-item-text"></div>';
            $output.= '<a href="#" class="delete-sidebar"><i class="icon-close2"></i></a><input type="hidden" class="sidebar-item-value" />';
            $output.= '</div>';
            
            if (!empty($this->sidebars)) {
                foreach ($this->sidebars as $sidebar) {
                    $output.= '<div id="sidebar-item" class="sidebar-item">';
                    $output.= '<div class="slider-item-text">' . $sidebar . '</div>';
                    $output.= '<a href="#" class="delete-sidebar"><i class="icon-close2"></i></a><input type="hidden" class="sidebar-item-value" value="' . esc_attr($sidebar) . '"/>';
                    $output.= '</div>';
                }
            }

            $output.= '</div>';
            $output.= '<input type="hidden" value="' . esc_attr($this->default) . '" name="' . $this->id . '" id="sidebars"/>';
            
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
