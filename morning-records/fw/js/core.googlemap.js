function morning_records_googlemap_init(dom_obj, coords) {
	"use strict";
	if (typeof MORNING_RECORDS_STORAGE['googlemap_init_obj'] == 'undefined') morning_records_googlemap_init_styles();
	MORNING_RECORDS_STORAGE['googlemap_init_obj'].geocoder = '';
	try {
		var id = dom_obj.id;
		MORNING_RECORDS_STORAGE['googlemap_init_obj'][id] = {
			dom: dom_obj,
			markers: coords.markers,
			geocoder_request: false,
			opt: {
				zoom: coords.zoom,
				center: null,
				scrollwheel: false,
				scaleControl: false,
				disableDefaultUI: false,
				panControl: true,
				zoomControl: true, //zoom
				mapTypeControl: false,
				streetViewControl: false,
				overviewMapControl: false,
				styles: MORNING_RECORDS_STORAGE['googlemap_styles'][coords.style ? coords.style : 'default'],
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
		};
		
		morning_records_googlemap_create(id);

	} catch (e) {
		
		dcl(MORNING_RECORDS_STORAGE['strings']['googlemap_not_avail']);

	};
}

function morning_records_googlemap_create(id) {
	"use strict";

	// Create map
	MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].map = new google.maps.Map(MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].dom, MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].opt);

	// Add markers
	for (var i in MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers)
		MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].inited = false;
	morning_records_googlemap_add_markers(id);
	
	// Add resize listener
	jQuery(window).resize(function() {
		if (MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].map)
			MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].map.setCenter(MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].opt.center);
	});
}

function morning_records_googlemap_add_markers(id) {
	"use strict";
	for (var i in MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers) {
		
		if (MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].inited) continue;
		
		if (MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].latlng == '') {
			
			if (MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].geocoder_request!==false) continue;
			
			if (MORNING_RECORDS_STORAGE['googlemap_init_obj'].geocoder == '') MORNING_RECORDS_STORAGE['googlemap_init_obj'].geocoder = new google.maps.Geocoder();
			MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].geocoder_request = i;
			MORNING_RECORDS_STORAGE['googlemap_init_obj'].geocoder.geocode({address: MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].address}, function(results, status) {
				"use strict";
				if (status == google.maps.GeocoderStatus.OK) {
					var idx = MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].geocoder_request;
					if (results[0].geometry.location.lat && results[0].geometry.location.lng) {
						MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = '' + results[0].geometry.location.lat() + ',' + results[0].geometry.location.lng();
					} else {
						MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = results[0].geometry.location.toString().replace(/\(\)/g, '');
					}
					MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].geocoder_request = false;
					setTimeout(function() { 
						morning_records_googlemap_add_markers(id); 
						}, 200);
				} else
					dcl(MORNING_RECORDS_STORAGE['strings']['geocode_error'] + ' ' + status);
			});
		
		} else {
			
			// Prepare marker object
			var latlngStr = MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].latlng.split(',');
			var markerInit = {
				map: MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].map,
				position: new google.maps.LatLng(latlngStr[0], latlngStr[1]),
				clickable: MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].description!=''
			};
			if (MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].point) markerInit.icon = MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].point;
			if (MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].title) markerInit.title = MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].title;
			MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].marker = new google.maps.Marker(markerInit);
			
			// Set Map center
			if (MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].opt.center == null) {
				MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].opt.center = markerInit.position;
				MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].map.setCenter(MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].opt.center);				
			}
			
			// Add description window
			if (MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].description!='') {
				MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].infowindow = new google.maps.InfoWindow({
					content: MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].description
				});
				google.maps.event.addListener(MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].marker, "click", function(e) {
					var latlng = e.latLng.toString().replace("(", '').replace(")", "").replace(" ", "");
					for (var i in MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers) {
						if (latlng == MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].latlng) {
							MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].infowindow.open(
								MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].map,
								MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].marker
							);
							break;
						}
					}
				});
			}
			
			MORNING_RECORDS_STORAGE['googlemap_init_obj'][id].markers[i].inited = true;
		}
	}
}

function morning_records_googlemap_refresh() {
	"use strict";
	for (id in MORNING_RECORDS_STORAGE['googlemap_init_obj']) {
		morning_records_googlemap_create(id);
	}
}

function morning_records_googlemap_init_styles() {
	// Init Google map
	MORNING_RECORDS_STORAGE['googlemap_init_obj'] = {};
	MORNING_RECORDS_STORAGE['googlemap_styles'] = {
		'default': []
	};
	if (window.morning_records_theme_googlemap_styles!==undefined)
		MORNING_RECORDS_STORAGE['googlemap_styles'] = morning_records_theme_googlemap_styles(MORNING_RECORDS_STORAGE['googlemap_styles']);
}