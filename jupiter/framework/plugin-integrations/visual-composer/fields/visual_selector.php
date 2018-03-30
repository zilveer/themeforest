<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Add Visual Selector Option to Visual Composer Params
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */



if (function_exists('add_shortcode_param')) {
    add_shortcode_param('visual_selector', 'mk_visual_selector_param_field');
}



function mk_visual_selector_param_field($settings, $value) {
    $dependency = vc_generate_dependencies_attributes($settings);
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    
    $class = isset($settings['class']) ? $settings['class'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $options = isset($settings['value']) ? $settings['value'] : '';
    $output = '';
    $uniqeID = uniqid();
    
    $output.= '<div class="mk-visual-selector ' . $class . '" id="visual-selector' . $uniqeID . '">';
    foreach ($options as $key => $option) {
        $output.= '<a href="#" rel="' . $option . '"><img  src="' . THEME_ADMIN_ASSETS_URI . '/images/' . $key . '" /></a>';
    }
    $output.= '<input name="' . $param_name . '" id="' . $param_name . '" ' . $dependency . ' class="wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="hidden" value="' . $value . '"/>';
    $output.= '</div>';
    
    $output.= '<script type="text/javascript">

        mk_visual_selector();

    </script>';
    
    return $output;
}