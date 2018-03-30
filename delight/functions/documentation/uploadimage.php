<?php require_once( '../../../../../wp-load.php' ); ?>
<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Uploadimage</title>
<link rel="stylesheet" href="../css/functions.css">
<?php if(get_pix_option('pix_google_prevent') != 'show') { ?><link rel='stylesheet' id='cabin-css'  href='http://fonts.googleapis.com/css?family=Cabin&#038;ver=1.0' type='text/css' media='all' /> <?php } ?>
<style>
body {
	background: #000!important;
	color: #fff!important;
	font-family: Cabin;
	font-size: 12px;
	font-weight: normal;
	padding: 20px;
	text-align: left!important;
}
a {
	color: #0CF;
}
</style>
</head>

<body>
<p>
By clicking "Upload image" you'll see a Thickbox like this (<em><strong>N.B.:</strong> scroll to the bottom</em>):
</p>
<p>
<img src="<?php echo get_template_directory_uri(); ?>/functions/documentation/images/uploadimage.jpg" width="600" height="783">
</p>

<p>
Remember: after uploading your image (or select it from the media library), be sure to click the "File URL" button (in this case you'll see the URL of the file in the "Link URL" field above), otherwise no values will be passed.<br>
Then click "Insert into post": the Thickbox will close and the value will be passed to your administration panel.
</p>
</body>
</html>