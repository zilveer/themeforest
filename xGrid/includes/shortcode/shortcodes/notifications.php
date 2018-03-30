<?php
/**
 *
 *  Short code functions
 *  Developer by : Amr Sadek
 *  http://themeforest.net/user/bdayh
 *
 */
defined('WP_ADMIN') || define('WP_ADMIN', true);

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

?>
<!doctype html>
<html lang="en">
<head>
<title><?php _e('Insert Notification','bd'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/jquery/jquery.js?ver=1.4.2"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(). '/includes/shortcode/shortcodes/assets/js/lib.js' ?>"></script>
<link href="<?php echo get_template_directory_uri(). '/includes/shortcode/shortcodes/assets/css/notifications.css' ?>" type="text/css" rel="stylesheet" media="all"  />
<script language="javascript" type="text/javascript">
jQuery(document).ready(function() {
jQuery("#notification_type").change(function() {
	var type = jQuery(this).val();
	jQuery("#preview").html(type ? "<div class='bd-notification "+type+"' >Test block</div>"  : "");
});
});
</script>
<base target="_self" />
</head>
<body  onload="init();">
<form name="notification" action="#" >
	<div class="panel_wrapper">
		<fieldset style="margin-bottom:10px;padding:10px">
			<legend><?php _e('Type of notification:','bd'); ?></legend>
			<label for="notification_type"><?php _e('Choose a type:','bd'); ?></label><br><br>
			<select data-name="type" style="width:250px">
				<option value="" disabled selected><?php _e('Select type','bd'); ?></option>
				<option value="notification_mark"><?php _e('Successful','bd'); ?></option>
				<option value="notification_error"><?php _e('Error','bd'); ?></option>
				<option value="notification_warning"><?php _e('Warning','bd'); ?></option>
				<option value="notification_info"><?php _e('Info','bd'); ?></option>
			</select>
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