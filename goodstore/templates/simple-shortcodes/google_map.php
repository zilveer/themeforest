<?php global $jaw_data; ?>

<?php

ob_start();
wp_register_script('g_maps', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyDQawavpg46SmVMRFtdPl1YKzSDQc0UI6U&sensor=false&callback=JawGoogleMapLoaded', array('jquery'), false, true);
wp_enqueue_script('g_maps');

echo '<div class="row">';
echo '<div class="col-lg-' . esc_attr(jaw_template_get_var('box_size')) . '">';
echo '
        <div id="google_map_' . esc_attr(jaw_template_get_var('id')) . '" class="google_map" style="' . jaw_template_get_var('width') . jaw_template_get_var('height') . '"></div>';
echo '</div>';
echo '</div>';


echo ' <script type="text/javascript">

jQuery("body").on("jaw_g_maps",function(){
                var location = new google.maps.LatLng(' . esc_js(jaw_template_get_var('latitude')) . ', ' . esc_js(jaw_template_get_var('longitude')) . ');
                var mapOptions = {
                  center: location,
                  zoom: ' . esc_js(jaw_template_get_var('zoom')) . ',
                  panControl: ' . esc_js(jaw_template_get_var('controls')) . ',
                  zoomControl: ' . esc_js(jaw_template_get_var('controls')) . ',
                  zoomControlOptions: {
                      style: google.maps.ZoomControlStyle.SMALL,
                      position: google.maps.ControlPosition.TOP_LEFT
                  },
                   mapTypeControl: ' . esc_js(jaw_template_get_var('controls')) . ',
                   mapTypeControlOptions: {
                      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                      position: google.maps.ControlPosition.TOP_RIGHT
                   },
                   scaleControl: false,
                   streetViewControl: false,
                   overviewMapControl: false,
                   draggable: ' . esc_js(jaw_template_get_var('dragable')) . ',
                   disableDoubleClickZoom: ' . esc_js(jaw_template_get_var('disabledoubleclickzoom')) . ',
                   scrollwheel: ' . esc_js(jaw_template_get_var('scrollwheel')) . ',
                   mapTypeId: google.maps.MapTypeId.' . esc_js(jaw_template_get_var('maptype')) . '
                };
                var map = new google.maps.Map(document.getElementById("google_map_' . esc_js(jaw_template_get_var('id')) . '"), mapOptions);';

// default marker
echo '
                        var contentString = ' . json_encode(jaw_template_get_var('description')) . ';
                        var infowindow = new google.maps.InfoWindow({
                            content: contentString
                        });
                        var marker = new google.maps.Marker({
                                                                position: location,
                                                                map: map
                                                          });';
if (jaw_template_get_var('description', '') != '') {

    if (jaw_template_get_var('description_open', 'start') == 'start') {
        echo 'infowindow.setContent(' . json_encode(jaw_template_get_var('description')) . ');';
        echo 'infowindow.open(map,marker);';
    }
    echo ' 
                                google.maps.event.addListener(marker, "click", function() {
                                    infowindow.setContent(' . json_encode(jaw_template_get_var('description')) . ');
                                                        infowindow.open(map,this);
                                    });';
}
// problem with bootstrap 
//google.maps.event.trigger(map, 'resize');

// multiple markers
if (jaw_template_get_var('markers')) {

    // g multiple map markers
    echo do_shortcode(jaw_template_get_var('markers'));
}
echo '}
);
                </script>';

echo ob_get_clean();



