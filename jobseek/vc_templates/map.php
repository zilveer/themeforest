<?php
 
/* Map  
  ------------------------------------------------------------------------------------------------------------------- */

if (!function_exists('map')) {

    function map($atts, $content = null) {

        extract(shortcode_atts(array(
            "lat" => '',
            "lng" => '',
            "zoom" => '14',
            "language" => 'en'
                        ), $atts));

        wp_enqueue_script( 'uber-google-maps' );

        $output = '<div id="map-container"></div>
<script>
			;
(function ($, window, document, undefined) {
    $(document).ready(function () {
    var mapMarkers = [];
    var mapInfoWindows = [];
   ' . wpb_js_remove_wpautop($content) . '
        $("#map-container").UberGoogleMaps(
                {
                    "positionType": "manual",
                    "lat": "' . $lat . '",
                    "lng": "' . $lng . '",
                    "zoom": "' . $zoom . '",
                    "width": 640,
                    "height": 400,
                    "responsive": 1,
                    "searchQuery": "",
                    "language": "' . $language . '",
                    "markers": mapMarkers,
                    "infoWindows": mapInfoWindows,
                    "showInfoWindowsOn": "click",
                    "animateMarkers": 1,
                    "style_type": "preset",
                    "style_index": 99,
                    "style_array_custom": "[]",
                    "auto_sign_in": 0,
                    "fullscreen_enabled": 0,
                    "disable_scroll": 1,
                    "load_api": 1,
                    "style_array": [
                        {
                            "featureType": "administrative",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "saturation": "-100"
                                },
                                {
                                    "lightness": "-30"
                                }
                            ]
                        },
                        {
                            "featureType": "administrative.land_parcel",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "lightness": "0"
                                },
                                {
                                    "saturation": "-100"
                                },
                                {
                                    "gamma": "1.00"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "color": "#f2f2f2"
                                }
                            ]
                        },
                        {
                            "featureType": "landscape.man_made",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "lightness": "-4"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "poi",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "saturation": "-100"
                                },
                                {
                                    "lightness": "0"
                                },
                                {
                                    "gamma": "1.00"
                                }
                            ]
                        },
                        {
                            "featureType": "poi.park",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "weight": "1"
                                },
                                {
                                    "saturation": "-80"
                                },
                                {
                                    "lightness": "17"
                                },
                                {
                                    "gamma": "1.2"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "saturation": -100
                                },
                                {
                                    "lightness": 45
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "lightness": "9"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "geometry.stroke",
                            "stylers": [
                                {
                                    "lightness": "0"
                                },
                                {
                                    "gamma": "1"
                                }
                            ]
                        },
                        {
                            "featureType": "road",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "lightness": "-43"
                                }
                            ]
                        },
                        {
                            "featureType": "road.highway",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "simplified"
                                }
                            ]
                        },
                        {
                            "featureType": "road.arterial",
                            "elementType": "labels.icon",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "saturation": "-90"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.line",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "hue": "#52ff00"
                                },
                                {
                                    "lightness": "-50"
                                },
                                {
                                    "gamma": "1.00"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.station.airport",
                            "elementType": "geometry",
                            "stylers": [
                                {
                                    "saturation": "-77"
                                },
                                {
                                    "gamma": "1.79"
                                },
                                {
                                    "lightness": "23"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.station.bus",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "visibility": "off"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.station.rail",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "hue": "#ff7e00"
                                }
                            ]
                        },
                        {
                            "featureType": "transit.station.rail",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "weight": "1.00"
                                },
                                {
                                    "gamma": "1.00"
                                },
                                {
                                    "lightness": "0"
                                },
                                {
                                    "saturation": "0"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "all",
                            "stylers": [
                                {
                                    "color": "#ccd7dc"
                                },
                                {
                                    "visibility": "on"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "geometry.fill",
                            "stylers": [
                                {
                                    "visibility": "on"
                                },
                                {
                                    "lightness": "-20"
                                },
                                {
                                    "saturation": "-90"
                                },
                                {
                                    "gamma": "1.00"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.fill",
                            "stylers": [
                                {
                                    "lightness": "-39"
                                },
                                {
                                    "saturation": "-100"
                                }
                            ]
                        },
                        {
                            "featureType": "water",
                            "elementType": "labels.text.stroke",
                            "stylers": [
                                {
                                    "lightness": "55"
                                }
                            ]
                        }
                    ],
                    "title": "",
                    "shortcode": ""
                }
        );
    });
})(jQuery, window, document);

</script>

        
        ';
        return $output;
    }

}

add_shortcode('map', 'map');