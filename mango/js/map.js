    /* Map */
(function () {
//    "use strict";

    if (document.getElementById("map")) {
        var locations = [
            ['<div class="map-info-box">'+js_mango_vars.addres+'</div>', js_mango_vars.lat, js_mango_vars.lng, 9]
        ];

        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 17,
            center: new google.maps.LatLng(js_mango_vars.lat, js_mango_vars.lng),
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var infowindow = new google.maps.InfoWindow();


        var marker, i;

        for (i = 0; i < locations.length; i++) {
            marker = new google.maps.Marker({
                position: new google.maps.LatLng(locations[i][1], locations[i][2]),
                map: map,
                animation: google.maps.Animation.DROP,
                icon: js_mango_vars.pin_path
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
                }
            })(marker, i));
        }
    }

}());