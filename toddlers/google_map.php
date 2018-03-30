<div id="googlemap<?php echo esc_attr($map_id); ?>" class="googlemap" style="height:<?php echo (int)$height; ?>px;"></div>
<div class="clear"></div>
<?php if ( $enlarge_button ) { ?>
	<div class="map_buttons">
		<a href="http://maps.google.com/maps?q=<?php echo htmlspecialchars( urlencode( $address ) ); ?>"
		   target="_blank" class="icon-zoom-in-outline enlargemap"> <?php echo addcslashes($address,'"');?></a>
	</div>
<?php } ?>
<?php if ( !is_page_template( 'page-contact.php' ) ) {
if ( $map_id == 1 ) { ?>
	<script type="text/javascript" src="https://maps.google.com/maps/api/js?sensor=false&key=AIzaSyAcOhnbQuyxlkdkDgqxGSkdJWW5OxVyFW0"></script>
<?php }
	} ?>
<script type="text/javascript">
	(function ($) {
		var geocoder;
		var map;
		var query = "<?php echo addcslashes($address,'"');?>";
		function initialize() {
			geocoder = new google.maps.Geocoder();
			var myOptions = {
				zoom: <?php echo (int)$zoom;?>,
				scrollwheel: false,
				styles: [
			    {
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
			    }
			],

				mapTypeId: google.maps.MapTypeId.ROADMAP,
				mapTypeControlOptions: {
			        style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			        position: google.maps.ControlPosition.RIGHT_BOTTOM,

			    },
			};
			map = new google.maps.Map(document.getElementById("googlemap<?php echo $map_id;?>"), myOptions);
			codeAddress();
		}

		function codeAddress() {
			var address = query;
			geocoder.geocode({'address': address}, function (results, status) {
				if (status == google.maps.GeocoderStatus.OK) {
					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location
					});
					<?php if(strlen($innercontent)){ ?>
					var infowindow = new google.maps.InfoWindow({
						content: unescape("<?php echo str_replace('+',' ',(preg_replace('/\s+/',' ',addcslashes($innercontent,'"'))));?>")
					});
					google.maps.event.addListener(marker, 'click', function () {
						infowindow.open(map, marker);
					});
					infowindow.open(map, marker);
					<?php } ?>
					map.setCenter(marker.getPosition());
					setTimeout(function () {
						map.panBy(0, -50);
					}, 10);
				} else {
					alert("Geocode was not successful for the following reason: " + status);
				}
			});
		}

		$(function () {
			initialize();
		});
	}(jQuery));
</script>