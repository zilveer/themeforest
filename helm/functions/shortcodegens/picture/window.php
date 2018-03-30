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
<title>Picture</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodegens/picture/tinymce.js?1.1"></script>
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
		<legend>Image URL</legend>
		<input id="picture_imageurl" name="picture_imageurl" type="text">
	</fieldset>
	<fieldset>
		<legend>Image Title</legend>
		<input id="picture_title" name="picture_title" type="text">
	</fieldset>
	<fieldset>
		<legend>Align</legend>
		<select id="picture_align" name="picture_align">
			<option value="left">Left</option>
			<option value="right">Right</option>
			<option value="center">Center</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Lightbox</legend>
		<select id="picture_lightbox" name="picture_lightbox">
			<option value="true">Yes</option>
			<option value="false">No</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Link ( If not using Lightbox )</legend>
		<input id="picture_link" name="picture_link" type="text">
	</fieldset>
	<fieldset>
	<table>
	<tr>
	<td>
		<legend>Width</legend>
		<input id="picture_width" name="picture_width" type="text" style="width:145px">

	</td>
	<td>
		<legend>Height</legend>
		<input id="picture_height" name="picture_height" type="text" style="width:145px">

	</td>
	</tr>
	</table>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertTypeShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
</body>
</html>
