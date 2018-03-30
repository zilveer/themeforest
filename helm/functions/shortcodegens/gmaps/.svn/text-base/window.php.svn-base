<?php

$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here"));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Google Maps</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodegens/gmaps/tinymce.js?1.2"></script>
<style type="text/css">
legend, label, select, input { font-size:11px; }
fieldset { margin:18px 0; padding:11px; }
select, input[type=text] { float:left; width:300px }
select optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif; padding: 6px 0 3px 10px;}
select optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding: 1px 0 1px 20px;}
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<form name="mtheme_type" action="#">
	<!-- style_panel -->
	<fieldset>
		<legend>Map type</legend>
		<select id="map_type" name="map_type">
			<option value="ROADMAP">Roadmap</option>
			<option value="SATELLITE">Satellite</option>
			<option value="HYBRID">Hybrid</option>
			<option value="TERRAIN">Terrain</option>
		</select>
	</fieldset>
	<fieldset>
		<table>
		<tr>
		<td>
			<legend>Width</legend>
			<input id="map_width" name="map_width" type="text" style="width:145px">

		</td>
		<td>
			<legend>Height</legend>
			<input id="map_height" name="map_height" type="text" style="width:145px">

		</td>
		</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Address (eg. Tokyo, Japan) or fill Longitude and Latitude</legend>
		<input id="map_address" name="map_address" type="text">
	</fieldset>
	<fieldset>
		<table>
		<tr>
		<td>
			<legend>Latitude</legend>
			<input id="map_latitude" name="map_latitude" type="text" style="width:145px">

		</td>
		<td>
			<legend>Longitude</legend>
			<input id="map_longitude" name="map_longitude" type="text" style="width:145px">

		</td>
		</tr>
		</table>
	</fieldset>
	<fieldset>
		<table>
		<tr>
		<td>
			<legend>Marker</legend>
			<select id="map_marker" name="map_marker" style="width:145px">
				<option value="yes">On</option>
				<option value="no">Off</option>
			</select>
		</td>
		<td>
			<legend>Zoom level (0-20)</legend>
			<input id="map_zoom" name="map_zoom" type="text" style="width:145px">	
		</td>
		</tr>
		</table>
	</fieldset>
	<fieldset>
		<table>
		<tr>
		<td>
			<legend>Mousescroll</legend>
			<select id="map_scroll" name="map_scroll" style="width:145px">
				<option value="true">On</option>
				<option value="false">Off</option>
			</select>
		</td>
		<td>
			<legend>Map Controls</legend>
			<select id="map_control" name="map_control" style="width:145px">
				<option value="false">On</option>
				<option value="true">Off</option>
			</select>
		</td>
		</tr>
		</table>
	</fieldset>
	<fieldset>
		<legend>Marker image</legend>
		<input id="map_marker_image" name="map_marker_image" type="text">
	</fieldset>
	<fieldset>
		<legend>Marker balloon text</legend>
		<input id="map_marker_text" name="map_marker_text" type="text">
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertTypeShortcode();" style="float:right; padding:10px; margin-bottom:20px; width:auto; height:auto;"/>
</form>
</body>
</html>
