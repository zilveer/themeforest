<?php

$wp_include = "../wp-load.php";
$i = 0;

while (!file_exists($wp_include) && $i++ < 20) {
	$wp_include = "../$wp_include";
}

require $wp_include;

if (!current_user_can('edit_pages') && !current_user_can('edit_posts')) wp_die(__("You are not allowed to be here", "alive"));

global $wpdb;

?>

<!DOCTYPE HTML>

<html>
	<!-- START head -->
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title></title>	
		<script language="javascript" type="text/javascript" src="<?php echo home_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo home_url(); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo home_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo THEME_URL; ?>/js/jquery-1.7.1.min.js"></script>
		<link rel="stylesheet" href="<?php echo THEME_URL; ?>/js/tinymce/styles.css" />
		<script type="text/javascript" src="<?php echo THEME_URL; ?>/js/tinymce/scm.js"></script>
	</head>
	<!-- END head -->
	
	<!-- START body -->
	<body>
		<h3>Select a shortcode from the dropdown box</h3>	
		<!-- START select -->
		<select name="shortcode_dropdown">
		
		<?php global $theme_shortcodes; foreach ($theme_shortcodes as $theme_shortcode) : ?>
		
		<option <?php if (is_array($theme_shortcode['attributes'])) : ?> data-div="sc_<?php echo $theme_shortcode['id']; ?>" <?php else: ?> data-div="none"<?php endif; ?> data-custom="<?php if ($theme_shortcode["custom_output"] != null) : echo $theme_shortcode["custom_output"]; else: echo "false"; endif; ?>" data-content="<?php if ($theme_shortcode["content_required"] == true) : echo "true"; else: echo "false"; endif; ?>" value="<?php echo $theme_shortcode['id']; ?>"><?php echo $theme_shortcode['name']; ?></option>
		
		<?php endforeach; ?>	
		</select>
		<!-- END select -->
		<!-- START #shortcode_atts_panels -->		
		<div id="shortcode_atts_panels">	
			<?php foreach ($theme_shortcodes as $theme_shortcode) : if (is_array($theme_shortcode['attributes'])) : ?>		
			<!-- START .shortcode_atts_panel -->
			<div class="shortcode_atts_panel" id="sc_<?php echo $theme_shortcode['id']; ?>" style="display: none;">		
				<?php foreach ($theme_shortcode['attributes'] as $attribute) : ?>
				<!-- START .shortcode_att -->				
				<div class="shortcode_att">
					<h4 class="shortcode_att_title"><?php echo $attribute['name']; ?></h4>
					<input type="text" id="sc_att_<?php echo $attribute['id']; ?>" class="shortcode_att_input" value="" />
					<div class="shortcode_att_desc"><?php echo $attribute['desc']; ?></div>
				</div>
				<!-- END .shortcode_att -->	
				<?php endforeach; ?>
			</div>
			<!-- END .shortcode_atts_panel -->
			<?php endif; endforeach; ?>
		</div>
		<!-- END #shortcode_atts_panels -->		
		<a id="submit" href="#">Generate</a>
	</body>
	<!-- END head -->
</html>