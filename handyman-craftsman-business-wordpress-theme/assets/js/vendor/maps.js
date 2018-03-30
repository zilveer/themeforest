var tl_geocoder;
var $tl_map;
var $tl_marker = false;

jQuery(function ($) {
    "use strict";

/**
 * Map Widget JS file
 *
 * Initiali created by:
 * Author: Obox Themes
 * Author URI: http://www.oboxthemes.com/
 * License: GNU General Public License v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Changed by Themelaboratory:
 *  - Default zoom was set to 10. This value has been changed to 17.
 *  - Added infobox instead default gmaps marker
*/
    jQuery(document).ready(function($){
        tl_geocoder = new google.maps.Geocoder();

        $(document).on( 'click' , '.layers-check-address' , function(e){
            e.preventDefault();
            $tl_map = $(this).closest( '.layers-map' );
            var $address = $(this).closest( '.layers-content' ).find('input[id$="google_maps_location"]').val();
            var $longlat = $(this).closest( '.layers-content' ).find('input[id$="google_maps_long_lat"]').val();
            $tl_map.data( 'location' , $address.toString() );
            $tl_map.data( 'longlat' , $longlat.toString() );
            tl_layers_check_address($);
        });
        tl_layers_check_address($);
    });

    function tl_layers_check_address($){

        var info_triggered = false;

        jQuery('.layers-map').each(function(){
            //"Hi Mom"
            var $that = $(this);

            var $longlat = ( undefined !== $that.data( 'longlat' ) ) ? $that.data( 'longlat' ) : null;

            if( null !== $longlat ){
                var $longlat_array = $longlat.split(",");
                var latitude = $longlat_array[0];
                var longitude = $longlat_array[1];
            } else {
                var latitude = "-34.397";
                var longitude = "150.644";
            }

            var latlng = new google.maps.LatLng( latitude, longitude );

           // var styles = [{"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}];
          //  var styledMap = new google.maps.StyledMapType(styles,  {name: "Styled Map"});
            var zoom_level = $that.data('zoom-level');

            $tl_map = new google.maps.Map( $that[0] ,
                {
                    scrollwheel: false,
                    zoom: zoom_level,
                    center: latlng,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                }
            );

           /*  $tl_map.mapTypes.set('map_style', styledMap);
             $tl_map.setMapTypeId('map_style');*/

            /* Enable infobox */
            var enable_infobox = !$(this).closest("div.layers-contact-widget").hasClass("no-infobox");

            if( undefined !== $that.data( 'longlat' ) ){

                /**
                 * Set the marker on Longitude and Latitude
                 */
                var $longlat_marker = new google.maps.LatLng( latitude, longitude );
                // Center the map
                $tl_map.setCenter( latlng );

                // Add the map marker
                $tl_marker = new google.maps.Marker({
                    map: $tl_map,
                    position: $longlat_marker,
                    zIndex: google.maps.Marker.MAX_ZINDEX + 1,
                    icon:  TL_CONF.themeurl + '/assets/images/google-marker.png'
                });

                if(!info_triggered && enable_infobox){
                    info_triggered = true;
                    $("body").trigger("setInfobox");
                }else{
                    $tl_marker.setMap($tl_map);
                }
            }


            if( undefined !== $that.data( 'location' ) && $tl_marker === false ){
                /**
                * Set the marker on the text location
                */
                var $location = $that.data( 'location' );

                tl_geocoder.geocode( { 'address': $location},
                    function(results, status) {

                        if (status == google.maps.GeocoderStatus.OK) {
                            // Center the map
                            $tl_map.setCenter( ( results[0].geometry.location ? results[0].geometry.location : latlng ) );

                            // Add the map marker
                            $tl_marker = new google.maps.Marker({
                                map: $tl_map,
                                zIndex: google.maps.Marker.MAX_ZINDEX + 1,
                                position: ( results[0].geometry.location ? results[0].geometry.location : latlng ),
                                icon:  TL_CONF.themeurl + '/assets/images/google-marker.png'
                            });
                            if(!info_triggered && enable_infobox){
                                info_triggered = true;
                                $("body").trigger("setInfobox");
                            }else{
                                $tl_marker.setMap($tl_map);
                            }
                        }
                    });
            }
        })
    }
}(jQuery));