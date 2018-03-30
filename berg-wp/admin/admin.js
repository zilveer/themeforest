$ = jQuery.noConflict();

$('document').ready(function($) {
	'use strict';
	/*
	Home page vide auto save
	*/
	$('#slider_video_type_id').change(function() {
		$('#submit').click();
	});
	$('.remove-this-row').parent().parent().parent('tr').addClass('hide-important');
	var geocoder = new google.maps.Geocoder();
	/*
	map single
	*/
	$('#contact_map_search').live('click', function(e) {
		e.preventDefault();
		var address = $('#contact_map_address_id').val();

		geocoder.geocode({
			'address': address
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {
				var latitude = results[0].geometry.location.lat();
				var longitude = results[0].geometry.location.lng();
				singleupdateMarkerPosition(map, results[0].geometry.location);
				singlemoveMarker(map, marker, results[0].geometry.location);
				map.setZoom(14);
			}
		});
	});

	$('#contact_map_type_id').change(function() {
		singleupdateMapType(map, $(this).val());
		$('#contact_map_type_id').val($(this).val());
	});

	function singlemoveMarker(map, marker, location) {
		marker.setPosition(new google.maps.LatLng(location.lat(), location.lng()));
		map.panTo(new google.maps.LatLng(location.lat(), location.lng()));
	}

	function singlegeocodePosition(pos) {
		geocoder.geocode({
			latLng: pos
		}, function(responses) {
			if (responses && responses.length > 0) {
				singleupdateMarkerAddress(responses[0].formatted_address);
			} else {
				singleupdateMarkerAddress('');
			}
		});
	}

	function singleupdateCenterPosition(latLng) {
		$('#contact_map_center_lat_id').val(latLng.lat());
		$('#contact_map_center_lng_id').val(latLng.lng());
	}

	function singleupdateMarkerPosition(map, latLng) {
		$('#contact_map_marker_lat_id').val(latLng.lat());
		$('#contact_map_marker_lng_id').val(latLng.lng());
		$('#contact_map_zoom_level_id').val(map.getZoom());
	}

	function singleupdateMarkerAddress(str) {
		$('#contact_map_address_id').val(str);
	}

	function singleupdateZoomLevel(zoomLevel) {
		$('#contact_map_zoom_level_id').val(zoomLevel);
	}

	function singleupdateMapType(map, type) {
		map.setMapTypeId(type);
	}

	if ($("#map_canvas").length) {

		var options = {
			zoom: 8,
			center: new google.maps.LatLng(centerPositionLat, centerPositionLng),
			mapTypeId: 'roadmap'
		};

		var map = new google.maps.Map($('#map_canvas')[0], options);

		var markerOptions = {
			position: new google.maps.LatLng(markerPositionLat, markerPositionLng),
			title: 'Location',
			map: map,
			draggable: true
		};

		if (markerImage !== '') {
			markerOptions.icon = {
				url: markerImage,
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(0, 0)
			};
		}

		var marker = new google.maps.Marker(markerOptions);

		google.maps.event.addListener(map, 'zoom_changed', function() {
			zoomLevel = map.getZoom();
			singleupdateZoomLevel(zoomLevel);
		});

		google.maps.event.addListener(map, 'center_changed', function() {
			var centerLatLng = map.getCenter();
			singleupdateCenterPosition(centerLatLng);
		});

		google.maps.event.addListener(marker, 'dragstart', function() {
			singleupdateMarkerAddress('Dragging...');
		});

		google.maps.event.addListener(marker, 'drag', function() {
			singleupdateMarkerAddress('Dragging...');
			singleupdateMarkerPosition(map, marker.getPosition());
		});

		google.maps.event.addListener(marker, 'dragend', function() {
			singlegeocodePosition(marker.getPosition());
		});
	}

	/*
	Multiple contact 
	*/
	var zoomLevel = 8;
	var mapType = 'roadmap';

	function moveMarker(map, marker, location) {
		marker.setPosition(new google.maps.LatLng(location.lat(), location.lng()));
		map.panTo(new google.maps.LatLng(location.lat(), location.lng()));
	}

	function geocodePosition(uuid, marker, pos) {
		geocoder.geocode({
			latLng: pos
		}, function(responses) {
			if (responses && responses.length > 0) {
				updateMarkerAddress(uuid, responses[0].formatted_address);
				updateMarkerPosition(uuid, false, responses[0].geometry.location);
			} else {
				updateMarkerAddress(uuid, '');
			}
		});
	}

	function updateCenterPosition(latLng) {
		//$('#contact_map_center_lat_id').val(latLng.lat());
		//$('#contact_map_center_lng_id').val(latLng.lng());
	}

	function updateMarkerPosition(uuid, map, latLng) {
		$('#multiple_contact_map_lat_' + uuid + '_id').val(latLng.lat());
		$('#multiple_contact_map_lng_' + uuid + '_id').val(latLng.lng());
	}

	function updateMarkerAddress(element, str) {
		$('.' + element).val(str);
	}

	function updateZoomLevel(uuid, zoomLevel) {
		$('#multiple_contact_map_zoom_' + uuid + '_id').val(zoomLevel);
	}

	function updateMapType(map, type) {
		map.setMapTypeId(type);
	}

	$("#multiple_contact_map_add").on('click', function(e) {
		e.preventDefault();

		var current = $('#multiple_contact_locations_id').val();
		var mapIds = current.split("|");

		mapIds.push(new Date().getTime());

		$('#multiple_contact_locations_id').val(mapIds.join('|'));
		$('#submit').click();
	});

	$(".button-remove").on("click", function(e) {
		e.preventDefault();

		if (confirm('Are you sure to remove this location ?')) {
			var uuid = $(this).data('uuid');

			var current = $('#multiple_contact_locations_id').val();
			var mapIds = current.split("|");

			mapIds = $.grep(mapIds, function(value) {
				return value != uuid;
			});

			$('#multiple_contact_locations_id').val(mapIds.join('|'));
			$('#submit').click();
		}
	});

	$('.upload_image_remove_button').on("click", function(e) {
		e.preventDefault();
		$(this).parent().find('#upload_image').val('');

	});

	$(".button-search").on("click", function(e) {
		e.preventDefault();
		var uuid = $(this).data('uuid');
		var address = $('#multiple_contact_map_address_' + uuid + '_id').val();
		var zoom = $('#multiple_contact_map_zoom_' + uuid + '_id').val();
		var markerImage = $('#multiple_contact_map_marker_image_' + uuid + '_id').val();
		var markerWidth = $('#multiple_contact_marker_width_' + uuid + '_id').val();
		var markerHeight = $('#multiple_contact_marker_height_' + uuid + '_id').val();

		geocoder.geocode({
			'address': address
		}, function(results, status) {
			if (status == google.maps.GeocoderStatus.OK) {

				var latLng = new google.maps.LatLng(results[0].geometry.location.lat(), results[0].geometry.location.lng());

				var options = {
					zoom: parseInt(zoom, 10),
					center: latLng,
					mapTypeId: 'roadmap'
				};

				var map = new google.maps.Map($('#map_' + uuid)[0], options);

				var markerOptions = {
					position: latLng,
					title: address,
					map: map,
					draggable: true
				};
				var markerImg = new Image();

				markerImg.onload = function() {
					$('#multiple_contact_marker_width_' + uuid + '_id').val(this.width);
					$('#multiple_contact_marker_height_' + uuid + '_id').val(this.height);
				};

				markerImg.src = markerImage;

				if (markerImage !== '') {
					markerOptions.icon = {
						url: markerImage,
						origin: new google.maps.Point(0, 0),
						anchor: new google.maps.Point(2 + parseInt(markerWidth / 2, 10), parseInt(markerHeight, 10) - 5)
					};
				}

				var marker = new google.maps.Marker(markerOptions);

				updateMarkerPosition(uuid, false, results[0].geometry.location);

				google.maps.event.addListener(map, 'zoom_changed', function() {
					updateZoomLevel(uuid, map.getZoom());
				});

				google.maps.event.addListener(marker, 'dragstart', function() {
					updateMarkerAddress(uuid, 'Dragging...');
				});

				google.maps.event.addListener(marker, 'drag', function() {
					updateMarkerAddress(uuid, 'Dragging...');
					updateMarkerPosition(uuid, map, marker.getPosition());
				});

				google.maps.event.addListener(marker, 'dragend', function() {
					geocodePosition(uuid, marker, marker.getPosition());
				});

				// moveMarker(uuid, map, marker, results[0].geometry.location);
			}
		});
	});



	$(".mulitiple_map_canvas").each(function() {
		var uuid = $(this).data('uuid');
		var lat = $('#multiple_contact_map_lat_' + uuid + '_id').val();
		var lng = $('#multiple_contact_map_lng_' + uuid + '_id').val();
		var zoom = $('#multiple_contact_map_zoom_' + uuid + '_id').val();
		var markerImage = $('#multiple_contact_map_marker_image_' + uuid + '_id').val();
		var markerWidth = $('#multiple_contact_marker_width_' + uuid + '_id').val();
		var markerHeight = $('#multiple_contact_marker_height_' + uuid + '_id').val();

		var latlng = new google.maps.LatLng(lat, lng);

		var i = 0;
		var options = {
			zoom: parseInt(zoom, 10),
			center: latlng,
			mapTypeId: 'roadmap',
		};

		var map = new google.maps.Map($(this)[i], options);
		i++;

		var markerOptions = {
			position: latlng,
			title: 'Location',
			map: map,
			draggable: true
		};

		var markerImg = new Image();

		markerImg.onload = function() {
			$('#multiple_contact_marker_width_' + uuid + '_id').val(this.width);
			$('#multiple_contact_marker_height_' + uuid + '_id').val(this.height);
		};

		markerImg.src = markerImage;

		if (markerImage !== '') {
			markerOptions.icon = {
				url: markerImage,
				origin: new google.maps.Point(0, 0),
				anchor: new google.maps.Point(2 + parseInt(markerWidth / 2, 10), parseInt(markerHeight, 10) - 5)
			};
		}

		var marker = new google.maps.Marker(markerOptions);

		google.maps.event.addListener(marker, 'dragstart', function() {
			updateMarkerAddress(uuid, 'Dragging...');
		});

		google.maps.event.addListener(marker, 'drag', function() {
			updateMarkerAddress(uuid, 'Dragging...');
			updateMarkerPosition(uuid, map, marker.getPosition());
		});

		google.maps.event.addListener(marker, 'dragend', function() {
			geocodePosition(uuid, marker, marker.getPosition());
		});
	});

	/*
	Theme restaurant block grid functions
	*/

	$('.marker').on('input', function(e) {
		var val = $(this).val();
	});

	$("#theme_grid_function").change(function() {
		var functionName = $(this).val();

		$('.function').addClass('hidden');

		$('#function').toggleClass('hidden');
		$('#theme_grid_option_' + functionName).toggleClass('hidden');

		if ((functionName == 'category') || (functionName == 'slider_category') || (functionName == 'opening_hours')) {
			$('#theme_grid_title_hover').prop('disabled', true);
			$('#theme_grid_subtitle_hover').prop('disabled', true);
		} else {
			$('#theme_grid_title_hover').prop('disabled', false);
			$('#theme_grid_subtitle_hover').prop('disabled', false);
		}
	});

	$("#restaurant-block-icon").on("click", function() {
		$(".icon-set").toggle();
	});

	$(".icon-picker i").on("click", function() {
		var activeIcon = $(this).attr('class');

		if (activeIcon == 'no-icon') {
			$("#restaurant-block-icon").attr('class', '');
			$("#restaurant-block-icon").html('empty');
		} else {
			$("#restaurant-block-icon").attr('class', activeIcon);
			$("#restaurant-block-icon").html('');
		}

		$("#theme_grid_icon").val(activeIcon);
		$(".icon-set").toggle();
	});
});