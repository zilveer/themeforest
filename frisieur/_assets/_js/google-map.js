jQuery( document ).ready( function() {

    if( martanian_maps_pos1 != "none" && martanian_maps_pos2 != "none" ) {
    
        jQuery.getWidthClass = function( width ) {
            
            width = width + 17;
            
            if( width >= 1150 ) return( 1 );
            else if( width >= 850 && width < 1150 ) return( 2 );
            else if( width >= 600 && width < 850 ) return( 3 );
            else return( 4 );
        }
    
        var map_obj = '';
        var map_pos = '';
        var currentWidth = 0;
        var currentWidthClass = 1;

        google.maps.event.addDomListener( window, 'load', function() {
    
            websiteWidth = jQuery( window ).width();
            centerPos = '';
            
            if( websiteWidth >= 1150 ) {
            
                map_center = new google.maps.LatLng(
                    martanian_maps_pos1,
                    martanian_maps_pos2 + 0.006
                );
            }
            
            else if( websiteWidth >= 850 ) {
                
                map_center = new google.maps.LatLng(
                    martanian_maps_pos1,
                    martanian_maps_pos2 + 0.005
                );
            }
            
            else if( websiteWidth >= 600 ) {
                
                map_center = new google.maps.LatLng(
                    martanian_maps_pos1 - 0.003,
                    martanian_maps_pos2
                );
            }
            
            else {
            
                map_center = new google.maps.LatLng(
                    martanian_maps_pos1 - 0.003,
                    martanian_maps_pos2
                );
            }
    
            currentWidth = jQuery( window ).width();
            currentWidthClass = jQuery.getWidthClass( currentWidth );
            
            var mapOptions = {
                zoom: 16,
                center: map_center,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                scrollwheel: false
            }
          
            map_obj = new google.maps.Map( document.getElementById( 'map-canvas' ), mapOptions );
    
            var beachMarker = new google.maps.Marker({
                position: new google.maps.LatLng(martanian_maps_pos1, martanian_maps_pos2),
                map: map_obj,
            });
            
        });
    
        google.maps.event.addDomListener( window, 'resize', function() {
    
            newWidthClass = jQuery.getWidthClass( jQuery( window ).width() );
    
            if( currentWidthClass == 1 ) {
            
                if( newWidthClass == 2 ) {
            
                    map_obj.setCenter(
                        new google.maps.LatLng(
                            martanian_maps_pos1,
                            martanian_maps_pos2 + 0.0082
                        )
                    );
                }
            }
    
            else if( currentWidthClass == 2 ) {
            
                if( newWidthClass == 1 ) {
            
                    map_obj.setCenter(
                        new google.maps.LatLng(
                            martanian_maps_pos1,
                            martanian_maps_pos2 + 0.0028
                        )
                    );
                }
                
                else if( newWidthClass == 3 ) {
                
                    map_obj.setCenter(
                        new google.maps.LatLng(
                            martanian_maps_pos1 - 0.000232,
                            martanian_maps_pos2 + 0.0026
                        )
                    );
                }
            }
            
            else if( currentWidthClass == 3 ) {
            
                if( newWidthClass == 2 ) {

                    map_obj.setCenter(
                        new google.maps.LatLng(
                            martanian_maps_pos1 - 0.00268,
                            martanian_maps_pos2 + 0.0023
                        )
                    );
                }
            }
            
            else if( currentWidthClass == 4 && newWidthClass == 4 ) {

                map_obj.setCenter(
                    new google.maps.LatLng(
                        martanian_maps_pos1 - 0.00268,
                        martanian_maps_pos2
                    )
                );
            }
    
            currentWidthClass = newWidthClass;
        
        });
    
    }
 
});