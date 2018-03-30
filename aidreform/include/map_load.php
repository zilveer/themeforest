<?php
require_once '../../../../wp-load.php';
$address_map = $_REQUEST['add'];
$event_loc_lat = $_REQUEST['lat'];
$event_loc_long = $_REQUEST['long'];
$event_loc_zoom = $_REQUEST['zoom'];
$post_id = $_REQUEST['post_id'];
?>
<div id="map<?php echo $post_id;?>"  style="height:300px; width:100%;"></div>
<script type="text/javascript">
	var locationsw = [
	['<?php echo $address_map;?>', '<?php echo $event_loc_lat;?>', '<?php echo $event_loc_long;?>', '<?php echo $event_loc_zoom;?>'],
	];
	 
	var mapw = new google.maps.Map(document.getElementById('map<?php echo $post_id;?>'), {
	zoom: <?php echo $event_loc_zoom;?>,
	center: new google.maps.LatLng(<?php echo $event_loc_lat;?>, <?php echo $event_loc_long;?>),
	mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	var myOptions = {
	 
	autoScroll: false,
	boxStyle: {
	opacity: 0.75,
	width: "280px"
	}
	};
	 
	var infowindow = new google.maps.InfoWindow(myOptions);
	var i,marker;
	for (i = 0; i < locationsw.length; i++) {
	marker = new google.maps.Marker({
	position: new google.maps.LatLng(locationsw[i][1], locationsw[i][2]),
	map: mapw,
	borderRadius: 20,
	animation: google.maps.Animation.DROP
	});
	 
	google.maps.event.addListener(marker, 'mouseover', (function(marker, i) {
	return function() {
	infowindow.setContent(locationsw[i][0]);
	infowindow.open(mapw, marker);
	}
	})(marker, i));
}
</script>

  <!-- Open Map End --> 