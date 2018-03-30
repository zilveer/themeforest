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

if( get_option(SHORTNAME."_linkscolor")) { $customcolor = get_option(SHORTNAME."_linkscolor"); } else {$customcolor = "#c62b02"; }
?>
<!doctype html>
<html lang="en">
<head>
<title><?php _e('Insert Social Link','bd'); ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/tiny_mce_popup.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url(); ?>/js/tinymce/utils/mctabs.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url();?>/js/tinymce/utils/form_utils.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo includes_url(); ?>/js/jquery/jquery.js?ver=1.4.2"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri(). '/includes/shortcode/shortcodes/assets/js/lib.js'?>"></script>
<link href="<?php echo get_template_directory_uri(). '/includes/shortcode/shortcodes/assets/css/social_link.css' ?>" type="text/css" rel="stylesheet" media="all"  />
<script language="javascript" type="text/javascript">
jQuery(document).ready(function() {
	jQuery("#button_type").change(function() {
		var type = jQuery(this).val();
		jQuery("#preview").html(type ? "<a class='social_links "+type+"' style='cursor:pointer'><span> </span></a>"  : "");
	});
});
</script>
<base target="_self" />
</head>
<body  onload="init();">
<form name="social_link" action="#" >
	<div class="panel_wrapper">
		<fieldset style="margin-bottom:10px;padding:10px">
			<legend><?php _e('Type of button:','bd'); ?></legend>
			<label for="button_type"><?php _e('Choose a type:','bd'); ?></label><br><br>
			<select data-name="type" style="width:250px">
				<option value="" disabled selected><?php _e('Select type','bd'); ?></option>
				<option value="rss">RSS</option>
				<option value="facebook">Facebook</option>
				<option value="twitter">Twitter</option>
				<option value="google">Google+</option>
				<option value="flickr">Flickr</option>
				<option value="vimeo">Vimeo</option>
				<option value="linkedin">LinkedIn</option>
				<option value="youtube">Youtube</option>
				<option value="pinterest">Pinterest</option>
				<option value="digg">Digg</option>
				<option value="plurk">Plurk</option>
				<option value="yahoo">Yahoo!</option>
				<option value="delicious">Delicious</option>
				<option value="deviantart">deviantART</option>
				<option value="tumblr">Tumblr</option>
				<option value="skype">Skype</option>
				<option value="appstore">Apple</option>
				<option value="aim">AIM</option>
				<option value="paypal">PayPal</option>
				<option value="blogger">Blogger</option>
				<option value="behance">Behance</option>
				<option value="myspace">Myspace</option>
				<option value="stumbleupon">Stumble</option>
				<option value="forrst">Forrst</option>
				<option value="instagram">Instagram</option>
				<option value="wordpress">Wordpress</option>
				<option value="dropbox">Dropbox</option>
				<option value="android">Android</option>
				<option value="html5">html5</option>
				<option value="drupal">drupal</option>
				<option value="soundcloud">soundcloud</option>
				<option value="chrome">chrome</option>
				<option value="amazon">amazon</option>
				<option value="ebay">ebay</option>
				<option value="lastfm">lastfm</option>
				<option value="yelp">yelp</option>
			</select>
		</fieldset>
		<fieldset style="margin-bottom:10px;padding:10px">
		<legend><?php _e('URL for button:','bd'); ?></legend>
			<label for="button_url"><?php _e('Type your URL here:','bd'); ?></label><br><br>
			<input data-name="url" type="text" style="width:250px">
		</fieldset>
		<fieldset style="margin-bottom:10px;padding:10px">
		<legend><?php _e('Link target:','bd'); ?></legend>
			<label for="button_target"><?php _e('Check if you want open in new window:','bd'); ?></label><br><br>
			<input data-name="target" type="checkbox">
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