addLoadEvent(jscolor.init);

jQuery(document).ready(function() {
    jQuery( "#agritourismo_datepicker" ).datepicker({
        dateFormat: 'mm/dd/yy, 00:00'
    });
});


jQuery(window)
    .load(function () {
    if (jQuery('#saved_box')
        .length) {
        setTimeout('bordeaux.removeSavedMessage()', 3000)
    }
});




function loadUploader(element, pathToPhp) {
    var button = element;
    new AjaxUpload(button, {
        action: pathToPhp,
        name: 'df_import',
        onSubmit: function (file, ext) {

            this.disable();

        },
        onComplete: function (file, response) {
            location.reload();
        }
    })
}


/// image upload

var file_frame;

jQuery(document).on('click', '.df-upload-button', function( event ){
    clicked = jQuery(this);
    event.preventDefault();
 
    if ( file_frame ) {
        file_frame.open();
        return;
    }
 
    file_frame = wp.media.frames.file_frame = wp.media({
        title: jQuery( this ).data( 'uploader_title' ),
        button: {
            text: jQuery( this ).data( 'uploader_button_text' ),
        },
        multiple: false  
    });
 
    file_frame.on( 'select', function() {
 
        attachment = file_frame.state().get('selection').first().toJSON();
 
        // I'm getting the ID rather than the URL:
        //jQuery(".df-upload-field").val(attachment.id);
        // but you could get the URL instead by doing something like this:
        clicked.parent().find(".df-upload-field").val(attachment.url);
 
        // and you can change "thumbnail" to get other image sizes
 
    });
 
    file_frame.open();
 
});


var id;
var markers = {};
var markerArray = [];


    function initialize() {

        google.maps.event.addListener(map, 'click', function(event) {
            if(markerArray.length<3) {
                addMarker(event.latLng);
            } else {
                alert("You already have marked 3 positions!");
            }
            
        });

    }

    // Add a marker to the map and push to the array.

    function addMarker(location) {
        
        marker = new google.maps.Marker({ 
            position: location,
            map: map,
            draggable: true,
            animation: google.maps.Animation.DROP,
            icon: scripts.imageUrl+'default-icon.png'
        });
        id = marker.__gm_id
        markers[id] = marker; 
        markerArray.push(markers[id].getPosition()); 

        google.maps.event.addListener(marker, "rightclick", function (event) {
            var newMarkerArray = [];
            id = this.__gm_id; 
            delMarker(id);
            delete markers[id];
            arr = jQuery.makeArray(markers);
            arr = arr[0];
            i = 0;

            jQuery.each(arr, function( index, value ) {
                newMarkerArray[i] = {"lb": value.position.lb, "mb":value.position.mb};
                i++;
            });


            jQuery(".df-coordinates").val(JSON.stringify(newMarkerArray));
            markerArray = newMarkerArray;
        });

        google.maps.event.addListener(marker, 'dragend', function() { 
            var newMarkerArray = [];
            arr = jQuery.makeArray(markers);
            arr = arr[0];
            i = 0;

            jQuery.each(arr, function( index, value ) {
                newMarkerArray[i] = {"lb": value.position.lb, "mb":value.position.mb};
                i++;
            });


            jQuery(".df-coordinates").val(JSON.stringify(newMarkerArray));
            markerArray = newMarkerArray;
        } );

        jQuery(".df-coordinates").val(JSON.stringify(markerArray));
    }

    var delMarker = function (id) {
        marker = markers[id]; 
        marker.setMap(null);
    }



    function handleNoGeolocation(errorFlag) {
      if (errorFlag) {
        var content = 'Error: The Geolocation service failed.';
      } else {
        var content = 'Error: Your browser doesn\'t support geolocation.';
      }

      var options = {
        map: map,
        position: new google.maps.LatLng(60, 105),
        content: content
      };

      var infowindow = new google.maps.InfoWindow(options);
      map.setCenter(options.position);
    }


 /* -------------------------------------------------------------------------*
 *                                  EXPORT/IMPORT                           *
 * -------------------------------------------------------------------------*/
jQuery(document).ready(function(){
    jQuery(".export-content").click(function() {
        var type = jQuery(this).data("type");
        var dlif = jQuery('<iframe/>',{'src': document.URL+'&df-export=download&df-export-type='+type}).hide();
        jQuery(this).parent().append(dlif);
    });
});

