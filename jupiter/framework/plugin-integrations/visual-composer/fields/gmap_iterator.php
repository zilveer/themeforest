<?php
if (!defined('THEME_FRAMEWORK')) exit('No direct script access allowed');

/**
 * Adds marker iterator for advanced google maps
 *
 * @author      Bob Ulusoy
 * @copyright   Artbees LTD (c)
 * @link        http://artbees.net 
 * @since       Version 5.1
 * @package     artbees 
 */



if (function_exists('add_shortcode_param')) {
    add_shortcode_param('gmap_marker', 'mk_gmap_marker_param_field');
}

if (function_exists('add_shortcode_param')) {
    add_shortcode_param('upload', 'mk_upload_param_field');
}


function mk_gmap_marker_param_field($settings, $value) {
    $dependency = vc_generate_dependencies_attributes($settings);
    $param_name = isset($settings['param_name']) ? $settings['param_name'] : '';
    $type = isset($settings['type']) ? $settings['type'] : '';
    $output = '';
    $uniqeID = uniqid();
    $locations = (!empty($value)) ? json_decode(urldecode($value), true) : [];

    $output.= '<div class="gmap-marker-popup">
    	<h4>'.__('New Address', 'mk_framework').'</h4>

    	<input type="hidden" name="uniqid" id="marker-uniqid" value="" />

        <div class="mk-popup-field">
            <label for="title">'.__('Address Title', 'mk_framework').'</label>
            <input type="text" name="title" />
        </div>

    	<div class="mk-popup-field">
	    	<label for="latitude">'.__('Latitude', 'mk_framework').'</label>
	    	<input type="text" name="latitude" />
    	</div>

    	<div class="mk-popup-field">
	    	<label for="longitude">'.__('Longitude', 'mk_framework').'</label>
	    	<input type="text" name="longitude" />
    	</div>

    	<div class="mk-popup-field">
	    	<label for="address">'.__('Full Address Text (Shown In Tooltip)', 'mk_framework').'</label>
	    	<input type="text" name="address" />
    	</div>

    	<div class="mk-popup-field">
    		<label for="marker_icon">'.__('Upload Marker Icon', 'mk_framework').'</label>
	    	<div class="upload-option">
			    	<input class="mk-upload-url vc-mk-upload-url" type="text" id="'.$uniqeID.'" name="marker_icon" value="">
			    	<a class="option-upload-button secondary-button thickbox" id="'.$uniqeID.'_button" href="#">'.__('Upload', 'mk_framework').'</a>
			    	<span id="'.$uniqeID.'-preview" class="show-upload-image" alt=""><img src="" title=""></span>
	    	</div>
    	</div>

    	<div class="mk-popup-buttons">
    	<a href="#" id="mk-popup-submit-btn" class="primary-button green-button">'.__('Save Changes', 'mk_framework').'</a>
    	<a href="#" id="mk-popup-cancel-btn" class="secondary-button" style="padding:14px 30px">'.__('Close', 'mk_framework').'</a>
    	</div>


    </div>';
    
    $output.= '<div class="gmap-marker-option" id="gmap-marker-option-' . $uniqeID . '">';

    $output.= '<ul class="gmap-marker-locations">';

        if(empty($locations)) {
            $output.= '<li class="temp" style="display:none">';
                $output.= '<span></span>'; // Address
                $output.= '<a href="#" class="gmap-delete-btn">'.__('Delete', 'mk_framework').'</a>';
                $output.= '<a href="#" class="gmap-edit-btn">'.__('Edit', 'mk_framework').'</a>';
            $output.= '</li>';

        } else {
            foreach ($locations as $mark) {
                $output.= '<li data-id="'.$mark['uniqid'].'">';
                    $output.= '<span>'.$mark['title'].'</span>'; // Address
                    $output.= '<a href="#" class="gmap-delete-btn">'.__('Delete', 'mk_framework').'</a>';
                    $output.= '<a href="#" class="gmap-edit-btn">'.__('Edit', 'mk_framework').'</a>';
                $output.= '</li>';
            } 
        }

    $output.= '</ul>';

    $output .= '<a class="gmap-new-loaction-btn" href="#">'.__('Add New Location', 'mk_framework').'</a>';

	$output .= '<input type="hidden" class="wpb_vc_param_value gmap-marks-collector ' . $param_name . ' ' . $type . '" value=\'' . $value . '\' name="' . $param_name . '" />';    
	
	$output.= '</div>';
    
    $output.= '<script type="text/javascript">

    	(function($) {
	        mk_gmap_iterator("'.$uniqeID.'");
	        mk_upload_option("'.$uniqeID.'");
        })(jQuery);

    </script>';
    
    return $output;
}