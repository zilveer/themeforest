<?php

function rms_googlemap($atts, $content = NULL) {
    extract(shortcode_atts(array(
        'lat' => '',
        'lng' => '',
        'zoom' => '',
        'contents' => '',
        'contents2' => ''
        ), $atts));
    ?>
    <script>
        jQuery(function() {
            function init_map() {
                var myOptions = {
                    zoom: <?php echo esc_js($zoom); ?>,
                    center: new google.maps.LatLng(<?php echo esc_js($lat); ?>, <?php echo esc_js($lng); ?>), //change the coordinates
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
                    scrollwheel: false,
                    styles: [{featureType: 'all', stylers: [{saturation: -100}, {gamma: 0.50}]}]
                };
                map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);
                marker = new google.maps.Marker({
                    map: map,
                    position: new google.maps.LatLng(<?php echo esc_js($lat); ?>, <?php echo esc_js($lng); ?>) //change the coordinates
                });
				  var contentString = '<div id="content">'+
				  '<div id="siteNotice">'+
				  '</div>'+
				  '<h4 id="firstHeading" class="firstHeading"><?php echo esc_js($contents); ?></h4>'+
				  '<div id="bodyContent">'+
				  '<p><?php echo esc_js($contents2); ?></p>'+
				  '</div>'+
				  '</div>';
				  var infowindow = new google.maps.InfoWindow({
					  content: contentString
				  });
                google.maps.event.addListener(marker, "click", function() {
                    infowindow.open(map, marker);
                });
                infowindow.open(map, marker);
            }
            google.maps.event.addDomListener(window, 'load', init_map);
        });
    </script>
    <?php
}

add_shortcode('rms-googlemap', 'rms_googlemap');
