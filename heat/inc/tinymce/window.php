<?php
// Bootstrap file for getting the ABSPATH constant to wp-load.php
require_once('config.php');

// check for rights
if ( !current_user_can('edit_pages') && !current_user_can('edit_posts') ) 
	wp_die( __( "You are not allowed to be here", 'mega' ) );
    global $wpdb;
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Shortcodes</title>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo  get_template_directory_uri() ?>/inc/tinymce/tinymce.js"></script>
	<base target="_self" />
</head>
<body id="link" onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('style_shortcode').focus();" style="display: none">
<form name="mega_shortcode_form" action="#">
	<div class="tabs">
		<ul>
			<li id="style_tab" class="current"><span><a href="javascript:mcTabs.displayTab('style_tab','shortcode_panel');" onMouseDown="return false;">Shortcodes</a></span></li>
		</ul>
	</div>
	
	<div class="panel_wrapper">
		<!-- gallery panel -->
		<div id="shortcode_panel" class="panel current">
		<br />
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="style_shortcode"><?php _e( "Select Shortcode", 'mega' ); ?></label></td>
            <td><select id="style_shortcode" name="style_shortcode" style="width: 200px">
                <option value="0">Select Shortcode</option>
				<option value="one_half">One Half</option>
				<option value="one_half_last">One Half Last</option>
				<option value="one_third">One Third</option>
				<option value="one_third_last">One Third Last</option>
				<option value="two_third">Two Third </option>
				<option value="two_third_last">Two Third Last</option>
				<option value="one_fourth">One Fourth</option>
				<option value="one_fourth_last">One Fourth Last</option>				
				<option value="three_fourth">Three Fourth</option>
				<option value="three_fourth_last">Three Fourth Last</option>
				<option value="button">Button</option>
				<option value="accordion">Accordion</option>				
				<option value="tabgroup">Tabs</option>	
				<option value="dropcap">Dropcap</option>
				<option value="highlight">Highlight</option>
				<option value="hr">Divider</option>
				<option value="map">Google Map</option>
            </select></td>
          </tr>
         
        </table>
		</div>
		
	</div>
		
	
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right">
			<input type="submit" id="insert" name="insert" value="Insert" onClick="insertHeatLink();" />
		</div>
	</div>
</form>
</body>
</html>
