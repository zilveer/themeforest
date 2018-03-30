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
 * @package 	proStore/library/shortcodes/tinymce/columns/window.php
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
<title>Columns Shortcode Generator</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/library/shortcodes/tinymce/columns/tinymce.js?1.3"></script>
<style type="text/css">
legend, label, select, input { font-size:11px; }
fieldset { margin:18px 0; padding:11px; }
select, input[type=text] { float:left; width:300px }
select optgroup { font:bold 11px Tahoma, Verdana, Arial, Sans-serif; padding: 6px 0 3px 10px;}
select optgroup option { font:normal 11px/18px Tahoma, Verdana, Arial, Sans-serif; padding: 1px 0 1px 20px;}
</style>
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');">
<form name="mtheme_columns" action="#">
	<!-- Column panel -->
	<fieldset>
		<legend>Select your choice</legend>
		<select id="column_shortcode" name="column_shortcode">
			<optgroup label="Fixed Layout">
				<option value="one_column">One column</option>
				<option value="two_column">Two columns</option>
				<option value="three_column">Three columns</option>
				<option value="four_column">Four columns</option>
				<option value="six_column">Six columns</option>
			</optgroup>
			<optgroup label="Mixed Layouts : 2 Columns">
				<option value="13_23">1/3 &nbsp;&#124;&nbsp; 2/3</option>
				<option value="23_13">2/3 &nbsp;&#124;&nbsp; 1/3</option>
				<option>-------------</option>
				<option value="14_34">1/4 &nbsp;&#124;&nbsp; 3/4</option>
				<option value="34_14">3/4 &nbsp;&#124;&nbsp; 1/4</option>
				<option>-------------</option>
				<option value="16_56">1/6 &nbsp;&#124;&nbsp; 5/6</option>
				<option value="56_16">5/6 &nbsp;&#124;&nbsp; 1/6</option>
			</optgroup>
			<optgroup label="Mixed Layouts : 3 Columns">
				<option value="12_14_14">1/2 &nbsp;&#124;&nbsp; 1/4 &nbsp;&#124;&nbsp; 1/4</option>
				<option value="14_12_14">1/4 &nbsp;&#124;&nbsp; 1/2 &nbsp;&#124;&nbsp; 1/4</option>
				<option value="14_14_12">1/4 &nbsp;&#124;&nbsp; 1/4 &nbsp;&#124;&nbsp; 1/2 </option>
				<option>----------------------</option>
				<option value="16_26_36">1/6 &nbsp;&#124;&nbsp; 2/6 &nbsp;&#124;&nbsp; 3/6 </option>
				<option value="16_36_26">1/6 &nbsp;&#124;&nbsp; 3/6 &nbsp;&#124;&nbsp; 2/6 </option>
				<option value="26_16_36">2/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 3/6 </option>
				<option value="26_36_16">2/6 &nbsp;&#124;&nbsp; 3/6 &nbsp;&#124;&nbsp; 1/6 </option>
				<option value="36_16_26">3/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 2/6 </option>
				<option value="36_26_16">3/6 &nbsp;&#124;&nbsp; 2/6 &nbsp;&#124;&nbsp; 1/6 </option>
			</optgroup>
			<optgroup label="Mixed Layouts : 4 Columns">
				<option value="16_36_16_16">1/6 &nbsp;&#124;&nbsp; 3/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 1/6</option>
				<option value="16_16_36_16">1/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 3/6 &nbsp;&#124;&nbsp; 1/6</option>
				<option value="16_16_16_36">1/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 3/6</option>
				<option value="36_16_16_16">3/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 1/6</option>
				<option>-------------------------------</option>
				<option value="16_16_26_26">1/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 2/6 &nbsp;&#124;&nbsp; 2/6</option>
				<option value="16_26_26_16">1/6 &nbsp;&#124;&nbsp; 2/6 &nbsp;&#124;&nbsp; 2/6 &nbsp;&#124;&nbsp; 1/6</option>
				<option value="16_26_16_26">1/6 &nbsp;&#124;&nbsp; 2/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 2/6</option>
				<option value="26_26_16_16">2/6 &nbsp;&#124;&nbsp; 2/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 1/6</option>
				<option value="26_16_26_16">2/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 2/6 &nbsp;&#124;&nbsp; 1/6</option>
				<option value="26_16_16_26">2/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 1/6 &nbsp;&#124;&nbsp; 2/6</option>
			</optgroup>
			<optgroup label="Column elements">
				<option value="row">Row</option>
				<option value="col2">1/2</option>
				<option value="col3">1/3</option>
				<option value="col32">2/3</option>
				<option value="col4">1/4</option>
				<option value="col43">3/4</option>
				<option value="col6">1/6</option>
				<option value="col65">5/6</option>
			</optgroup>
		</select>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px 15px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="GENERATE SHORTCODE(S)" onClick="insertShortcode();" style="float:right; padding:10px 15px; width:auto; height:auto;"/>
</form>
</body>
</html>
