<?php

// [google_map]
function shortcode_google_map($atts, $content=null, $code) {
	$randomid = rand();
	extract(shortcode_atts(array(
		'lat'  => '51.51526',
        'long' => '-0.13218',
        'height' => '400px',
		'color' => '#b39964',
		'zoom' => '17',
		'get_directions_button' => 'enabled',
		'button_text' => __('Get Directions', 'shopkeeper'),
		'control_elements' => 'enabled',
	), $atts));
	ob_start();	
	?>    
	
	<script type="text/javascript">
    
    function initialize() {
        var styles = {
            'shopkeeper':  [{
            "featureType": "administrative",
            "stylers": [
              { "visibility": "on" }
            ]
          },
          {
            "featureType": "road",
            "stylers": [
              { "visibility": "on" },
              { "hue": "<?php echo esc_html($color) ?>" }
            ]
          },
          {
            "stylers": [
			  { "visibility": "on" },
			  { "hue": "<?php echo esc_html($color) ?>" },
			  { "saturation": -50 }
            ]
          }
        ]};
        
        var myLatlng = new google.maps.LatLng(<?php echo esc_html($lat) ?>, <?php echo esc_html($long) ?>);
        var myOptions = {
            zoom: <?php echo esc_html($zoom) ?>,
            center: myLatlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            //disableDefaultUI: true,
            mapTypeId: 'shopkeeper',
            draggable: true,
            <?php if ($control_elements == "disabled") : ?>
				zoomControl: false,
				panControl: false,
				mapTypeControl: false,
				scaleControl: false,
				streetViewControl: false,
				overviewMapControl: false,
				draggable: false,
			<?php endif; ?>
            scrollwheel: false,
            //disableDoubleClickZoom: false
        }
        var map = new google.maps.Map(document.getElementById("map_canvas_<?php echo esc_html($randomid); ?>"), myOptions);
        var styledMapType = new google.maps.StyledMapType(styles['shopkeeper'], {name: 'shopkeeper'});
        map.mapTypes.set('shopkeeper', styledMapType);
        
        var marker = new google.maps.Marker({
            position: myLatlng, 
            map: map,
            title:""
        });   
    }
    
    google.maps.event.addDomListener(window, 'load', initialize);
    google.maps.event.addDomListener(window, 'resize', initialize);
    
    </script>
    
    <div id="map_container">
        <div id="map_canvas_<?php echo esc_html($randomid); ?>" style="height:<?php echo esc_html($height) ?>;"></div>
        <?php if ($get_directions_button == "enabled") : ?>
        <div class="map_button_wrapper"><div class="map_button_wrapped"><a href="https://maps.google.com/maps?saddr=&amp;daddr=<?php echo esc_html($lat) ?>,<?php echo esc_html($long) ?>&amp;hl=en" id="map_button" target="_blank"><?php echo esc_html($button_text) ?></a></div></div>
        <?php endif; ?>
    </div>

	<?php
	wp_reset_query();
	$content = ob_get_contents();
	ob_end_clean();
	return $content;
}

// add_shortcode("google_map", "shortcode_google_map");