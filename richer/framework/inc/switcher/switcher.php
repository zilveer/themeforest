<?php 
	wp_register_script('styleSwitcher', get_template_directory_uri() . '/framework/inc/switcher/js/switch.js', 'jquery', '1.0', TRUE);
	wp_enqueue_script('styleSwitcher');
?>
<div id="style_selector"><input id="templateURI" type="hidden" value="<?php echo get_template_directory_uri(); ?>"></div>