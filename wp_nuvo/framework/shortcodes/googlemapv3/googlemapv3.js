jQuery(function($){
	"use strict";
	$(".map-render").each(function(){

		/* map type */
		var map_type;
		switch ($(this).attr('data-type')) {
		case 'HYBRID':
			map_type = google.maps.MapTypeId.HYBRID;
			break;
		case 'SATELLITE':
			map_type = google.maps.MapTypeId.SATELLITE;
			break;
		case 'TERRAIN':
			map_type = google.maps.MapTypeId.TERRAIN;
			break;
		default:
			map_type = google.maps.MapTypeId.ROADMAP;
			break;
		}

		/* get controls */
		var controls = $.parseJSON(decodeURIComponent($(this).attr('data-controls')));

		/* get style */
		var style;
		if(controls.style == 'custom'){
			style = $.parseJSON(decodeURIComponent(atob($(this).attr('data-template'))));
		} else {
			style = $.parseJSON(decodeURIComponent($(this).attr('data-template')));
		}

		var mapOptions = {
			    zoom: parseInt($(this).attr('data-zoom')),
                center: new google.maps.LatLng(40.7143528, -74.0059731),
                mapTypeId: map_type,
                scrollwheel: controls.scrollwheel,
			    panControl: controls.pancontrol,
			    zoomControl: controls.zoomcontrol,
			    scaleControl: controls.scalecontrol,
			    mapTypeControl: controls.maptypecontrol,
			    streetViewControl:controls.streetviewcontrol,
			    overviewMapControl: controls.overviewmapcontrol,
			    styles: style
			  }
		var map = new google.maps.Map($(this).get(0),mapOptions);

		/* map center */
		if($(this).attr('data-coordinate').length > 0){
			var coordinate = $(this).attr('data-coordinate').split(',');
			if (coordinate.length == 2){
				map.setCenter(new google.maps.LatLng(coordinate[0],coordinate[1]));
			}
		} else {
			if($(this).attr('data-address').length > 0){
				$.getJSON('http://maps.google.com/maps/api/geocode/json?address='+$(this).attr('data-address')+'', function(data) {
					var lat = data.results[0].geometry.location.lat;
					var lng = data.results[0].geometry.location.lng;
					map.setCenter(new google.maps.LatLng(lat,lng));
				});
			}
		}
		/* marker */
		var locations = $.parseJSON(decodeURIComponent($(this).attr('data-marker')));

		if(locations.markerlist != undefined){
			locations.markerlist = $.parseJSON(decodeURIComponent(atob(locations.markerlist)));
			if(Array.isArray(locations.markerlist)){
				for(var i = 0; i < locations.markerlist.length ; i++){
					locations.markerdesc = '<div class="info-content"><h5>'+locations.markerlist[i].title+'</h5><span>'+locations.markerlist[i].desc+'</span></div>';
					locations.markercoordinate = locations.markerlist[i].coordinate;
					locations.markericon = locations.markerlist[i].icon;
					markerRender(map,locations);
				}
			}
		}

		if(locations.markercoordinate != undefined){
			markerRender(map,locations);
		}
		/* */
		function markerRender(map,locations) {
			"use strict";
			var location = locations.markercoordinate.split(',');
	    	if (location.length == 2){
	    		 	var myLatLng = new google.maps.LatLng(location[0], location[1]);
	    		 	
	    		 	var mk = {position: myLatLng, map: map}
	    		 	
	    		 	if(locations.markericon != false){ mk.icon = locations.markericon; }
	    		 	
	    		 	var marker = new google.maps.Marker(mk);
	    		    marker.setMap(map);
	    		    if(locations.markerdesc != undefined){
		    		    var infowindow = new google.maps.InfoWindow({
		    		        content: locations.markerdesc,
		    		        maxWidth: controls.infowidth,
		    		    });
		    		    if(controls.infoclick){
		    		    	google.maps.event.addListener(marker, 'click', function() {
		    		    	    infowindow.open(map,marker);
		    		    	});
		    		    } else {
		    		    	infowindow.open(map,marker);
		    		    }
	    		    }
	    	}
		}
	});
});