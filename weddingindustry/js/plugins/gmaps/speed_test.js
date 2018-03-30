/**
 * @fileoverview This demo is used for MarkerClusterer. It will show 100 markers
 * using MarkerClusterer and count the time to show the difference between using
 * MarkerClusterer and without MarkerClusterer.
 * @author Luke Mahe (v2 author: Xiaoxi Wu)
 */

function $(element) {
  return document.getElementById(element);
}

var speedTest = {};

/*var MY_MAPTYPE_ID = 'custom_style';
var nicdark_center_map = new google.maps.LatLng(34.263079, 16.993682);*/

speedTest.pics = null;
speedTest.map = null;
speedTest.markerClusterer = null;
speedTest.markers = [];
speedTest.infoWindow = null;

speedTest.init = function() {
  var latlng = new google.maps.LatLng(39.91, 116.38);
  
  /*var options = {
    'zoom': 2,
    'center': nicdark_center_map,
    'mapTypeId': MY_MAPTYPE_ID
  };*/

  speedTest.map = new google.maps.Map($('map'), options);



  //custom zoom map
  if(  document.getElementById("nicdark_gmaps_plus") ){
       google.maps.event.addDomListener(document.getElementById("nicdark_gmaps_plus"), "click", function () {      
         var current= parseInt( speedTest.map.getZoom(),10);
         current++;
         if(current>20){
             current=20;
         }
         speedTest.map.setZoom(current);
      });  
  }
      
      
  if(  document.getElementById("nicdark_gmaps_minus") ){
       google.maps.event.addDomListener(document.getElementById("nicdark_gmaps_minus"), "click", function () {      
         var current= parseInt( speedTest.map.getZoom(),10);
         current--;
         if(current<0){
             current=0;
         }
         speedTest.map.setZoom(current);
      });  
  }
  //end custom zoom map




  //custom style
//start snazzy options
    var featureOpts = 
    [
    {
        "featureType": "landscape",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "transit",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "poi",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "water",
        "elementType": "labels",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.icon",
        "stylers": [
            {
                "visibility": "off"
            }
        ]
    },
    {
        "stylers": [
            {
                "hue": "#00aaff"
            },
            {
                "saturation": -100
            },
            {
                "gamma": 2.15
            },
            {
                "lightness": 12
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "labels.text.fill",
        "stylers": [
            {
                "visibility": "on"
            },
            {
                "lightness": 24
            }
        ]
    },
    {
        "featureType": "road",
        "elementType": "geometry",
        "stylers": [
            {
                "lightness": 57
            }
        ]
    }
    ];
    //end snazzy options


  var styledMapOptions = { name: 'Custom Style'};
  var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);
  speedTest.map.mapTypes.set(MY_MAPTYPE_ID, customMapType);
  //end custom style





  speedTest.pics = data.photos;
  
  var useGmm = document.getElementById('usegmm');
  google.maps.event.addDomListener(useGmm, 'click', speedTest.change);
  
  var numMarkers = document.getElementById('nummarkers');
  google.maps.event.addDomListener(numMarkers, 'change', speedTest.change);

  speedTest.infoWindow = new google.maps.InfoWindow();




  speedTest.showMarkers();
};

speedTest.showMarkers = function() {
  speedTest.markers = [];

  var type = 1;
  if ($('usegmm').checked) {
    type = 0;
  }

  if (speedTest.markerClusterer) {
    speedTest.markerClusterer.clearMarkers();
  }

  var panel = $('markerlist');
  panel.innerHTML = '';
  var numMarkers = $('nummarkers').value;

  for (var i = 0; i < numMarkers; i++) {
    var titleText = speedTest.pics[i].photo_title;
    if (titleText == '') {
      titleText = 'No title';
    }

    var item = document.createElement('DIV');
    var title = document.createElement('A');
    title.href = '#';
    title.className = 'title';
    title.innerHTML = titleText;

    item.appendChild(title);
    panel.appendChild(item);


    var latLng = new google.maps.LatLng(speedTest.pics[i].latitude,
        speedTest.pics[i].longitude);

    //var markerImage = new google.maps.MarkerImage("http://localhost/themeforest/love-travel/wp-content/themes/weddingindustry/img/gmaps/marker.png", null, null, null, new google.maps.Size(45,45));

    var marker = new google.maps.Marker({
      'position': latLng,
      'icon': markerImage
    });

    var fn = speedTest.markerClickFunction(speedTest.pics[i], latLng);
    google.maps.event.addListener(marker, 'click', fn);
    google.maps.event.addDomListener(title, 'click', fn);
    speedTest.markers.push(marker);
  }

  window.setTimeout(speedTest.time, 0);
};

speedTest.markerClickFunction = function(pic, latlng) {
  return function(e) {
    e.cancelBubble = true;
    e.returnValue = false;
    if (e.stopPropagation) {
      e.stopPropagation();
      e.preventDefault();
    }

    //parameter from json
    var title = pic.photo_title;
    var url = pic.photo_url;

    var location_title = pic.locations_title;
    var location_subtitle = pic.locations_subtitle;
    var location_description = pic.locations_description;

    /*var infoHtml_old = '<div class="info"><h3>' + title +
      '</h3><div class="info-body">' +
      '<a href="' + url + '" target="_blank"><img src="' +
      fileurl + '" class="info-img"/></a></div>' +
      '<br/>' +
      '</div></div>';*/

    //var infoHtml = '<div style="width:300px; min-height:200px;" class="nicdark_focus"><div style="float:left; width:100%; padding:0px; box-sizing:border-box;" class="nicdark_center"><img class="nicdark_focus" src="'+ url +'"><div class="nicdark_space20"></div><h4 class="center">'+ title +'</h4><div class="nicdark_space20"></div><a href="http://localhost/themeforest/love-travel/index.php/locations/venice/" class="nicdark_border_grey grey nicdark_btn nicdark_outline medium ">DETAILS</a><div class="nicdark_space10"></div></div></div>';

    var infoHtml = '<div class="nicdark_focus"><div class="nicdark_focus nicdark_width_percentage50"><img style="" class="nicdark_focus" src="'+ url +'"></div><div style="padding-left:45px; float:right !important;" class="nicdark_focus nicdark_sizing nicdark_width_percentage50 nicdark_center"><div class="nicdark_space15"></div><h4><strong>'+ location_title +'</strong></h4><div class="nicdark_space20"></div><h5>'+ location_subtitle +'</h5><div class="nicdark_space20"></div><div class="nicdark_divider  center small "><span style="background-color:#f1f1f1;"></span></div><div class="nicdark_space20"></div><p>'+ location_description +'</p><div class="nicdark_space10"></div></div></div>';

    speedTest.infoWindow.setContent(infoHtml);
    speedTest.infoWindow.setPosition(latlng);
    speedTest.infoWindow.open(speedTest.map);


  };
};

speedTest.clear = function() {
  $('timetaken').innerHTML = 'cleaning...';
  for (var i = 0, marker; marker = speedTest.markers[i]; i++) {
    marker.setMap(null);
  }
};

speedTest.change = function() {
  speedTest.clear();
  speedTest.showMarkers();
};

speedTest.time = function() {
  $('timetaken').innerHTML = 'timing...';
  var start = new Date();
  if ($('usegmm').checked) {
    speedTest.markerClusterer = new MarkerClusterer(speedTest.map, speedTest.markers);
  } else {
    for (var i = 0, marker; marker = speedTest.markers[i]; i++) {
      marker.setMap(speedTest.map);
    }
  }

  var end = new Date();
  $('timetaken').innerHTML = end - start;
};
