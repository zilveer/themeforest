<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
<meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<?php $latl = $_GET['latlong']; ?>
<?php $mzoom = $_GET['mzoom']; ?>
<?php $szoom = $_GET['szoom']; ?>
<?php $pan = $_GET['pan']; ?>
<?php $streetview = $_GET['streetview']; ?>
<?php if ($streetview == 'true'){ ?>
<style type="text/css">
  html { height: 100%; background-color:transparent; }
  body { height: 460px; margin: 0px; padding: 0px; background-color:transparent; border: 0px solid #000; }
  #map_canvas { height: 100% } 
  #map_canvas {width: 978px; height: 300px; position: relative;float: left;}
  #map_canvas2 {width: 460px; height: 300px; position: relative;float: right;}
</style>
<?php } else { ?>
<style type="text/css">
  html { height: 100%; background-color:transparent; }
  body { height: 460px; margin: 0px; padding: 0px; background-color:transparent; border: 0px solid #000; }
  #map_canvas { height: 100% }
  #map_canvas {width: 460px; height: 300px; position: relative;float: left;}
  #map_canvas {width: 460px; height: 300px; position: relative;float: left;}
  #map_canvas2 {width: 460px; height: 300px; position: relative;float: right;}
</style>
 
<?php } ?>
 
<script type="text/javascript">
	function initialize() {
		var myLatlng = new google.maps.LatLng(<?php echo $latl; ?>);

		var myOptions = {
				zoom: <?php echo $mzoom; ?>,
				center: myLatlng,
				mapTypeId: google.maps.MapTypeId.ROADMAP,
				streetViewControl: true
			}
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		
		var marker = new google.maps.Marker({
      position: myLatlng, 
      map: map, 
      title:"Hello World!"
  		});   
		
	<?php if ($streetview == 'false'){ ?>
		panoramaOptions = {
			addressControlOptions: {
				style: {backgroundColor: '#000', color: '#fff'}
			},
			position: myLatlng,
			pov: {
				heading: <?php echo $pan; ?>,
				pitch: +10,
				zoom: <?php echo $szoom; ?>
			}
		};
		panorama = new  google.maps.StreetViewPanorama(document.getElementById("map_canvas2"), panoramaOptions);
		map.setStreetView(panorama);
		<?php } ?>
	}
</script>
</head>
<body onload="initialize()">
<div id="map_canvas"></div>
<?php if ($streetview == 'false'){ ?>
<div id="map_canvas2"></div>
<?php } ?>

</body>
</html>

