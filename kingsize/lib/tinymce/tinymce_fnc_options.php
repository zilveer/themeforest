<?php
/**
 * @KingSize 2011
 * For the configuration load into the Tinymce@ShortCodes V 1.0
 **/
// Bootstrap file for getting the ABSPATH constant to wp-load.php
require_once('config.php');

// validation for user rights
if ( !is_user_logged_in() || !current_user_can('edit_posts') ) 
	wp_die(__("You are not allowed", 'kslang'));
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title><?php echo $themename .' Shortcodes'; ?></title>
	<!-- Calling meta and JS of TinyMce -->
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
	<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/lib/tinymce/tinymce.js"></script>

	<style>
	html { font-size: 62.5%; height:100%;}
	body { background-image:url(../images/grid.png); font-family: "Helvetica Neue", "Helvetica", Helvetica, Arial, sans-serif; font-size: 12px; line-height: 1; color: white; position: relative; -webkit-font-smoothing: antialiased; }
	</style>

	<base target="_self" />
</head>
<body id="link" onload="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';document.getElementById('put_shortcode_select').focus();" style="display: none">

	<form name="kingsize_style" action="#-1">
	<div class="tabs">
		<ul>
			<li id="style_tab" class="current"><span><a href="javascript:mcTabs.displayTab('style_tab','shortcode_panel');" onmousedown="return false;"><?php echo 'Styles'; ?></a></span></li>
		</ul>
	</div>
	
	<div class="panel_wrapper" style="height:142px;">

		<div id="shortcode_panel" class="style_panel">
		<br />
		<fieldset>
			<legend>Insert a shortcode from the drop down menu.</legend>
		<table border="0" cellpadding="4" cellspacing="0">
         <tr>
            <td nowrap="nowrap"><label for="put_shortcode_select">Select Custom Style:</label></td>
            <td> <!-- Putting all of the shortcodes shortcode of lib/shortcodes.php -->
			<select id="put_shortcode_select" name="put_shortcode_select" style="width: 200px">
				<option value="accordion">Accordion</option>
				<option value="accordion_active">Accordion (Active)</option>
				<option value="toggle_basic">Basic Toggle</option>
				<option value="blockquote">Blockquotes</option>
				<option value="button">Button</option>
				<option value="tabs_basic">Basic Tabs</option>
				<option value="blog">Blog</option>
				<option value="contact">Contact Form</option>
				<option value="download_box">Download Box</option>
				<option value="dropcap">Dropcap</option>
				<option value="error_box">Error Box</option>
				<option value="img_gallery">Gallery</option>
				<option value="googlemap">Google Maps</option>
				<option value="my_highlight">Highlighted text</option>
				<option value="img_floated_left">Image Left</option>
				<option value="img_floated_right">Image Right</option>
				<option value="info_box">Info Box</option>
                <option value="0">No Style</option>
				<option value="one_half_dropcaps">One Half Dropcaps</option>
				<option value="one_half_alt_last_dropcaps">One Half Alt Last Dropcaps</option>
				<option value="one_third">One-third Div</option>
				<option value="one_third_last">One-third Div Last</option>
				<option value="one_half">One Half Div</option>
				<option value="one_half_last">One-half Div Last</option>
				<option value="portfolio">Portfolio</option>
				<option value="related_posts">Related Posts</option>
				<option value="two_thirds">Two-thirds Div</option>
				<option value="two_thirds_last">Two-thirds Div Last</option>
				<option value="tooltip_link">Tooltip with Link</option>
				<option value="toggle">Toggle</option>
				<option value="tabs">Tabs</option>
				<option value="table">Tables</option>
				<option value="video">Video</option>		
				<option value="warning_box">Warning Box</option>
            </select>
			</td>
          </tr>
        </table>
		</fieldset>
		</div>

	</div>

	<div class="mceActionPanel">
		<div style="float: left;">
			<input type="button" id="cancel" name="cancel" value="<?php echo "Cancel"; ?>" onclick="tinyMCEPopup.close();" />
		</div>

		<div style="float: right;">
			<input type="submit" id="insert" name="insert" value="<?php echo "Insert"; ?>" onclick="insertkingsizeLink();" />
		</div>
	</div>
</form>
</body>
</html>
