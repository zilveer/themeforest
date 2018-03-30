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
<title>Column Shortcode Generator</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/shortcodegens/columns/tinymce.js?1.3"></script>
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
			<optgroup label="Single Row of">
				<option value="two_column_grid">Two columns</option>
				<option value="three_column_grid">Three columns</option>
				<option value="four_column_grid">Four columns</option>
				<option value="five_column_grid">Five columns</option>
				<option value="six_column_grid">Six columns</option>
			</optgroup>
			<optgroup label="Column Element">
				<option value="column2">One Half</option>
				<option value="column2_last">One Half Last</option>
				<option value="column3">One Third</option>
				<option value="column3_last">One Third Last</option>
				<option value="column32">Two third</option>
				<option value="column32_last">Two third Last</option>
				<option value="column4">One fourth</option>
				<option value="column4_last">One fourth Last</option>
				<option value="column43">Three fourth</option>
				<option value="column43_last">Three fourth Last</option>
				<option value="column5">One fifth</option>
				<option value="column5_last">One fifth Last</option>
				<option value="column52">Two fifth</option>
				<option value="column52_last">Two fifth Last</option>
				<option value="column53">Three fifth</option>
				<option value="column53_last">Three fifth Last</option>
				<option value="column6">One sixth</option>
				<option value="column6_last">One sixth Last</option>
			</optgroup>
			<optgroup label="2 Column Combo">
				<option value="onethird_twothird">One third / Two third</option>
				<option value="twothird_onethird">Two third / One third</option>
				<option value="twofifth_threefifth">Two fifth / Three fifth</option>
				<option value="threefifth_twofifth">Three fifth / Two fifth</option>
				<option value="onefourth_threefourth">One fourth / Three fourth</option>
				<option value="threefourth_onefourth">Three fourth / One fourth</option>
			</optgroup>
			<optgroup label="3 Column Combo">
				<option value="half_onefourth_onefourth">One half / One fourth / One fourth</option>
				<option value="onefourth_half_onefourth">One fourth / One half / One fourth</option>
				<option value="onefourth_onefourth_half">One fourth / One fourth / One half </option>
				<option value="onefifth_twofifth_twofifth">One fifth / Two fifth / Two fifth </option>
				<option value="twofifth_onefifth_twofifth">Two fifth / One fifth / Two fifth </option>
				<option value="twofifth_twofifth_onefifth">Two fifth / Two fifth / One fifth </option>
				<option value="threefifth_onefifth_onefifth">Three fifth / One fifth / One fifth </option>
				<option value="onefifth_threefifth_onefifth">One fifth / Three fifth/  One fifth</option>
				<option value="onefifth_onefifth_threefifth">One fifth / One fifth / Three fifth</option>
			</optgroup>
			<optgroup label="4 Column Combo">
				<option value="twofifth_onefifth_onefifth_onefifth">Two fifth / One fifth / One fifth / One fifth</option>
				<option value="onefifth_twofifth_onefifth_onefifth">One fifth / Two fifth / One fifth / One fifth</option>
				<option value="onefifth_onefifth_twofifth_onefifth">One fifth / One fifth / Two fifth / One fifth</option>
				<option value="onefifth_onefifth_onefifth_twofifth">One fifth / One fifth / One fifth / Two fifth</option>
			</optgroup>
		</select>
	</fieldset>
	<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"  style="float:left; padding:10px 15px; width:auto; height:auto;"/>
	<input type="submit" id="insert" name="insert" value="GENERATE SHORTCODE(S)" onClick="insertShortcode();" style="float:right; padding:10px 15px; width:auto; height:auto;"/>
</form>
</body>
</html>
