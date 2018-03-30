<?php require_once( '../../../../../wp-load.php' ); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Google map Coordinates</title>
<style>
body {
	background: #fff!important;
	color: #000!important;
	text-align: left!important;
}
</style>
</head>

<body>
<p>
Go to <a href="http://maps.google.it/maps?q=google+map&um=1&ie=UTF-8&sa=N&hl=it&tab=wl">Google Maps</a>, type your address and get a map.
</p>
Once you find your map, type this code in the address bar
<pre>javascript:void(prompt('',gApplication.getMap().getCenter()));</pre>
and copy the string in the prompt box as shown in the picture below:
</p>
<p>
<img src="<?php echo get_template_directory_uri(); ?>/functions/documentation/images/googe-coords.jpg" width="500" height="294">
</p>
<p>
Paste the string in the field below "(how can I get them?)" link.
</p>

</p>
</body>
</html>