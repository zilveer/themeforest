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
<title>TYPOGRAPHY</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodegens/type/tinymce.js?1.1"></script>
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
		<legend>Typography</legend>
		<select id="typography_shortcode" name="typography_shortcode">
			<optgroup label="Drop Caps">
				<option value="dropcap1">Drop Cap - Style 1</option>
				<option value="dropcap2">Drop Cap - Style 2</option>
			</optgroup>
			<optgroup label="Pullquotes">
				<option value="pullquote_left">Pullquote Left</option>
				<option value="pullquote_right">Pullquote Right</option>
				<option value="pullquote_center">Pullquote Center</option>
			</optgroup>
			<optgroup label="Pre">
				<option value="pre">Pre</option>
				<option value="code">Code</option>
			</optgroup>
			<optgroup label="Styled Lists">
				<option value="check_list">Check list</option>
				<option value="star_list">Star list</option>
				<option value="note_list">Notes list</option>
				<option value="play_list">Play list</option>
				<option value="link_list">Link list</option>
				<option value="bullet_list">Bullet list</option>
			</optgroup>
			<optgroup label="Highlight">
				<option value="highlight">Highlight</option>
			</optgroup>									
		</select>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="Insert shortcode" onClick="insertTypeShortcode();" style="float:right; padding:10px; width:auto; height:auto;"/>
</form>
</body>
</html>
