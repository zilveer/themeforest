<?php
require_once('config.php');

if ( !is_user_logged_in() || !current_user_can('edit_posts') ) wp_die(__("You are not allowed to be here", 'ch')); ?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Shortcodes</title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/admin/wysiwyg/wysiwyg.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<base target="_self" />
	</head>
	<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none" id="link">
		<form name="ch_shortcode_form" action="#">
			<div style="height:100px;width:250px;margin:0 auto;padding-top:50px;text-align:center;" class="shortcode_wrap">
				<div id="shortcode_panel" class="current" style="height:50px;">
					<fieldset style="border:0;width:100%;text-align:center;">
						<select id="style_shortcode" name="style_shortcode" style="width:250px">
							<option value="0">--Select a Shortcode--</option>
							<option value="0"> </option>
							<option value="0">--Column Layouts--</option>
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
							<option value="0">--Layout Elements--</option>
							<option value="accordion">Accordion</option>
							<option value="toggle">Toggle</option>
							<option value="tabs">Tabs</option>
							<option value="table">Table</option>
							<option value="youtube_video">Youtube video</option>
							<option value="dailymotion_video">Dailymotion video</option>
							<option value="vimeo_video">Vimeo video</option>
							<option value="html5_video">HTML5 video</option>

							<option value="0"> </option>
							<option value="0">--Latest Blog Posts--</option>
							<option value="blog_posts">Default Layout (with thumbnails)</option>
							<option value="blog_posts_without">Default Layout (without thumbnails)</option>

							<option value="0"> </option>
							<option value="0">--Staff--</option>
							<option value="staff">Staff</option>

							<option value="0"> </option>
							<option value="0">--Cause--</option>
							<option value="cause">Cause</option>

							<option value="0"> </option>
							<option value="0">--Text Styling--</option>
							<option value="dropcaps">Dropcaps</option>
							<option value="highlight">Label</option>
							<option value="badge">Badge</option>
							<option value="text_h1">Heading 1 (H1)</option> 
							<option value="text_h2">Heading 2 (H2)</option> 
							<option value="text_h3">Heading 3 (H3)</option> 
							<option value="text_h4">Heading 4 (H4)</option> 
							<option value="text_h5">Heading 5 (H5)</option> 
							<option value="text_h6">Heading 6 (H6)</option>

							<option value="0"> </option>
							<option value="0">--Lists--</option>
							<option value="add_document">Add Document List</option>
							<option value="alert_list">Alert List</option>
							<option value="check_list">Check List</option>
							<option value="info_list">Info List</option>

							<option value="0"> </option>
							<option value="0">--Message Boxes--</option>
							<option value="quote_box">Quote Box</option>
							<option value="info_box">Info Message Box</option>
							<option value="success_box">Success Message Box</option>
							<option value="warning_box">Warning Message Box</option>
							<option value="error_box">Error Message Box</option>
							<option value="custom_box">Custom Message Box</option>

							<option value="0"> </option>
							<option value="0">--Buttons--</option>
							<option value="default_button">Default</option>
							<option value="btn-primary">Primary</option>
							<option value="btn-info">Info</option>
							<option value="btn-success">Success</option>
							<option value="btn-warning">Warning</option>
							<option value="btn-danger">Danger</option>
							<option value="btn-inverse">Inverse</option>
							<option value="custom_button">Custom</option>

							<option value="0"> </option>
							<option value="0">--Dividers--</option>
							<option value="basic_divider">Basic Divider</option> 
							<option value="shadow_divider">Shadow Divider</option>

							<option value="0"> </option>
							<option value="0">--Gallery--</option>
							<option value="small_gallery">Small Gallery</option>
							<option value="medium_gallery">Medium Gallery</option>
							<option value="large_gallery">Large Gallery</option>
							<option value="standard_gallery">Standard Gallery</option>
						</select>
					</fieldset>
				</div><!-- end shortcode_panel -->
				<div style="float:left"><input type="button" id="cancel" name="cancel" value="<?php echo "Close"; ?>" onClick="tinyMCEPopup.close();" /></div>
				<div style="float:right"><input type="submit" id="insert" name="insert" value="<?php echo "Insert"; ?>" onClick="embedshortcode();" /></div>
			</div><!-- end shortcode_wrap -->
		</form>
	</body>
</html>