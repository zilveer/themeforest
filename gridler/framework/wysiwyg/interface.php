<?php require_once('config.php');
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) wp_die(__("You are not allowed to be here")); ?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Shortcodes</title>
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/framework/wysiwyg/wysiwyg.js"></script>
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
     <option value="five_columns">5 Columns</option>
     <option value="six_columns">6 Columns</option>
     <option value="one_fourth_three_fourth_columns">1/4 Column + 3/4 Column</option>
     <option value="three_fourth_one_fourth_columns">3/4 Column + 1/4 Column</option>
     <option value="two_thirds_one_third_columns">2/3 Column + 1/3 Column</option>
     <option value="one_third_two_thirds_columns">1/3 Column + 2/3 Column</option>
     
  
<option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Buttons</option>
     <option value="black_button">Black</option>
     <option value="gray_button">Gray</option>
     <option value="red_button">Red</option>
     <option value="orange_button">Orange</option>
     <option value="magneta_button">Magenta</option>
     <option value="yellow_button">Yellow</option>
     <option value="blue_button">Blue</option>
     <option value="pink_button">Pink</option>
     <option value="green_button">Green</option>
     <option value="rosy_button">Rosy</option>


<option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Dividers</option>
     <option value="basic_divider">Basic Divider</option> 
     <option value="top_divider">Divider + Top</option>
 

<option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Headings</option>
     <option value="heading_h2">H2 Heading</option>
     <option value="heading_h3">H3 Heading</option>
     <option value="heading_h4">H4 Heading</option>
     <option value="heading_h5">H5 Heading</option>
     <option value="heading_h6">H6 Heading</option>

     
<option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Typography</option>
     <option value="dropcap1">Dropcap 1</option>
     <option value="dropcap2">Dropcap 2</option>
     <option value="pullquote_left">Pullquote Left</option>
     <option value="pullquote_right">Pullquote Right</option>
     <option value="highlight">Highlight</option>
     <option value="callout">Callout</option>
     <option value="callout_button">Callout (With Button)</option>
     
<option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Notifications</option>
     <option value="notif_success">Success Notification</option>
     <option value="notif_error">Error Notification</option>
     <option value="notif_warning">Warning Notification</option> 
     <option value="notif_info">Info Notification</option> 
     <option value="notif_tip">Tip Notification</option> 
     
     <option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Listing Styles</option>
     <option value="list_bullet">Bullet List</option>
     <option value="list_circle">Circle List</option>
     <option value="list_arrow">Arrow List</option>
     <option value="list_cross">Cross List</option>
     <option value="list_star">Star List</option>
     
     
     <option value="0"> </option>
<option value="0" style="font-weight:bold;font-style:italic;">Misc Shortcodes</option>
     <option value="toggle">Toggle</option>
     <option value="twitter_feed">Twitter Feed</option>
     <option value="testimonial">Testimonial</option>
     <option value="styled_table">Styled Table</option>

  


</select>
</fieldset>
</div><!-- end shortcode_panel -->

<div style="float:left"><input type="button" id="cancel" name="cancel" value="<?php echo "Close"; ?>" onClick="tinyMCEPopup.close();" /></div>
<div style="float:right"><input type="submit" id="insert" name="insert" value="<?php echo "Insert"; ?>" onClick="embedshortcode();" /></div>

</div><!-- end shortcode_wrap -->




</form>
</body>
</html>
