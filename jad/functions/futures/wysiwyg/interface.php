<?php

define('WP_DEBUG', false);
define('DOING_AJAX', true);
define('WP_ADMIN', true);

require_once('../../../../../../wp-load.php');

if (!is_user_logged_in() OR !current_user_can('edit_posts'))
	wp_die(__('You are not allowed to be here', SG_TDN));
?>

<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title>Shortcodes</title>
		<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php echo get_option('blog_charset'); ?>" />
		<script language="javascript" type="text/javascript" src="<?php echo get_template_directory_uri() ?>/functions/futures/wysiwyg/wysiwyg.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo get_option('siteurl') ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<base target="_self" />
	</head>
	<body onLoad="tinyMCEPopup.executeOnLoad('init();');document.body.style.display='';" style="display: none;" id="link">
		<form name="kotofey_shortcode_form" action="#">
			<div class="shortcode_wrap" style="height:100px;width:250px;margin:0 auto;margin-top:30px;text-align:center;" >
				<div id="shortcode_panel" class="current" style="height:50px;">
					<fieldset style="border:0;width:100%;text-align:center;">
						<select id="style_shortcode" name="style_shortcode" style="width:250px">
							<option value="0"><?php _e('Select a Shortcode...', SG_TDN); ?></option>
							<optgroup label="<?php _e('Dividers', SG_TDN); ?>">
								<option value="hr1"><?php _e('Basic Divider', SG_TDN); ?></option>
								<option value="hr2"><?php _e('Blank Divider', SG_TDN); ?></option>
								<option value="clear"><?php _e('Clear Fix', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Headers', SG_TDN); ?>">
								<option value="h1-custom"><?php _e('H1', SG_TDN); ?></option>
								<option value="h2-custom"><?php _e('H2', SG_TDN); ?></option>
								<option value="h3-custom"><?php _e('H3', SG_TDN); ?></option>
								<option value="h4-custom"><?php _e('H4', SG_TDN); ?></option>
								<option value="h5-custom"><?php _e('H5', SG_TDN); ?></option>
								<option value="h6-custom"><?php _e('H6', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Widgets', SG_TDN); ?>">
								<option value="tabs"><?php _e('Tabs', SG_TDN); ?></option>
								<option value="accordion"><?php _e('Accordion', SG_TDN); ?></option>
								<option value="toggle"><?php _e('Toggle Box', SG_TDN); ?></option>
								<option value="progress"><?php _e('Progress Bar', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Column Shortcodes', SG_TDN); ?>">
								<option value="two_columns"><?php _e('2 Columns', SG_TDN); ?></option>
								<option value="three_columns"><?php _e('3 Columns', SG_TDN); ?></option>
								<option value="four_columns"><?php _e('4 Columns', SG_TDN); ?></option>
								<option value="five_columns"><?php _e('5 Columns', SG_TDN); ?></option>
								<option value="six_columns"><?php _e('6 Columns', SG_TDN); ?></option>
								<option value="1/4+3/4"><?php _e('1/4 Column + 3/4 Column', SG_TDN); ?></option>
								<option value="3/4+1/4"><?php _e('3/4 Column + 1/4 Column', SG_TDN); ?></option>
								<option value="1/3+2/3"><?php _e('1/3 Column + 2/3 Column', SG_TDN); ?></option>
								<option value="2/3+1/3"><?php _e('2/3 Column + 1/3 Column', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Block Quote', SG_TDN); ?>">
								<option value="block-quote-left"><?php _e('Block quote left', SG_TDN); ?></option>
								<option value="block-quote-right"><?php _e('Block quote right', SG_TDN); ?></option>
								<option value="testimonials"><?php _e('Testimonials', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('List Shortcodes', SG_TDN); ?>">
								<option value="cb1"><?php _e('Check Box List', SG_TDN); ?></option>
								<option value="cb2"><?php _e('Round Check Box List', SG_TDN); ?></option>
								<option value="sr1"><?php _e('Star List', SG_TDN); ?></option>
								<option value="sr2"><?php _e('Round Star List', SG_TDN); ?></option>
								<option value="aw1"><?php _e('Arrow List', SG_TDN); ?></option>
								<option value="aw2"><?php _e('Round Arrow List', SG_TDN); ?></option>
								<option value="cd1"><?php _e('Green Disk List', SG_TDN); ?></option>
								<option value="cd4"><?php _e('Blue Disk List', SG_TDN); ?></option>
								<option value="ab1"><?php _e('Arrow Bullet List', SG_TDN); ?></option>
								<option value="ab2"><?php _e('Round Arrow Bullet List', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Alert Boxes', SG_TDN); ?>">
								<option value="alert-success"><?php _e('Success Alert', SG_TDN); ?></option>
								<option value="alert-info"><?php _e('Attention Alert', SG_TDN); ?></option>
								<option value="alert-alert"><?php _e('Error Alert', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Links', SG_TDN); ?>">
								<option value="link-link"><?php _e('Simple Link', SG_TDN); ?></option>
								<option value="gray-link"><?php _e('Gray Link', SG_TDN); ?></option>
								<option value="theme-link"><?php _e('Theme Link', SG_TDN); ?></option>
								<option value="custom-link"><?php _e('Custom Color Link', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Buttons', SG_TDN); ?>">
								<option value="link-button"><?php _e('Simple Button', SG_TDN); ?></option>
								<option value="gray-button"><?php _e('Gray Button', SG_TDN); ?></option>
								<option value="theme-button"><?php _e('Theme Button', SG_TDN); ?></option>
								<option value="custom-button"><?php _e('Custom Color Button', SG_TDN); ?></option>
								<option value="link-button-r"><?php _e('Rounded Simple Button', SG_TDN); ?></option>
								<option value="gray-button-r"><?php _e('Rounded Gray Button', SG_TDN); ?></option>
								<option value="theme-button-r"><?php _e('Rounded Theme Button', SG_TDN); ?></option>
								<option value="custom-button-r"><?php _e('Rounded Custom Color Button', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Big Buttons', SG_TDN); ?>">
								<option value="big-link-button"><?php _e('Simple Button', SG_TDN); ?></option>
								<option value="big-gray-button"><?php _e('Gray Button', SG_TDN); ?></option>
								<option value="big-theme-button"><?php _e('Theme Button', SG_TDN); ?></option>
								<option value="big-custom-button"><?php _e('Custom Color Button', SG_TDN); ?></option>
								<option value="big-link-button-r"><?php _e('Rounded Simple Button', SG_TDN); ?></option>
								<option value="big-gray-button-r"><?php _e('Rounded Gray Button', SG_TDN); ?></option>
								<option value="big-theme-button-r"><?php _e('Rounded Theme Button', SG_TDN); ?></option>
								<option value="big-custom-button-r"><?php _e('Rounded Custom Color Button', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Highlight', SG_TDN); ?>">
								<option value="hl-theme"><?php _e('Main theme color highlight', SG_TDN); ?></option>
								<option value="hl-red"><?php _e('Red highlight', SG_TDN); ?></option>
								<option value="hl-blue"><?php _e('Blue highlight', SG_TDN); ?></option>
								<option value="hl-green"><?php _e('Green highlight', SG_TDN); ?></option>
								<option value="hl-grey"><?php _e('Grey highlight', SG_TDN); ?></option>
								<option value="hl-black"><?php _e('Black highlight', SG_TDN); ?></option>
								<option value="hl-orange"><?php _e('Orange highlight', SG_TDN); ?></option>
								<option value="hl-gold"><?php _e('Gold highlight', SG_TDN); ?></option>
								<option value="hl-lime"><?php _e('Lime highlight', SG_TDN); ?></option>
								<option value="hl-turquoise"><?php _e('Turquoise highlight', SG_TDN); ?></option>
								<option value="hl-violet"><?php _e('Violet highlight', SG_TDN); ?></option>
								<option value="hl-custom"><?php _e('Custom color highlight', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Social', SG_TDN); ?>">
								<option value="social"><?php _e('Social List', SG_TDN); ?></option>
								<option value="soc_skype">--> <?php _e('Skype', SG_TDN); ?></option>
								<option value="soc_dribbble">--> <?php _e('Dribbble', SG_TDN); ?></option>
								<option value="soc_twitter">--> <?php _e('Twitter', SG_TDN); ?></option>
								<option value="soc_facebook">--> <?php _e('Facebook', SG_TDN); ?></option>
								<option value="soc_flickr">--> <?php _e('Flickr', SG_TDN); ?></option>
								<option value="soc_linkedin">--> <?php _e('LinkedIn', SG_TDN); ?></option>
								<option value="soc_deviantart">--> <?php _e('DeviantArt', SG_TDN); ?></option>
								<option value="soc_pinterest">--> <?php _e('Pinterest', SG_TDN); ?></option>
								<option value="soc_vimeo">--> <?php _e('Vimeo', SG_TDN); ?></option>
								<option value="soc_tumblr">--> <?php _e('Tumblr', SG_TDN); ?></option>
								<option value="soc_behance">--> <?php _e('Behance', SG_TDN); ?></option>
								<option value="soc_gp">--> <?php _e('G+', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Dropcaps', SG_TDN); ?>">
								<option value="dropcap"><?php _e('Gray Color Letter', SG_TDN); ?></option>
								<option value="dropcap-first"><?php _e('First Color Letter', SG_TDN); ?></option>
								<option value="dropcap-nobg"><?php _e('No BackGround Letter', SG_TDN); ?></option>
								<option value="dropcap-custom"><?php _e('Custom Color Letter', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Tables', SG_TDN); ?>">
								<option value="table"><?php _e('Table', SG_TDN); ?></option>
								<option value="price"><?php _e('Price Table', SG_TDN); ?></option>
							</optgroup>
							<optgroup label="<?php _e('Media', SG_TDN); ?>">
								<option value="youtube"><?php _e('YouTube video', SG_TDN); ?></option>
								<option value="vimeo"><?php _e('Vimeo video', SG_TDN); ?></option>
							</optgroup>
						</select>
					</fieldset>
				</div>
				<div style="float:left"><input type="button" id="cancel" name="cancel" value="<?php _e('Close', SG_TDN); ?>" onClick="tinyMCEPopup.close();" /></div>
				<div style="float:right"><input type="submit" id="insert" name="insert" value="<?php _e('Insert', SG_TDN); ?>" onClick="embedshortcode();" /></div>
			</div>
		</form>
	</body>
</html>
