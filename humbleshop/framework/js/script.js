var humbleshop = {
	general : function(){
		selectnav('menu-top', {
		  label: '-- Menu -- ',
		  nested: true,
		  indent: '-'
		});

    jQuery('.single-download .download-image, .gallery').magnificPopup({
      delegate: 'a', // child items selector, by clicking on it popup will open
      type: 'image',
      gallery:{enabled:true},
      mainClass: 'mfp-with-zoom', 
      zoom: {
        enabled: true, 
        duration: 300, 
        easing: 'ease-in-out', 
        opener: function(openerElement) {
          return openerElement.is('img') ? openerElement : openerElement.find('img');
        }
      }
    });

    jQuery('.gallery').equalize({children: '.gallery-item'});
    jQuery('.downloads').equalize({children: '.edd_download_title'});
    jQuery('#edd-related-downloads-widget').equalize({children: 'p'});

    jQuery('.collapse').collapse();

    jQuery('.edd_download_quantity_wrapper').find('input').addClass('form-control');
	},
    slider : function() {
        jQuery('.carousel').flexslider({
            animation: "slide",
            controlNav: false,
            animationLoop: false,
            slideshow: false,
            itemWidth: 255,
            itemMargin: 5,
            asNavFor: '.masthead'
        });

        jQuery('.masthead').flexslider({
            animation: "slide",
            controlNav: true,
            animationLoop: false,
            slideshow: true,
            smoothHeight : true,
            sync: ".carousel"
        });

        jQuery('.labels').flexslider({
          animation: "slide",
          controlNav: false,
          animationLoop: true,
          slideshow: false,
          itemWidth: 195,
        });
    },
	map : function(color, icon) {
    var map, humbleloc = new google.maps.LatLng(-34.397, 150.644), MY_MAPTYPE_ID = 'humble_style', geocoder = new google.maps.Geocoder();
    
    var featureOpts = [
    
        { stylers: [
            {hue: color }, 
            {invert_lightness: false}, 
            {visibility: 'on'}, // Valid values: 'on', 'off' or 'simplifed'
            {weight: 3},
            {saturation: 0}, //Valid values: [-100, 100]
            {lightness: 0}, // Valid values: [-100, 100]
            {gamma: 1} //Floating point numbers, [0.01, 10], with 1.0 representing no change.
        ] }
    ];

    var win = jQuery(window).width();
    if (win < 767){
        var drag = false;
    } else {
        var drag = true;
    }

    var mapOptions = {
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        draggable: drag,
        disableDoubleClickZoom: true,
        disableDefaultUI: false,
        zoom: 15,
        center: humbleloc,
        mapTypeControlOptions: {
            mapTypeIds: [google.maps.MapTypeId.TERRAIN, MY_MAPTYPE_ID]
          },
        mapTypeId: MY_MAPTYPE_ID
    };
    
    map = new google.maps.Map(document.getElementById('gmap'), mapOptions);

    var styledMapOptions = {
      name: 'Humble Style'
    };

    var customMapType = new google.maps.StyledMapType(featureOpts, styledMapOptions);

    map.mapTypes.set(MY_MAPTYPE_ID, customMapType);

    var address = jQuery('.gmap').data('center'), 
        //iconBase = 'https://maps.google.com/mapfiles/kml/shapes/',
        myBase = {
            url: icon,
            anchor: new google.maps.Point(16, 34)
        };

    geocoder.geocode( { 'address': address}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
            map: map,
            position: results[0].geometry.location,
            icon: icon
            //shadow: myBase
        });
      } else {
        alert('Geocode was not successful for the following reason: ' + status);
      }
    });
  },
  init : function(){
  	
  	this.general();
    this.slider();

  	if (jQuery('#gmap').hasClass('gmap')) {
      this.map();
    }

  }
};

jQuery(document).ready(function($){

	humbleshop.init();

})