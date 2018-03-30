;(function (window, document, $, undefined) {
	"use strict";

	function getScript(src) {
		document.write('<' + 'script src="' + src + '"' + ' type="text/javascript"><' + '/script>');
	}

	if(typeof window.google === 'undefined' || typeof google.maps === 'undefined'){
		if (typeof gmap_api_key === 'undefined' || gmap_api_key=='') {
			getScript(document.location.protocol + '//maps.google.com/maps/api/js');
		} else {
			getScript(document.location.protocol + '//maps.google.com/maps/api/js?key='+gmap_api_key);
		}
	}
}(window, document, jQuery));
