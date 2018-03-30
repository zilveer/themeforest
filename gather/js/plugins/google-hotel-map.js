/* Initialize Google Maps */

function googleMap() {

    jQuery('.map').each(function(i, e) {

        $map = jQuery(e);
        $map_lat = $map.attr('data-mapLat');
        $map_lon = $map.attr('data-mapLon');
        $map_zoom = parseInt($map.attr('data-mapZoom'));
        $map_title = $map.attr('data-mapTitle');
        $map_info = $map.attr('data-info');
        $map_img = $map.attr('data-img');
        $map_color = $map.attr('data-color');
        $map_height = $map.attr('data-height');

        var latlng = new google.maps.LatLng($map_lat, $map_lon);
        var options = {
            scrollwheel: false,
            draggable: false,
            zoomControl: false,
            disableDoubleClickZoom: true,
            disableDefaultUI: true,
            zoom: $map_zoom,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        /* Map's style */
        var colors = {
            red1: "#fd685b",
            red2: "#fe8e84",
            orange1: "#fa6f57",
            orange2: "#fb9381",
            yellow1: "#fecd5e",
            yellow2: "#fedc8f",
            green1: "#4eae49",
            green2: "#73c16f",
            mint1: "#4fcead",
            mint2: "#7bdac2",
            aqua1: "#4FC1E9",
            aqua2: "#73d2f4",
            blue1: "#5D9CEC",
            blue2: "#86b5f1",
            purple1: "#ab94e9",
            purple2: "#c0afef",
            pink1: "#ea89bf",
            pink2: "#efa7cf",
            white1: "#E6E9ED",
            white2: "#F5F7FA",
            grey1: "#AAB2BD",
            grey2: "#CCD1D9",
            black1: "#434A54",
            black2: "#5f656d"
        };

        if ($map_color == 'invert') {

            var styles = [{
                    "stylers": [{
                        "invert_lightness": "true"
                    }, {
                        "hue": "0xffbb00"
                    }, {
                        "saturation": "-100"
                    }, {
                        "lightness": "15"
                    }]
                }],
                textcolor = '#333';

        } else {

            var styles = [{
                    "elementType": "geometry.stroke",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "water",
                    "stylers": [{
                        "color": colors[$map_color + "1"]
                    }]
                }, {
                    "featureType": "water",
                    "elementType": "labels.icon",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "landscape.natural",
                    "stylers": [{
                        "color": colors[$map_color + "2"]
                    }]
                }, {
                    "featureType": "road",
                    "elementType": "geometry",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "poi",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "road",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "transit",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "landscape.man_made",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }, {
                    "featureType": "administrative",
                    "stylers": [{
                        "visibility": "off"
                    }]
                }],
                textcolor = colors[$map_color + "1"];

        }

        var styledMap = new google.maps.StyledMapType(styles, {
            name: "Styled Map"
        });

        var map = new google.maps.Map($map[0], options);

        var icon = {
            url: $map_img,
            size: null,
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(26, 26),
            scaledSize: new google.maps.Size(52, 52)
        };

        var marker = new google.maps.Marker({
            position: latlng, // loc is a variable with my lngLat object
            title: $map_title,
            map: map,
            icon: icon
        });

        map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');

        var contentString = '<div class="infobox-inner" style="color: ' + textcolor + ';">' + $map_info + '</div>';

        /* + '<br> <a href="#directions" class="btn btn-outline btn-xs vertical-space-sm"> Get Directions </a>' + */

        /* Custom infowindow code; it has been replaced by the code below, using Infobox plugin

        var infowindow = new google.maps.InfoWindow({
            content: contentString
        });
            
        google.maps.event.addListener(marker, 'click', function() {
            infowindow.open(map,marker);
        });
        infowindow.open(map,marker); // To force Infowindow open

        */

        var infobox = new InfoBox({
            content: contentString,
            disableAutoPan: false,
            maxWidth: 0,
            zIndex: null,
            boxStyle: {
                width: "280px"
            },
            closeBoxURL: "",
            pixelOffset: new google.maps.Size(-140, 40),
            infoBoxClearance: new google.maps.Size(1, 1)
        });

        // user defined size
        $map.css({
            'height': $map_height + 'px'
        });

        google.maps.event.addListener(marker, 'click', function() {
            infobox.open(map, marker);
        });
        infobox.open(map, marker); // To force Infowindow open

        // center map on resize
        google.maps.event.addDomListener(window, "resize", function() {
            var center = map.getCenter();
            google.maps.event.trigger(map, "resize");
            map.setCenter(center);
        });

    });

}

if (jQuery('.map').length) {

    googleMap();

}
var hmap;
var hinfowindow;
var service;

var h_website ;
function hotelMap(){
    jQuery('.hotel-map').each(function(i,e){
        $map = jQuery(e);
        $map_lat = $map.attr('data-mapLat');
        $map_lon = $map.attr('data-mapLon');
        $map_zoom = parseInt($map.attr('data-mapZoom'));
        $map_height = $map.attr('data-height');
        $distance = parseInt($map.attr('data-distance'));
        $types = $map.attr('data-types');

        var latlng = new google.maps.LatLng($map_lat, $map_lon);

        //var pyrmont = {lat: $map_lat, lng: $map_lon};

        hmap = new google.maps.Map($map[0], {
            center: latlng,
            zoom: $map_zoom,
            scrollwheel: false,
        });

        $map.css({
            'height': $map_height + 'px'
        });

        hinfowindow = new google.maps.InfoWindow();

        service = new google.maps.places.PlacesService(hmap);
        service.nearbySearch({
            location: latlng,
            radius: $distance,
            //types: ['lodging'],
            types: $types.split(','),
            //minPriceLevel: 1
        }, callback);


    });
}

function callback(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
        for (var i = 0; i < results.length; i++) {
            //console.log(results[i]);
            createMarker(results[i]);
            //createMarkers(results);
        }
    }
}

function createMarkers(places){
    var hotelsSlider = document.getElementById('hotels-slider');

    var bounds = new google.maps.LatLngBounds();
    //var h_website ;

    for (var i = 0, place; place = places[i]; i++) {
        console.log(place);
        var image = {
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(25, 25)
        };

        var marker = new google.maps.Marker({
            map: hmap,
            icon: image,
            title: place.name,
            position: place.geometry.location
        });

        service.getDetails({placeId: place.place_id},function(dplace,status){
            if (status === google.maps.places.PlacesServiceStatus.OK) {
                h_website = dplace.website;
            }
        });
        /*
        hotelsSlider.innerHTML += '<div class="thumbnail wow fadeInUp" data-wow-delay="0.3s">'
                        +'<img src="images/hotel_2.jpg" alt="The Four Seasons Hotel">'
                        +'<div class="caption">'
                            +'<h6 class="caption-title">'+place.name+'</h6>'
                            +'<p class="caption-text">From $120 per night</p>'
                            +'<p class="text-center"><a href="'+h_website+'" class="btn btn-outline" role="button">Visit Website</a> </p>'
                        +'</div>'
                    +'</div>';
        */

        var info_content = '<div class="thumbnail">';
        var photos = place.photos;
        if(photos){
            console.log(photos);
            info_content += '<img src="'+photos[0].getUrl({'maxWidth': 358, 'maxHeight': 358})+'" alt="'+place.name+'">';
        }
            info_content +='<div class="caption">'
                            +'<h6 class="caption-title">'+place.name+'</h6>'
                            +'<p class="caption-text">From $120 per night</p>'
                            +'<p class="text-center"><a href="'+h_website+'" class="btn btn-outline" role="button">Visit Website</a> </p>'
                        +'</div>'
                    +'</div>';
        bounds.extend(place.geometry.location);

        google.maps.event.addListener(marker, 'click', function() {
            hinfowindow.setContent(info_content);
            hinfowindow.open(hmap, this);
        });
    }

    hmap.fitBounds(bounds);

}

function createMarker(place) {
    //var placeLoc = place.geometry.location;
    var hotelsSlider = document.getElementById('hotels-slider');
    var photos = place.photos;
    
    if (!photos) {
        return;
    }

    var image = {
        url: place.icon,
        size: new google.maps.Size(71, 71),
        origin: new google.maps.Point(0, 0),
        anchor: new google.maps.Point(17, 34),
        scaledSize: new google.maps.Size(25, 25)
    };

    var marker = new google.maps.Marker({
        map: hmap,
        icon: image,
        title: place.name,
        position: place.geometry.location
    });


    // var marker = new google.maps.Marker({
    //     map: hmap,
    //     position: place.geometry.location,
    //     title: place.name,
    //     icon: photos[0].getUrl({'maxWidth': 35, 'maxHeight': 35})
    // });


    var h_web,h_address,h_phone,h_rating;
    service.getDetails({placeId: place.place_id},function(hplace,status){
        if (status === google.maps.places.PlacesServiceStatus.OK) {
            //console.log(hplace);
            h_web = hplace.website;
            h_address = hplace.formatted_address;
            h_phone = hplace.formatted_phone_number;
            h_rating = hplace.rating;
        }
    });

    

    google.maps.event.addListener(marker, 'click', function() {
        //console.log(place);
        var info_content = '<div class="thumbnails">';
        
        if(photos){
            //console.log(photos);
            //info_content += '<img src="'+photos[0].getUrl({'maxWidth': 358, 'maxHeight': 358})+'" alt="'+place.name+'">';
        }
            info_content +='<div class="caption">'
                            +'<h6 class="caption-title">'+place.name+'</h6>';
                if (h_address) {
                    info_content +='<p class="caption-text">Address: '+h_address+'</p>';
                }
                if (h_phone) {
                    info_content +='<p class="caption-text">Phone: '+h_phone+'</p>';
                }
                if (h_rating) {
                    info_content +='<p class="caption-text">Rating: '+h_rating+'/5</p>';
                }
                if (h_web) {
                    info_content +='<p ><a href="'+h_web+'" class="btn btn-outline" role="button" target="_blank">Visit Website</a> </p>';
                }

                        info_content +='</div>'
                    +'</div>';
        hinfowindow.setContent(info_content);
        hinfowindow.open(hmap, this);
    });
}

if (jQuery('.hotel-map').length) {

    hotelMap();

}
