(function($){
	'use strict';



$ = jQuery.noConflict();	

var _id = null;
var _input = null;
var send = null;
// jQuery(document).ready(function() {
	jQuery(document).on('click', '.upload_image_button', function() {
		var formfield = '';
		jQuery('.fancybox-overlay').css('display', 'none');
		formfield = jQuery(this).parent().find('#upload_image').attr('name');
		tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&amp;height=700&amp;width=800');
		_input = jQuery(this).prev();
		_id = jQuery(this).attr('data-id');
		return false;
	});

	var old_tb_remove = window.tb_remove;

	window.tb_remove = function() {
		jQuery('.fancybox-overlay').css('display', 'block');
		old_tb_remove();
	};

	send = window.send_to_editor;
	window.send_to_editor = function(html) {
		if(_id != null && _input != null) {
			var content = jQuery(html);
			var href = content.attr('href');
			var url = jQuery(html).find('img').attr('src');
			_input.val(href);
			//_input.val(url);
			jQuery('#image_upload_preview_'+_id).attr('src', url);
			jQuery('#image_upload_preview_'+_id).parent().removeClass('nonactive');
			tb_remove();
			jQuery('.fancybox-overlay').css('display', 'block');
			_id = null;
			_input = null;
		} else {
			send(html);
		}
	};

	jQuery('.upload_image_remove_button').on('click', function() {
		jQuery('.uploadinput-' + jQuery(this).data('id')).val('');
		jQuery('#image_upload_preview_' + jQuery(this).data('id')).attr('src', '');
		var img = jQuery('#image_upload_preview_' + jQuery(this).data('id'));
		var cloneImg = img.clone();
		var parent = img.parent();
		img.parent().addClass('nonactive');
		img.remove();
		parent.append(cloneImg);
	});
// });
/* 
	Google map
	*/
	// var googleMap = {
	// 	init: function() {
	// 		$(".mulitiple_map_canvas").each(function() {
	// 			var uuid = $(this).data('uuid');
	// 			var lat = $('#multiple_contact_map_lat_' + uuid + '_id').val();
	// 			var lng = $('#multiple_contact_map_lng_' + uuid + '_id').val();
	// 			var zoom = $('#multiple_contact_map_zoom_' + uuid + '_id').val();
	// 			var markerImage = $('#multiple_contact_map_marker_image_' + uuid + '_id').val();
	// 			var markerWidth = $('#multiple_contact_marker_width_' + uuid + '_id').val();
	// 			var markerHeight = $('#multiple_contact_marker_height_' + uuid + '_id').val();

	// 			var latlng = new google.maps.LatLng(lat, lng);

	// 			var i = 0;
	// 			var options = {
	// 				zoom: parseInt(zoom, 10),
	// 				center: latlng,
	// 				mapTypeId: 'roadmap',
	// 			};

	// 			var map = new google.maps.Map($(this)[i], options);
	// 			i++;

	// 			var markerOptions = {
	// 				position: latlng,
	// 				title: 'Location',
	// 				map: map,
	// 				draggable: true
	// 			};

	// 			var markerImg = new Image();

	// 			markerImg.onload = function() {
	// 				$('#multiple_contact_marker_width_' + uuid + '_id').val(this.width);
	// 				$('#multiple_contact_marker_height_' + uuid + '_id').val(this.height);
	// 			};

	// 			markerImg.src = markerImage;

	// 			if (markerImage !== '') {
	// 				markerOptions.icon = {
	// 					url: markerImage,
	// 					origin: new google.maps.Point(0, 0),
	// 					anchor: new google.maps.Point(2 + parseInt(markerWidth / 2, 10), parseInt(markerHeight, 10) - 5)
	// 				};
	// 			}

	// 			var marker = new google.maps.Marker(markerOptions);

	// 			google.maps.event.addListener(marker, 'dragstart', function() {
	// 				updateMarkerAddress(uuid, 'Dragging...');
	// 			});

	// 			google.maps.event.addListener(marker, 'drag', function() {
	// 				updateMarkerAddress(uuid, 'Dragging...');
	// 				updateMarkerPosition(uuid, map, marker.getPosition());
	// 			});

	// 			google.maps.event.addListener(marker, 'dragend', function() {
	// 				geocodePosition(uuid, marker, marker.getPosition());
	// 			});
	// 			$('.map_'+uuid).parents('.form-field').css('display', 'table-row');
	// 		});
	// 	},
	// };

$(document).ready(function($) {
	// 'use strict';

	$('.contact-editor').each(function(i, el){
		redux.fields.editor[el.id] = 1;
	});

	/*
	Home page vide auto save
	*/
	$('#slider_video_type_id').change(function() {
		$('#submit').click();
	});

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
	Google map
	*/
	var googleMap = {
		init: function() {
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
				$('.map_'+uuid).parents('.form-field').css('display', 'table-row');
			});
		},
	};

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

		var date = new Date().getTime();
		var mapCount = mapIds.push(date);
		var newId = mapIds[mapIds.length-1];

		$.post(ajaxurl, { action: 'get_map_template', id: newId, i: mapCount }, function(response){
			$('.contact_info_section .form-table tbody .add-new-map').before(response);
			googleMap.init();
			$('#multiple_contact_locations_id').val(mapIds.join('|'));
			$(".button-remove-map").on("click", function(e) {
				e.preventDefault();
				if (confirm('Are you sure to remove this location ?')) {
					$('.map_id_'+newId+'').remove();
				}
			});

			tinyMCEPreInit.mceInit['multiple_contact_address_desc_'+date+'_id'] = tinyMCEPreInit.mceInit.multiple_contact_address_desc_1_id;
			tinyMCEPreInit.mceInit['multiple_contact_address_desc_'+date+'_id'].selector = '#multiple_contact_address_desc_'+date+'_id';
			var str = tinyMCEPreInit.mceInit['multiple_contact_address_desc_'+date+'_id'].body_class;
			tinyMCEPreInit.mceInit['multiple_contact_address_desc_'+date+'_id'].body_class = str.replace('desc_1_id', 'desc_'+date+'_id');
			
			var init, id, $wrap;
			if ( typeof tinymce !== 'undefined' ) {
				for ( id in tinyMCEPreInit.mceInit ) {
					init = tinyMCEPreInit.mceInit[id];
					$wrap = tinymce.$( '#wp-' + id + '-wrap' );
					if ( ( $wrap.hasClass( 'tmce-active' ) || ! tinyMCEPreInit.qtInit.hasOwnProperty( id ) ) && ! init.wp_skip_init ) {
						tinymce.init( init );
						if ( ! window.wpActiveEditor ) {
							window.wpActiveEditor = id;
						}
					}
				}
			}

			if ( typeof quicktags !== 'undefined' ) {
				for ( id in tinyMCEPreInit.qtInit ) {
					quicktags( tinyMCEPreInit.qtInit[id] );

					if ( ! window.wpActiveEditor ) {
						window.wpActiveEditor = id;
					}
				}
			}
			$('.contact-editor').each(function(i, el){
				redux.fields.editor['multiple_contact_address_desc_'+date+'_id'] = 1;
			});
			
		});
	});

	$(".button-remove-map").on("click", function(e) {
		e.preventDefault();

		if (confirm('Are you sure to remove this location ?')) {
			var uuid = $(this).data('uuid');

			var current = $('#multiple_contact_locations_id').val();
			var mapIds = current.split("|");

			mapIds = $.grep(mapIds, function(value) {
				return value != uuid;
			});
			$('.map_id_'+uuid+'').remove();
			$('#multiple_contact_locations_id').val(mapIds.join('|'));
			$('#submit').click();
		

		}
	});

	$('.contact_info_section').on("click", '.upload_image_remove_button', function(e) {
		e.preventDefault();
		$(this).parent().find('#upload_image').val('');

	});

	$(".contact_info_section").on("click", '.button-search', function(e) {
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
	googleMap.init();
	redux.field_objects = redux.field_objects || {};
	redux.field_objects.multiple_map = redux.field_objects.multiple_map || {};

	redux.field_objects.multiple_map.init = function(selector) {
	   	// if ( !selector ) {
        selector = $( document ).find( ".contact_info_section:visible" ).find( '.mulitiple_map_canvas:visible' );
        googleMap.init();
        // }
        
	}

	// (function($) {

	// });
	
});

})(jQuery);