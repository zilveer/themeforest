<?php

// Google Map

function th_gmap($atts, $content = null) {
    extract(shortcode_atts(array(
        "height" => '400',
        "zoom" 	=> '15',
        "lat" 	=> '40.712784',
        "long" 	=> '-74.005941',
    ), $atts));

    wp_enqueue_script('gmap', '', '', '', true);

    if(!$lat || !$long) {
        return 'Error: no location lat and/or long data found';
    }

    $coordinates = $lat.','.$long;

    ob_start();
    ?>
    <script type="text/javascript">

        jQuery(document).ready(function() {

            'use strict';

            function initialize() {
                var myLatlng = new google.maps.LatLng(<?php echo $coordinates; ?>);
                var mapOptions = {
                    zoom: <?php echo $zoom; ?>,
                    center: myLatlng
                }
                var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                // Disabled Map Scroll in Contact Page
                map.setOptions({'scrollwheel': false});

                // Black and White style for Google Map
                var styles = [
                    {
                        stylers: [
                            { saturation: -100 }
                        ]
                    },{
                        featureType: "road",
                        elementType: "geometry",
                        stylers: [
                            { lightness: -8 },
                            { visibility: "simplified" }
                        ]
                    },{
                        featureType: "road",
                        elementType: "labels",
                    }
                ];
                map.setOptions({styles: styles});

                // Google Map Maker
                var marker = new google.maps.Marker({
                    position: myLatlng,
                    map: map,
                });
            }

            google.maps.event.addDomListener(window, 'load', initialize);

        });

    </script>

    <!-- Google Map -->
    <div id="map-canvas" style="height:<?php echo str_replace('px','',$height); ?>px;"></div>
    <!-- End Google Map -->

    <?php

    $content = ob_get_contents();
    ob_end_clean();

    return $content;

}
remove_shortcode('gmap');
add_shortcode('gmap', 'th_gmap');