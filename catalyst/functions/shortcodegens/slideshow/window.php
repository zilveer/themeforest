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
<title>slideshow</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodegens/slideshow/tinymce.js?1.1"></script>
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
		<legend>Slideshow Type</legend>
		<select id="slideshow_type" name="slideshow_type">
			<option value="galleria">Galleria</option>
			<option value="nivo">Nivo</option>
		</select>
	</fieldset>
	<fieldset>
	<table>
	<tr>
	<td>
		<legend>Width</legend>
		<input id="slideshow_width" name="slideshow_width" type="text" style="width:145px">

	</td>
	<td>
		<legend>Height</legend>
		<input id="slideshow_height" name="slideshow_height" type="text" style="width:145px">

	</td>
	</tr>
	</table>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertTypeShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
</body>
</html>
