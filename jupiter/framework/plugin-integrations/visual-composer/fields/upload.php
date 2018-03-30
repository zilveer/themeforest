<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Add Upload Option to Visual Composer Params
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net
 * @since       Version 5.1
 * @package     artbees
 */



if (function_exists('add_shortcode_param')) {
    add_shortcode_param('upload', 'mk_upload_param_field');
}



function mk_upload_param_field($settings, $value) {
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $output = '';
    $uniqeID = uniqid();
    
    $output.= '<div class="upload-option">';
    $output.= '<input class="mk-upload-url vc-mk-upload-url wpb_vc_param_value ' . $param_name . ' ' . $type . '" type="text" id="' . $uniqeID . '" name="' . $param_name . '" size="50"  value="' . $value . '" /><a class="option-upload-button secondary-button thickbox" id="' . $uniqeID . '_button" href="#">' . __('Upload', 'mk_framework') . '</a>';
    $output.= '<span id="' . $uniqeID . '-preview" class="show-upload-image" alt=""><img src="' . $value . '" title="" /></span></div>';
    
    $output.= '<script type="text/javascript">
        (function($){
            mk_upload_option("'.$uniqeID.'");
        })(jQuery);
    </script>';
    
    return $output;
}