/* global jQuery:false */
/* global MORNING_RECORDS_STORAGE:false */


// Theme-specific first load actions
//==============================================
function morning_records_theme_ready_actions() {
	"use strict";
	// Put here your init code with theme-specific actions
	// It will be called before core actions
}


// Theme-specific scroll actions
//==============================================
function morning_records_theme_scroll_actions() {
	"use strict";
	// Put here your theme-specific code with scroll actions
	// It will be called when page is scrolled (before core actions)
}


// Theme-specific resize actions
//==============================================
function morning_records_theme_resize_actions() {
	"use strict";
	// Put here your theme-specific code with resize actions
	// It will be called when window is resized (before core actions)
}


// Theme-specific shortcodes init
//=====================================================
function morning_records_theme_sc_init(cont) {
	"use strict";
	// Put here your theme-specific code to init shortcodes
	// It will be called before core init shortcodes
	// @param cont - jQuery-container with shortcodes (init only inside this container)
}


// Theme-specific post-formats init
//=====================================================
function morning_records_theme_init_post_formats() {
	"use strict";
	// Put here your theme-specific code to init post-formats
	// It will be called before core init post_formats when page is loaded or after 'Load more' or 'Infinite scroll' actions
}


// Theme-specific GoogleMap styles
//=====================================================
function morning_records_theme_googlemap_styles($styles) {
	"use strict";
	// Put here your theme-specific code to add GoogleMap styles
	// It will be called before GoogleMap init when page is loaded
    $styles['greyscale'] = [{
        "featureType": "administrative",
        "elementType": "geometry",
        "stylers": [{"color": "#ebe9e7"}]
    }, {
        "featureType": "administrative",
        "elementType": "labels.text.fill",
        "stylers": [{"visibility": "on"}, {"color": "#737373"}]
    }, {
        "featureType": "landscape",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}, {"color": "#ebe9e7"}]
    }, {
        "featureType": "poi",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}, {"color": "#ebe9e7"}]
    }, {"featureType": "poi", "elementType": "labels", "stylers": [{"visibility": "off"}]}, {
        "featureType": "poi",
        "elementType": "labels.icon",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "road",
        "elementType": "labels.text.fill",
        "stylers": [{"color": "#696969"}]
    }, {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [{"visibility": "off"}]
    }, {
        "featureType": "road.highway",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#ebe9e7"}]
    }, {
        "featureType": "road.highway",
        "elementType": "geometry.stroke",
        "stylers": [{"visibility": "on"}, {"color": "#b3b3b3"}]
    }, {
        "featureType": "road.arterial",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#ebe9e7"}]
    }, {
        "featureType": "road.arterial",
        "elementType": "geometry.stroke",
        "stylers": [{"color": "#d6d6d6"}]
    }, {
        "featureType": "road.local",
        "elementType": "geometry.fill",
        "stylers": [{"visibility": "on"}, {"color": "#ebe9e7"}, {"weight": 1.8}]
    }, {
        "featureType": "road.local",
        "elementType": "geometry.stroke",
        "stylers": [{"color": "#d7d7d7"}]
    }, {
        "featureType": "transit",
        "elementType": "all",
        "stylers": [{"color": "#808080"}, {"visibility": "off"}]
    }, {
        "featureType": "water",
        "elementType": "geometry.fill",
        "stylers": [{"color": "#dad5d2"}]
    }, {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [{"visibility": "off"}]
        }
    ];
	$styles['inverse'] = [
		{ "stylers": [
			{ "invert_lightness": true },
			{ "visibility": "on" }
			]
		}
	];
	$styles['simple'] = [
    	{ stylers: [
        	{ hue: "#00ffe6" },
            { saturation: -20 }
			]
		},
		{ featureType: "road",
          elementType: "geometry",
          stylers: [
			{ lightness: 100 },
           	{ visibility: "simplified" }
            ]
		},
		{ featureType: "road",
          elementType: "labels",
          stylers: [
          	{ visibility: "off" }
            ]
		}
	];
	return $styles;
}
