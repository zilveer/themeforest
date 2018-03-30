<?php

global $jaw_data; 

    echo '
        var contentString = ' . json_encode(jaw_template_get_var('description_marker')) . ';
        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
        var marker = new google.maps.Marker({
                                                position: new google.maps.LatLng(' . esc_js((jaw_template_get_var('latitude'))) .','. esc_js((jaw_template_get_var('longitude'))).'),
                                                map: map_'. esc_js(jaw_template_get_var('id')) .'
                                                });';

if (jaw_template_get_var('description_marker', '') != '') {
    
        if (jaw_template_get_var('descriptionopened', '1') == '1') {
            
            echo 'infowindow.setContent(' . json_encode(jaw_template_get_var('description_marker')) . ');';
            echo 'infowindow.open(map_'. esc_js(jaw_template_get_var('id')) .',marker);';
        }
        echo ' 
                google.maps.event.addListener(marker, "click", function() {
                infowindow.setContent(' . json_encode(jaw_template_get_var('description_marker')) . ');
                                        infowindow.open(map_'. esc_js(jaw_template_get_var('id')) .',this);
                    });';
}