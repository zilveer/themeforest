<?php 

$themename = "The Cause";
$pageoptions = array('file' => basename(__FILE__), 'name' => 'The Cause Options', 'child' => false);


// Options
$options = array();
$options[] = array( "name" => $themename." - General Options", "type" => "title");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Logo", "desc" => "Add the full URI path to your logo. Dimensions: max-height: 50px.", "id" => "tb_logo", "type" => "upload", "std" => DEFAULT_LOGO);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Login page", "desc" => "Do you want to change login page?", "id" => "tb_login_change", "type" => "radio", "value" => array('No' => 2, 'Yes' => 1), "std" => 1);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Login Logo", "desc" => "Add the full URI path to logo used on login page.", "id" => "tb_login_logo", "type" => "upload", "std" => DEFAULT_LOGIN_LOGO);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Login page background color", "desc" => "Please choose background color of changed login page.", "id" => "tb_login_bgcolor", "type" => "colorPicker", "std" => DEFAULT_LOGIN_BGCOLOR);
$options[] = array( "type" => "spacer");
$options[] = array( "name" => "Login page background image", "desc" => "Choose background image of changed login page (or leave blank).", "id" => "tb_login_bckg_image", "type" => "upload", "std" => DEFAULT_LOGIN_BCKG_IMAGE);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Favicon", "desc" => "Add the full URI path to your favicon. (16x16px)", "id" => "tb_favicon", "type" => "upload", "std" => DEFAULT_FAVICON);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Menu Icon", "desc" => "Add the full URI path to your menu icon. (16x16px)", "id" => "tb_menu_icon", "type" => "upload", "std" => DEFAULT_MENU_ICON);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Default Icon 50x50", "desc" => "Add the full URI path to your default 50x50 icon. (50x50px)", "id" => "tb_icon50", "type" => "upload", "std" => DEFAULT_ICON50);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Default Icon 80x80", "desc" => "Add the full URI path to your default 80x80 icon. (80x80px)", "id" => "tb_icon80", "type" => "upload", "std" => DEFAULT_ICON80);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Default Icon 150x150", "desc" => "Add the full URI path to your default 150x150 icon. (150x150px)", "id" => "tb_icon150", "type" => "upload", "std" => DEFAULT_ICON150);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Default Avatar", "desc" => "Add the full URI path to your default avatar. (52x52, please)", "id" => "tb_default_Avatar", "type" => "upload", "std" => DEFAULT_AVATAR);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Footer - copyright line", "desc" => "Use HTML tags for links.", "id" => "tb_footer_copyright", "type" => "textarea", "std" => DEFAULT_COPYRIGHT);
$options[] = array( "type" => "close");
$options[] = array( "type" => "open");
$options[] = array( "name" => "Google Analytics Code", "desc" => "Insert Google Analytics Code", "id" => "tb_gac", "type" => "textarea", "std" => "");
$options[] = array( "type" => "close2");

$options[] = array( "type" => "open");
$options[] = array( "name" => "Countdown - Final Date", "desc" => "Format: %year%, %month%, %day%, %hours%, %minutes%, %seconds%", "id" => "tb_countdown", "type" => "text", "std" => "2012, 11, 6, 0, 0, 0");
$options[] = array( "type" => "close2");

// admin init
add_action('admin_init', 'tb_add_init');

function tb_add_init() {
	wp_enqueue_style("tbStyles", get_template_directory_uri() . "/includes/options/tbStyles.css", false, "1.0", "all");
	wp_enqueue_script("tbScripts", get_template_directory_uri() . "/includes/options/tbScripts.js", false, "1.0");

	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');		

	if (!wp_script_is('colorPicker')) {
		wp_register_script('colorPicker', TEMPLATE_DIRECTORY . '/js/colorPicker/js/colorpicker.js', array('jquery'), '1.0', false);
		wp_enqueue_script('colorPicker');
		wp_register_style('colorPickerStyle', TEMPLATE_DIRECTORY . '/js/colorPicker/css/colorpicker.css');
		wp_enqueue_style('colorPickerStyle');
	}
}

$adminOptionsPage = new dashboardPages($options, $pageoptions);

?>