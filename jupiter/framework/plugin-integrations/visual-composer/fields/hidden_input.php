<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Adds hidden input as helper module to be used by other options to store data
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */


if (function_exists('add_shortcode_param')) {
    add_shortcode_param('hidden_input', 'mk_hidden_input_settings_field');
}

function mk_hidden_input_settings_field($settings, $value) {
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    
    $output = '<input name="' . $param_name . '" id="' . $param_name . '" class="wpb_vc_param_value mk_shortcode_hidden ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
    
    return $output;
}