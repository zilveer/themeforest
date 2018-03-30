<!-- ================================================== -->
<!-- =============== START GOOGLE MAP SETTINGS ================ -->
<!-- ================================================== -->

jQuery(document).ready(function(){

  var map;
  var lat = jQuery('#map-canvas').data('lat');
  var long = jQuery('#map-canvas').data('long');
  var pointer = jQuery('#map-canvas').data('pointer');
  var myLatLng = new google.maps.LatLng(lat,long);


  function initialize() {

    var roadAtlasStyles = [ 
      { "featureType": "poi", "elementType": "labels", "stylers": [ { "visibility": "off" } ] }
    ];

    var mapOptions = {
      zoom: 16,
      center: myLatLng,
      disableDefaultUI: true,
      scrollwheel: false,
      navigationControl: false,
      mapTypeControl: false,
      scaleControl: false,
      //draggable: false,
      mapTypeControlOptions: {
        mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'usroadatlas']
      }
    };

    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
    
     
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        icon: pointer,
        title: ''
    });
    
    var contentString = '';

    var infowindow = new google.maps.InfoWindow({
        content: contentString
    });
    
    google.maps.event.addListener(marker, 'click', function() {
      infowindow.open(map,marker);
    });

    var styledMapOptions = {
      name: 'US Road Atlas'
    };

    var usRoadMapType = new google.maps.StyledMapType(
        roadAtlasStyles, styledMapOptions);

    map.mapTypes.set('usroadatlas', usRoadMapType);
    map.setMapTypeId('usroadatlas');
  }

  google.maps.event.addDomListener(window, 'load', initialize);
    
});