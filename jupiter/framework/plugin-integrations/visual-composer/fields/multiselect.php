<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Add MultiSelect Option to Visual Composer Params
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */


if (function_exists('add_shortcode_param')) {
    add_shortcode_param('multiselect', 'mk_multiselect_param_field');
}



function mk_multiselect_param_field($settings, $value) {
    $dependency = vc_generate_dependencies_attributes($settings);
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $options = isset($settings['options']) ? $settings['options'] : '';
    $output = '';
    $uniqeID = uniqid();
    
    $output.= '<select multiple="multiple" name="' . $param_name . '" id="multiselect-' . $uniqeID . '" style="width:100%" ' . $dependency . ' class="wpb-multiselect wpb_vc_param_value ' . $param_name . ' ' . $type . '">';
    if (is_array($options) && !empty($options)) {
        foreach ($options as $key => $option) {
            $selected = '';
            if (in_array($key, explode(',', $value))) {
                $selected = ' selected="selected"';
            }
            $output.= '<option value="' . $key . '"' . $selected . '>' . $option . '</option>';
        }
    }
    $output.= '</select>';
    
    $output.= '<script type="text/javascript">

        jQuery("#multiselect-' . $uniqeID . '").select2({placeholder: "Select Options"});

    </script>';
    
    return $output;
}