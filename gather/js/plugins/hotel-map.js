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
