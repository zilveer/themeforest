/**
 * Oxygenna.com
 *
 * $Template:: *(TEMPLATE_NAME)*
 * $Copyright:: *(COPYRIGHT)*
 * $Licence:: *(LICENCE)*
 */

(function( $ ){

    $(document).ready(function($){
        var styles = [
            {
                stylers: [
                    { saturation: -85 }
                ]
            },{
                featureType: 'road',
                elementType: 'geometry',
                stylers: [
                    { hue: "#002bff" },
                    { visibility: 'simplified' }
                ]
            },{
                featureType: 'road',
                elementType: 'labels',
                stylers: [
                    { visibility: 'off' }
                ]
            }
        ],
        // put your locations lat and long here
        lat  = mapData.lat,
        lng  = mapData.lng,

        // Create a new StyledMapType object, passing it the array of styles,
        // as well as the name to be displayed on the map type control.
        styledMap = new google.maps.StyledMapType(styles,
          {name: 'Styled Map'}),

        // Create a map object, and include the MapTypeId to add
        // to the map type control.
        mapOptions = {
          zoom: parseInt(mapData.zoom, 10),
          scrollwheel: false,
          center: new google.maps.LatLng( lat, lng ),
          mapTypeControlOptions: {
              mapTypeIds: [google.maps.MapTypeId.ROADMAP]
          }
        },
        map = new google.maps.Map(document.getElementById('map'), mapOptions),
        charlotte = new google.maps.LatLng( lat, lng ),

        marker = new google.maps.Marker({
            position: charlotte,
            map: map
        });
        //Associate the styled map with the MapTypeId and set it to display.
        map.mapTypes.set('map_style', styledMap);
        map.setMapTypeId('map_style');

    });

})( jQuery );