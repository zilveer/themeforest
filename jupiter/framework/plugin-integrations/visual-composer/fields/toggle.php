<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Add Toggle Option to Visual Composer Params
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */



if (function_exists('add_shortcode_param')) {
    add_shortcode_param('toggle', 'mk_toggle_param_field');
}


function mk_toggle_param_field($settings, $value) {
    $dependency = vc_generate_dependencies_attributes($settings);
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $output = '';
    $uniqeID = uniqid($settings['param_name']);
    $output.= '<span class="mk-toggle-button mk-composer-toggle" id="toggle-switch-' . $uniqeID . '">';
	    $output.= '<span class="toggle-handle"></span>';
	    $output.= '<input type="hidden" ' . $dependency . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" value="' . $value . '" name="' . $param_name . '"/>';
	$output.= '</span>';
    
    $output.= '<script type="text/javascript">

    	(function($) {
	       mk_toggle_option("'.$uniqeID.'");
        })(jQuery);

    </script>';
    
    return $output;
}