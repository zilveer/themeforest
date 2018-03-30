var $ = jQuery.noConflict();

// google maps
$(".gmap").each(function(){
	var map;
	var addresses = $(this).data('addresses');
	var geocoder = new google.maps.Geocoder();
  var mapOptions = {
    zoom: 8,
    center: new google.maps.LatLng(-34.397, 150.644),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  };
  map = new google.maps.Map(document.getElementById('map'), mapOptions);

  for (i = 0; i < addresses.length; i++) {
    var address = addresses[i];
    var markers = [];

    geocoder.geocode( { 'address': address }, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        markers.push(new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
            title: results[0].formatted_address
        }));
      }
    });
  }
    
});