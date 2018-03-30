<?php

// Load the CSS for the custom shortcode forms
function js_shortcode_admin_head() {
	
	$template_dir = get_template_directory_uri(); ?>
	<link rel="stylesheet" type="text/css" href="<?php echo $template_dir; ?>/_theme_settings/shortcodes/admin-styles.css"><?php

}

add_action('admin_head', 'js_shortcode_admin_head');

// Load the Shortcodes
include('shortcodes/columns/columns.php');
include('shortcodes/highlight/highlight.php');