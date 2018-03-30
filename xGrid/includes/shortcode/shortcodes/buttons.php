<?php
/**
 *
 *  Short code functions
 *  Developer by : Amr Sadek
 *  http://themeforest.net/user/bdayh
 *
 */

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

if( get_option(SHORTNAME."_linkscolor")) { $customcolor = get_option(SHORTNAME."_linkscolor"); } else {$customcolor = "#c62b02"; }
?>
<!doctype html>
<html lang="en">
<head>
<title><?php _e('Insert Button','bd'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/jquery/jquery.js?ver=1.4.2"></script>
<script language="javascript" type="text/javascript">if(typeof  THEME_URI == 'undefined'){var THEME_URI = '<?php echo get_template_directory_uri(); ?>';}</script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(). '/includes/shortcode/shortcodes/assets/js/lib.js'?>"></script>
<link href="<?php echo get_template_directory_uri(). '/includes/shortcode/shortcodes/assets/css/buttons.css' ?>" type="text/css" rel="stylesheet" media="all"  />
<script language="javascript" type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#button_color, #button_type').change(function() {
		var type = jQuery("#button_type").val(),
			color = jQuery('#button_color').val(),
			preview = jQuery('#preview'),

			html = (type == 'bd_button btn_xlarge')
					? "<a class='"+type+"' style='cursor:pointer;'><b style='background-color: "+color+";'></b><span>Test button</span></a>"
					: "<a class='"+type+"' style='cursor:pointer;background-color:"+color+"'><span>Test button</span></a>";

		preview.html(html);
	});
});
</script>
<base target="_self" />
</head>
<body  onload="init();">
<form name="button" action="#" >
	<div class="panel_wrapper">
		<fieldset style="margin-bottom:10px;padding:10px">
			<legend><?php _e('Type of button:','bd'); ?></legend>
			<label for="button_type"><?php _e('Choose a type:','bd'); ?></label><br><br>
			<select data-name="type" id="button_type" style="width:250px">
				<option value="" disabled selected><?php _e('Select type','bd'); ?></option>
				<option value="bd_button btn_small"><?php _e('small button','bd'); ?></option>
				<option value="bd_button btn_middle"><?php _e('middle button black','bd'); ?></option>
				<option value="bd_button btn_large"><?php _e('large color button','bd'); ?></option>
			</select>
		</fieldset>
		<fieldset style="margin-bottom:10px;padding:10px">
			<legend><?php _e('URL for button:','bd'); ?></legend>
			<label><?php _e('Type your URL here:','bd'); ?></label><br><br>
			<input data-name="url" type="text" id="button_url" style="width:250px">
		</fieldset>
		<fieldset style="margin-bottom:10px;padding:10px">
			<legend><?php _e('Link target:','bd'); ?></legend>
			<label><?php _e('Check if you want open in new window:','bd'); ?></label><br><br>
			<input data-name="target" type="checkbox" id="button_target">
		</fieldset>
		<fieldset style="margin-bottom:10px;padding:10px">
			<legend>Change Color:</legend>
			<label>button background colors:</label><br><br>
			<input data-name="button_color_fon" type="color" data-hex="true" id="button_color" style="width:230px" value="#3fc2da">
		</fieldset>
		<fieldset style="margin-bottom:10px;padding:10px">
			<legend>Change Color:</legend>
			<label>button text colors :</label><br><br>
			<input data-name="button_text_color" type="color" data-hex="true" id="button_text_color" style="width:230px" value="#FFFFFF">
		</fieldset>
		<fieldset style="margin-bottom:10px;padding:10px">
			<legend><?php _e('Preview:','bd'); ?></legend>
			<div id="preview" style="height:70px"></div>
		</fieldset>
	</div>
	<div class="mceActionPanel">
		<div style="float: right">
			<input type="submit" class="btn-BDSC" name="insert" value="<?php _e('Insert','bd'); ?>" onClick="submitData(jQuery(this).closest('form'));" />
		</div>
	</div>
</form>
</body>
</html>