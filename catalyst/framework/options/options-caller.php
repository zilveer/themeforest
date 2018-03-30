<?php

if ( !function_exists( 'optionsframework_init' ) ) {

/*-----------------------------------------------------------------------------------*/
/* Options Framework Theme
/*-----------------------------------------------------------------------------------*/

/* Set the file path based on whether the Options Framework Theme is a parent theme or child theme */


define('OPTIONS_FRAMEWORK_ROOT', MTHEME_PARENTDIR . '/framework/options/');
define('OPTIONS_FRAMEWORK_URL', MTHEME_PARENTDIR . '/framework/options/admin/');
define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/framework/options/admin/');

require_once (OPTIONS_FRAMEWORK_URL . 'options-framework.php');

}

/* 
 * This is an example of how to add custom scripts to the options panel.
 * This one shows/hides the an option when a checkbox is clicked.
 */

add_action('optionsframework_custom_scripts', 'optionsframework_custom_scripts');

function optionsframework_custom_scripts() { ?>

<script type="text/javascript">
jQuery(document).ready(function() {

	jQuery('#example_showhidden').click(function() {
  		jQuery('#section-example_text_hidden').fadeToggle(400);
	});
	
	if (jQuery('#example_showhidden:checked').val() !== undefined) {
		jQuery('#section-example_text_hidden').show();
	}
	
});
</script>

<?php
}

/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	//$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	//$themename = $themename['Name'];
	//$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$themename="mtheme_responsive";
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);

}

require_once (OPTIONS_FRAMEWORK_ROOT . 'options-data.php');


//Homepage Sortable AJAX
function mtheme_save_home_order() {
	$order=$_POST['order'];
	update_option('mtheme_home_order',$order);
	die(1);
}
add_action('wp_ajax_home_sort', 'mtheme_save_home_order');
?>