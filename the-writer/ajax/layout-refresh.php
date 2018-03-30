<?php function ocmx_layout_refresh(){
	global $theme_options;
	require_once(get_template_directory()."/ocmx/theme-setup/theme-options.php");

	update_option("ocmx_home_page_layout", $_GET["layout"]);
	$use_option = $_GET["layout_option"];
	
	layout_form($theme_options[$use_option]);
	
	die("");
}
?>