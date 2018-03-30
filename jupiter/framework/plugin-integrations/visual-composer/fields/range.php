<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Add Range Option to Visual Composer Params
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */


if (function_exists('add_shortcode_param')) {
    add_shortcode_param('range', 'mk_range_settings_field');
}


function mk_range_settings_field($settings, $value) {
    $dependency = vc_generate_dependencies_attributes($settings);
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $min = isset($settings['min']) ? $settings['min'] : '';
    $max = isset($settings['max']) ? $settings['max'] : '';
    $step = isset($settings['step']) ? $settings['step'] : '';
    $unit = isset($settings['unit']) ? $settings['unit'] : '';
    $uniqeID = uniqid($settings['param_name']);
    $output = '';


    $output.= '<div class="mk-ui-input-slider">';
    $output.= '<div ' . $dependency . ' class="mk-range-input" data-value="' . $value . '" data-min="' . $min . '" data-max="' . $max . '" data-step="' . $step . '" id="rangeInput-' . $uniqeID . '"></div>';
    $output.= '<input name="' . $param_name . '"  class="range-input-selector wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="text" value="' . $value . '"/><span class="unit">' . $unit . '</span></div>';
    
    $output.= '<script type="text/javascript">
        (function($){
            mk_range_option("'.$uniqeID.'");
        })(jQuery);    
    </script>';



    return $output;
}