<?php require_once('config.php');
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) wp_die(__('You are not allowed to be here', 'framework')); ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Shortcodes</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/framework/shortcodes/wysiwyg/wysiwyg.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
<base target="_self" />
</head>
<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none" id="link">
<form name="theme_shortcode_form" action="#">

	
<div style="height:100px;width:250px;margin:0 auto;padding-top:50px;text-align:center;" class="shortcode_wrap">
<div id="shortcode_panel" class="current" style="height:50px;">
<fieldset style="border:0;width:100%;text-align:center;">
<select id="style_shortcode" name="style_shortcode" style="width:250px">
<option value="0">Select a Shortcode...</option>
<option value="0" style="font-weight:bold;font-style:italic;">Column Shortcodes</option>
     <option value="two_columns">2 Columns</option>
     <option value="three_columns">3 Columns</option>
     <option value="four_columns">4 Columns</option>
     
<option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Buttons</option>
     <option value="btn_grey">White/Grey</option>
     <option value="btn_black">Black</option>
     <option value="btn_blue">Blue</option>
     <option value="btn_green">Green</option>
     <option value="btn_red">Red</option>
     <option value="btn_purple">Purple</option>
     <option value="btn_teal">Teal</option>
  
<option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Alerts</option>
     <option value="alert">Alert Notification</option>
     <option value="alert_success">Success Notification</option>
     <option value="alert_danger">Danger Notification</option> 
     <option value="alert_info">Info Notification</option>
     
  
<option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Misc Shortcodes</option>
     <option value="toggle">Toggle</option>
     <option value="tab">Tabs</option>
     <option value="tab_left">Tab - Tabs Left</option>
     <option value="tab_right">Tab - Tabs Right</option>
     <option value="accordion">Accordion</option>

</select>
</fieldset>
</div><!-- end shortcode_panel -->

<div style="float:left"><input type="button" id="cancel" name="cancel" value="<?php echo "Close"; ?>" onClick="tinyMCEPopup.close();" /></div>
<div style="float:right"><input type="submit" id="insert" name="insert" value="<?php echo "Insert"; ?>" onClick="embedshortcode();" /></div>

</div><!-- end shortcode_wrap -->




</form>
</body>
</html>
