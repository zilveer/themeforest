<?php
/**
 * Theme Name: proStore
 * Theme URI: http://themeforest.net/user/gnrocks/portfolio
 * Theme demo : http://rchour.net/prostore
 * Description: A WordPress premium theme exclusively for sale on ThemeForest
 *
 * Author: gnrocks
 * Author URI: http://themeforest.net/user/gnrocks
 * License : http://codex.wordpress.org/GPL & http://wiki.envato.com/support/legal-terms/licensing-terms/
 *
 *
 * @package 	proStore/library/shortcodes/tinymce/alerts/window.php
 * @file	 	1.0
 */
?>
<?php

$wp_include = "../wp-load.php";
$i = 0;
while (!file_exists($wp_include) && $i++ < 10) {
  $wp_include = "../$wp_include";
}

// let's load WordPress
require($wp_include);

if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed to be here",'prostore-theme'));
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Alerts Shortcode Generator</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/library/shortcodes/tinymce/alerts/tinymce.js?1.1"></script>
<style type="text/css">
legend, label, select, input { font-size:11px; }
fieldset { margin:18px 0; padding:11px; }
select, input[type=text] { float:left; width:100%; }
select optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif; padding: 6px 0 3px 10px;}
select optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding: 1px 0 1px 20px;}
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<form name="mtheme_alerts" action="#">
	<!-- style_panel -->
	<fieldset>
		<legend>Alert color</legend><p> (Colors defined in Admin panel > Styling & Colors > Accent colors)</p>
		<select id="alert_type" name="alert_type">
			<option value="primary">Primary</option>
			<option value="secondary">Secondary</option>
			<option value="tertiary">Tertiary</option>
			<option value="alert">Alert</option>
			<option value="success">Success</option>
			<option value="warning">Warning</option>
			<option value="info">Info</option>
			<option value="inverse">Inverse</option>
		</select>
	</fieldset>
	<fieldset>
		<legend>Alert content</legend>
		<textarea id="alert_content" name="alert_content" cols="80" rows="4"></textarea>
	</fieldset>
	<fieldset>
		<legend>Add close button</legend>
		<select id="alert_close" name="alert_close">
			<option value="on" selected>Yes</option>
			<option value="off">No</option>
		</select>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Generate shortcode" onClick="insertShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
</body>
</html>
