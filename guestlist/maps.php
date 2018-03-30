<?php include_once "../../../wp-load.php"; ?>
<html>
    <head>

        <!-- Google Maps Code -->
        <script type="text/javascript"
                src="http://maps.google.com/maps/api/js?sensor=false">
        </script>
        <script type="text/javascript">
            var geocoder;
            var map;
  
            function getMap() {
                var address = "<?php echo urldecode($_GET['address']); ?>";
    
                geocoder = new google.maps.Geocoder();
                if (geocoder) {
                    geocoder.geocode( { 'address': address}, function(results, status) {
                        if (status == google.maps.GeocoderStatus.OK) {
                            
                            var latlng = new google.maps.LatLng(results[0].geometry.location.lat().toFixed(3), results[0].geometry.location.lng().toFixed(3));
                            
                            var image = "<?php echo get_bloginfo('stylesheet_directory') ?>/images/main/location.png";
                            
                            var myOptions = {
                                zoom: 16,
                                center: latlng,
                                mapTypeId: google.maps.MapTypeId.ROADMAP
                            }
                            
                            
var contentString = '<div id="content">'+
    '<div id="siteNotice">'+
    '</div>'+
    '<div id="bodyContent">'+
    '<p><?php echo $_GET['address']; ?></p>'+
    '</div>'+
    '</div>';

var infowindow = new google.maps.InfoWindow({
    content: contentString
});

                            
                            
                            map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                            
                            var beachMarker = new google.maps.Marker({
      position: latlng,
      map: map,
      icon: image,
      title : "<?php echo urldecode($_GET['address']); ?>"
  });
  
  google.maps.event.addListener(beachMarker, 'click', function() {
  infowindow.open(map,beachMarker);
});

                        } else {
                            alert("Geocode was not successful for the following reason: " + status);
                        }
                    });
                }
            }

        </script>
        <!-- END Google Maps Code -->
    </head>
    <body onload="getMap();">
        
        <div id="map_canvas" style="width:100%; height:100%"></div>

    </body>
</html>