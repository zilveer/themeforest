
var MY_MAPTYPE_ID = 'berg_style';

if(contactOptions.mapType != 'custom') {
	MY_MAPTYPE_ID = contactOptions.mapType;
}
var mapLocations = $.extend({}, contactOptions.mapLocations );

function initializeMap() {
	if(contactOptions.mapStyle == '') {
	var featureOpts = [{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.highway","elementType":"geometry","stylers":[{"visibility":"simplified"},{"color":"#ff6a6a"},{"lightness":"0"}]},{"featureType":"road.highway","elementType":"labels.text","stylers":[{"visibility":"on"}]},{"featureType":"road.highway","elementType":"labels.icon","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#de223f"},{"lightness":"75"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"lightness":"75"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"transit.line","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.bus","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"all","stylers":[{"visibility":"on"}]},{"featureType":"transit.station.rail","elementType":"labels.icon","stylers":[{"weight":"0.01"},{"hue":"#ff0028"},{"lightness":"0"}]},{"featureType":"water","elementType":"all","stylers":[{"visibility":"on"},{"color":"#80e4d8"},{"lightness":"25"},{"saturation":"-23"}]}];
	} else {
		var style = JSON.parse(contactOptions.mapStyle);
		var featureOpts = style;
	}

	var mapType = MY_MAPTYPE_ID;
	var options = '';
	if($('#map').hasClass('contact-intro-map')) {
		options = {
			mapTypeId: mapType,
			scrollwheel:  false,
			draggable: isDraggable,
			mapTypeControlOptions: { position: google.maps.ControlPosition.LEFT_BOTTOM},
			zoomControlOptions: { position: google.maps.ControlPosition.RIGHT_CENTER},
			streetViewControlOptions: { position: google.maps.ControlPosition.RIGHT_CENTER},
		};
    } else {
		options = {
			mapTypeId: mapType,
			scrollwheel:  false,
			zoomControlOptions: { position: google.maps.ControlPosition.RIGHT_TOP},
		};
    }


	var map = new google.maps.Map(jQuery('#map')[0], options);
	if(contactOptions.mapType == 'custom') {
		var styledMapOptions = {
			name: 'BERG Style'
		};

		var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
		map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

	}
	
	var latLngBounds = new google.maps.LatLngBounds();

	jQuery.each(mapLocations.locations, function(key, value) {
		var markerImage = value.marker;
		var latLng = new google.maps.LatLng(value.lat, value.lng);
		latLngBounds.extend(latLng);

		var options = {
			position: latLng,
			title: value.header,
			map: map,
			draggable: false,
		};

		if (markerImage) {
			options.icon = { url: markerImage, origin: new google.maps.Point(0, 0), anchor: new google.maps.Point(2 + parseInt(value.markerWidth/2, 10), parseInt(value.markerHeight, 10) - 5)};
		}

		var marker = new google.maps.Marker(options);

		marker.addListener('click', function() {
			var anchor = $('.contact-locations');
			if ( anchor.length > 0 ) {
				var scrollOffset = anchor.offset().top;
				$("html").velocity("scroll", { offset: scrollOffset, mobileHA: false, easing: [0.645, 0.045, 0.355, 1], duration: 1000 });
			}
		});

	});
	map.setZoom(1);
	map.initialZoom = true;
	var listener = google.maps.event.addListener(map, "idle", function() {
		map.fitBounds(latLngBounds);
		var markerCount = mapLocations.locations.length;
		
		// map.setZoom(map.getZoom() -1);
		map.initialZoom = false;
		if(map.getZoom() > 15 && markerCount == 1) {
			map.setZoom(17);
		}
		if(map.getZoom() > 15 && markerCount > 1) {
			map.setZoom(16);
		}
		google.maps.event.removeListener(listener);
	});
	$(window).on('resize', $.debounce( 250, function() {
		map.fitBounds(latLngBounds);
		var markerCount = mapLocations.locations.length;
		map.setZoom(map.getZoom() -1);
		map.initialZoom = false;
		if(map.getZoom() > 15 && markerCount == 1) {
			map.setZoom(17);
		}
		if(map.getZoom() > 15 && markerCount > 1) {
			map.setZoom(16);
		}
	}));

}

initializeMap();
setTimeout(function() {
	// google.maps.event.trigger(map, "resize");
}, 1000);