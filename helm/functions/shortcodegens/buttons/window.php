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
<title>Buttons</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodegens/buttons/tinymce.js?1.1"></script>
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
		<legend>Button Size</legend>
		<select id="buttons_size" name="buttons_size">
			<option value="normal">Normal</option>
			<option value="small">Small</option>
			<option value="tiny">Tiny</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Button Align</legend>
		<select id="buttons_align" name="buttons_align">
			<option value="none">None</option>
			<option value="left">Left</option>
			<option value="right">Right</option>
			<option value="fullwidth">Fullwidth</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Button Type</legend>
		<select id="buttons_shortcode" name="buttons_shortcode">
			<option value="gray">Gray Button</option>
			<option value="black">Black Button</option>
			<option value="gold">Gold Button</option>
			<option value="red">Red Button</option>
			<option value="blue">Blue Button</option>
			<option value="green">Green Button</option>
			<option value="pink">Pink Button</option>
			<option value="purple">Purple Button</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Button Text</legend>
		<input id="buttons_text" value="Text" name="buttons_text" type="text">
	</fieldset>
	<fieldset>
		<legend>Button Link</legend>
		<input id="buttons_link" value="" name="buttons_link" type="text">
	</fieldset>
	<fieldset>
		<legend>Button Target</legend>
		<select id="buttons_target" name="buttons_target">
			<option value="none">Open in Same Window</option>
			<option value="_blank">Open in New Window</option>
		</select>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertTypeShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
</body>
</html>
