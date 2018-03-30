 /**
 * Google Maps Initialization
 */
function gmap_initialize(latitude, longitude, elementId, zoomLevel){
	var greyMapStyles = [
	  {
		featureType: '',
		elementType: '',
		stylers: [
		  {hue: ''},
		  {saturation: -100},
		  {lightness: '15'},
		]
	  },
	  {
		featureType: '',
	  }
	];
	var myLatlng = new google.maps.LatLng(latitude, longitude);
	var myOptions = {
	  center: myLatlng,
	  zoom: zoomLevel,
	  mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	var map = new google.maps.Map(document.getElementById("map_canvas_" + elementId),
		myOptions);
	var marker = new google.maps.Marker({
		position: myLatlng,
		map: map,
		animation: google.maps.Animation.DROP
	});
	map.setOptions({styles: greyMapStyles});
}
