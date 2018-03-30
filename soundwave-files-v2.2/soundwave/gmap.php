<?php
 $coordinated    = get_post_meta($post->ID, "event_coordinated", true);
 $event_zoom     = get_post_meta($post->ID, "event_zoom", true);
 
if ($coordinated != null) {
 
if (of_get_option('active_ajax', '0') == '0') {

            echo '
	<div class="evsng-map">	
       <script type="text/javascript">
      jQuery(document).ready(function($){
      
        $("#event-map").gmap3({
          marker:{
            latLng: [' . $coordinated . '],
            options:{
              draggable:true
            },
            events:{
              dragend: function(marker){
                $(this).gmap3({
                  getaddress:{
                    latLng:marker.getPosition(),
                    callback:function(results){
                      var map = $(this).gmap3("get"),
                        infowindow = $(this).gmap3({get:"infowindow"}),
                        content = results && results[1] ? results && results[1].formatted_address : "no address";
                      if (infowindow){
                        infowindow.open(map, marker);
                        infowindow.setContent(content);
                      } else {
                        $(this).gmap3({
                          infowindow:{
                            anchor:marker, 
                            options:{content: content}
                          }
                        });
                      }
                    }
                  }
                });
              }
            }
          },
          map:{
            options:{
              zoom: ' . $event_zoom . '
            }
          }
        });
        
      });
    </script>
	
    <div id="event-map">
	</div>
	</div>';
} else {	
	echo '
	<div class="evsng-map-img">	
	<img src="http://maps.googleapis.com/maps/api/staticmap?zoom=' . $event_zoom . '&size=635x300&sensor=false&markers=' . $coordinated . '">
	</div>';
	
	}
}		
?>