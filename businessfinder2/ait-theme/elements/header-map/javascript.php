<script id="{$htmlId}-container-script">

(function($, $window, $document, globals){
"use strict";

$window.load(function(){

	addHeaderMapControls();

	if (Modernizr.touchevents || Modernizr.pointerevents) {
		// disable the panorama on mobile
		if(globals.globalMaps.headerMap.panorama != null){
			// superhack waiting for content
			var headerMapPanoEvent = setInterval(function(){
				// we need second div because the first is the google map itself
				// if(jQuery("#{!$htmlId} .google-map-container").children('div').length > 1){ // old condition
				// this is better condition to check for button on streetview
				if(jQuery("#{!$htmlId} .draggable-toggle-button").length > 1){ 
					jQuery("#{!$htmlId} .google-map-container div:last-child").find('.draggable-toggle-button').parent().parent().find('div:first').css({'pointer-events': 'none'});
					clearInterval(headerMapPanoEvent);
				}
			}, 100);
		}
	}

	function addHeaderMapControls() {
		var map = globals.globalMaps.headerMap.map;
		var panorama = globals.globalMaps.headerMap.panorama;
		if (Modernizr.touchevents || Modernizr.pointerevents) {
			var disableControlDiv = document.createElement('div');
			var disableControl = new DisableHeaderControl(disableControlDiv, map);
			map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(disableControlDiv);

			if(panorama != null){
				var disableStreetViewDiv = document.createElement('div');
				var disableStreetViewControl = new DisableHeaderStreetViewControl(disableStreetViewDiv);
				panorama.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(disableStreetViewDiv);
			}
		}
	}

	function isAdvancedSearch() {
		var sPageURL = decodeURIComponent(window.location.search.substring(1)),
			sURLVariables = sPageURL.split('&'),
			sParameterName,
			i;

		for (i = 0; i < sURLVariables.length; i++) {
			sParameterName = sURLVariables[i].split('=');

			if (sParameterName[0] === "a") {
				return true;
			}
		}
		return false;
	}

	/**
	 * The DisableControl adds a control to the map.
	 * This constructor takes the control DIV as an argument.
	 * @constructor
	 */
	function DisableHeaderControl(controlDiv, map) {
		var containerID = jQuery("#{!$htmlId} .google-map-container").attr('id');
		var disableButton = document.createElement('div');
		disableButton.className = "draggable-toggle-button";
		jQuery(disableButton).html('<i class="fa fa-lock"></i>');

		controlDiv.appendChild(disableButton);

		jQuery(this).removeClass('active').html('<i class="fa fa-lock"></i>');
		map.setOptions({ draggable : false });

		google.maps.event.addDomListener(disableButton, 'click', function(e) {
			if(jQuery(this).hasClass('active')){
				jQuery(this).removeClass('active').html('<i class="fa fa-lock"></i>');
				map.setOptions({ draggable : false });
			} else {
				jQuery(this).addClass('active').html('<i class="fa fa-unlock"></i>');
				map.setOptions({ draggable : true });
			}
		});
	}

	function DisableHeaderStreetViewControl(controlDiv){
		var containerID = jQuery("#{!$htmlId} .google-map-container").attr('id');
		var disableButton = document.createElement('div');
		disableButton.className = "draggable-toggle-button";
		jQuery(disableButton).html('<i class="fa fa-lock"></i>');

		controlDiv.appendChild(disableButton);

		jQuery(this).removeClass('active').html('<i class="fa fa-lock"></i>');
		
		google.maps.event.addDomListener(disableButton, 'click', function(e) {
			if(jQuery(this).hasClass('active')){
				jQuery(this).removeClass('active').html('<i class="fa fa-lock"></i>');
				if(globals.globalMaps.headerMap.panorama != null){
					// pano hack
					jQuery(this).parent().parent().find('div:first').css({'pointer-events': 'none'});
				}
			} else {
				jQuery(this).addClass('active').html('<i class="fa fa-unlock"></i>');
				if(globals.globalMaps.headerMap.panorama != null){
					// pano hack
					jQuery(this).parent().parent().find('div:first').css({'pointer-events': ''});
				}
			}
		});
	}
	
});

})(jQuery, jQuery(window), jQuery(document), this);

</script>