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
if (!class_exists('Mk_Options_Framework_Fields_Export')) {
    
    class Mk_Options_Framework_Fields_Export extends Mk_Options_Framework
    {
        
        /**
         * Field Constructor.
         *
         * @since       1.0.0
         * @access      public
         * @return      void
         */
        function __construct($value) {
            
            $this->name = $value['name'];
            $this->id = $value['id'];
            $this->description = $value['desc'];
        }
        
        public function render() {
            
            $output = '<textarea id="' . $this->id . '" rows="30" onclick="this.focus();this.select()" readonly="readonly" name="' . $this->id . '">';
            $output.= base64_encode(serialize(get_option(THEME_OPTIONS)));
            $output.= '</textarea>';
            
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
