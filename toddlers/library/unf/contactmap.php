<?php global $unf_options;?>
<?php

if (!empty($unf_options['unf_map_mode']) && $unf_options['unf_map_mode'] == "1") {
	$mapmode = "roadmap";
} else {
	$mapmode = "satellite";
}

if (!empty($unf_options['unf_map_address'])) {

	$address = $unf_options['unf_map_address'];
	$mapzoom = $unf_options['unf_mapzoom'];

	//GOOGLE MAPS MODULE
	// generate a unique ID for each map
	$GLOBALS['google_map_id'] = isset($GLOBALS['google_map_id']) ? $GLOBALS['google_map_id'] + 1 : 1;
	$map_id = 'map_canvas_'.$GLOBALS['google_map_id'];
	?>
	<div class="contact_map contact_block">
		<div class="block_map" style="height:350px;">
			<div id="<?php echo esc_attr($map_id);?>" style="height:350px;"></div>
		</div>
	</div>

	<script type="text/javascript">
	jQuery(document).ready(function () {
	var business_address =  '<?php echo addcslashes($address,"'"); ?>';
	var zoom_level =  <?php echo esc_js($mapzoom);?>;
	    jQuery('#<?php echo esc_js($map_id);?>').initMap({
	    center: business_address,
	    options : { zoom: zoom_level, scrollwheel: false,
	    styles:[{
			        "featureType": "landscape.man_made",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#f7f1df"
			            }
			        ]
			    },
			    {
			        "featureType": "landscape.natural",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#d0e3b4"
			            }
			        ]
			    },
			    {
			        "featureType": "landscape.natural.terrain",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "poi",
			        "elementType": "labels",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "poi.business",
			        "elementType": "all",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "poi.medical",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#fbd3da"
			            }
			        ]
			    },
			    {
			        "featureType": "poi.park",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#bde6ab"
			            }
			        ]
			    },
			    {
			        "featureType": "road",
			        "elementType": "geometry.stroke",
			        "stylers": [
			            {
			                "visibility": "off"
			            }
			        ]
			    },
			    {
			        "featureType": "road",
			        "elementType": "labels",
			        "stylers": [
			            {
			                "visibility": "on"
			            }
			        ]
			    },
			    {
			        "featureType": "road.highway",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "color": "#ffe15f"
			            }
			        ]
			    },
			    {
			        "featureType": "road.highway",
			        "elementType": "geometry.stroke",
			        "stylers": [
			            {
			                "color": "#efd151"
			            }
			        ]
			    },
			    {
			        "featureType": "road.arterial",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "color": "#ffffff"
			            }
			        ]
			    },
			    {
			        "featureType": "road.local",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "color": "black"
			            }
			        ]
			    },
			    {
			        "featureType": "transit.station.airport",
			        "elementType": "geometry.fill",
			        "stylers": [
			            {
			                "color": "#cfb2db"
			            }
			        ]
			    },
			    {
			        "featureType": "water",
			        "elementType": "geometry",
			        "stylers": [
			            {
			                "color": "#a2daf2"
			            }
			        ]
			    }]
	    },
	    markers : {
	    	business_marker: {
	    		position: business_address,
	    		info_window : {
	                content : business_address,
	                maxWidth: 350,
	                zIndex: 1 }
	    	}},
	    type : '<?php echo esc_js($mapmode);?>',
	    controls : {
	        map_type :
		        {
		            type : ['roadmap', 'satellite', 'hybrid'],
		            position : 'top_right',
		            style: 'dropdown_menu'
		        },
		        overview : { opened : false },
		        pan : false,
		        rotate : false,
		        scale : false,
		        street_view : { position : 'top_right' },
		        zoom : {
		            position : 'top_left',
		            style: 'large'
		        }
		    }
	    });
	});
	</script>
<?php  } ?>

