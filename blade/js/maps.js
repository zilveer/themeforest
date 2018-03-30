
(function($) {

	"use strict";
	var Map = {

		init: function() {
			//Map
			this.map();
		},
		map: function(){
			$('.grve-map').each( function() {
				var map = $(this),
					gmapLat = map.attr('data-lat'),
					gmapLng = map.attr('data-lng'),
					draggable = isMobile.any() ? false : true;

				var gmapZoom;
				( parseInt( map.attr('data-zoom') ) ) ? gmapZoom = parseInt( map.attr('data-zoom') ) : gmapZoom = 14 ;

				var gmapDisableStyle;
				map.attr('data-disable-style') ? gmapDisableStyle = map.attr('data-disable-style') : gmapDisableStyle = 'no' ;

				var gmapLatlng = new google.maps.LatLng( gmapLat, gmapLng );
				var gmapCustomEnabled = parseInt(grve_maps_data.custom_enabled);
				var gmapLabelEnabled = parseInt(grve_maps_data.label_enabled);
				var gmapZoomEnabled = parseInt(grve_maps_data.zoom_enabled);
				var labelEnabled = 'off';

				var styles = [];
				if ( 1 == gmapLabelEnabled ) {
					labelEnabled = 'on';
				}

				if ( 1 == gmapCustomEnabled && 'no' == gmapDisableStyle ) {
					styles = [
					  {
							"featureType": "water",
							"stylers": [
								{ "color": grve_maps_data.water_color }
							]
						},{
							"featureType": "landscape",
							"stylers": [
								{ "color": grve_maps_data.lanscape_color }
							]
						},{
							"featureType": "poi",
							"stylers": [
								{ "color": grve_maps_data.poi_color }
							]
						},{
							"featureType": "road",
							"elementType": "geometry",
							"stylers": [
								{ "color": grve_maps_data.road_color }
							]
						},{
							"featureType": "transit",
							"stylers": [
								{ "visibility": "off" }
							]
						},{
							"elementType": "labels.icon",
							"stylers": [
								{ "visibility": "off" }
							]
						},{
							"elementType": "labels.text",
							"stylers": [
								{ "visibility": labelEnabled },
							]
						},{
							"elementType": "labels.text.fill",
							"stylers": [
								{ "color": grve_maps_data.label_color }
							]
						},{
							"featureType": "administrative.country",
							"elementType": "geometry",
							"stylers": [
								{ "color": grve_maps_data.country_color }
							]
						}
					];
				}

				var defaultUI = false,
					enableZoomControl = true;
				if ( 1 == gmapCustomEnabled ) {
					defaultUI = true;
					if ( 1 == gmapZoomEnabled ) {
						enableZoomControl = true;
					} else {
						enableZoomControl = false;
					}
				}

				var mapOptions = {
					zoom: gmapZoom,
					center: gmapLatlng,
					draggable: draggable,
					scrollwheel: false,
					mapTypeControl:false,
					zoomControl: enableZoomControl,
					disableDefaultUI: defaultUI,
					styles: styles,
					zoomControlOptions: {
						style: google.maps.ZoomControlStyle.SMALL,
						position: google.maps.ControlPosition.LEFT_CENTER
					}
				}
				var gmap = new google.maps.Map( map.get(0), mapOptions );

				var mapBounds = new google.maps.LatLngBounds();
				var markers = [];

				map.parent().children('.grve-map-point').each( function() {

					var mapPoint = $(this),
					gmapPointMarker = mapPoint.attr('data-point-marker'),
					gmapPointTitle = mapPoint.attr('data-point-title'),
					gmapPointOpen = mapPoint.attr('data-point-open'),
					gmapPointLat = parseFloat( mapPoint.attr('data-point-lat') ),
					gmapPointLng = parseFloat( mapPoint.attr('data-point-lng') );
					var pointLatlng = new google.maps.LatLng( gmapPointLat , gmapPointLng );
					var marker = new google.maps.Marker({
					  position: pointLatlng,
					  map: gmap,
					  icon: gmapPointMarker,
					  title: gmapPointTitle,
					});

					var data = mapPoint.html();
					if ( '' != data.trim() ) {
						var infowindow = new google.maps.InfoWindow({
							content: data
						});

						google.maps.event.addListener(marker, 'click', function() {
							infowindow.open(gmap,marker);
						});

						if ( 'yes' == gmapPointOpen ) {
							setTimeout(function () {
								infowindow.open(gmap,marker);
							},2000);
						}
					}
					markers.push(marker);
					mapBounds.extend(marker.position);
				});

				if ( map.parent().children('.grve-map-point').length > 1 ) {
					gmap.fitBounds(mapBounds);
					$(window).resize(function() {
						gmap.fitBounds(mapBounds);
					});
				} else {
					$(window).resize(function() {
						gmap.panTo(gmapLatlng);
					});
				}


				map.css({'opacity':0});
				map.delay(600).animate({'opacity':1});

			});
		}
	};
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	// GLOBAL VARIABLES
	//////////////////////////////////////////////////////////////////////////////////////////////////////
	var isMobile = {
		Android: function() {
			return navigator.userAgent.match(/Android/i);
		},
		BlackBerry: function() {
			return navigator.userAgent.match(/BlackBerry/i);
		},
		iOS: function() {
			return navigator.userAgent.match(/iPhone|iPad|iPod/i);
		},
		Opera: function() {
			return navigator.userAgent.match(/Opera Mini/i);
		},
		Windows: function() {
			return navigator.userAgent.match(/IEMobile/i);
		},
		any: function() {
			return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
		}
	};

	Map.init();

	$(window).on("orientationchange",function(){

		setTimeout(function () {
			Map.init();
		},500);

	});

	$('.grve-tabs-title li').click(function () {
		var tabRel = $(this).attr('data-rel');
		if ( '' != tabRel && $(tabRel + ' .grve-map').length ) {
			setTimeout(function () {
				Map.init();
			},500);
		}
	});

	$(window).load( function() {

		var userAgent = userAgent || navigator.userAgent;
		var isIE = userAgent.indexOf("MSIE ") > -1 || userAgent.indexOf("Trident/") > -1 || userAgent.indexOf("Edge/") > -1;

		if ( $('#grve-body').hasClass( 'compose-mode' ) || ( $('#grve-feature-section .grve-map').length && isIE ) ) {
			Map.init();
		}

	});

})(jQuery);