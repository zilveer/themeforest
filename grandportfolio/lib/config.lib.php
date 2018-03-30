<?php
//Setup theme constant and default data
$theme_obj = wp_get_theme('grandportfolio');

define("THEMENAME", $theme_obj['Name']);
define("THEMEDEMO", FALSE);
define("DEMOGALLERYID", 'gallery-archive');
define("SHORTNAME", "pp");
define("SKINSHORTNAME", "ps");
define("THEMEVERSION", $theme_obj['Version']);
define("THEMEDEMOURL", $theme_obj['ThemeURI']);
define("THEMEDATEFORMAT", get_option('date_format'));
define("THEMETIMEFORMAT", get_option('time_format'));

//Get and create default WP uploads folder
$wp_upload_arr = wp_upload_dir();
define("THEMEUPLOAD", $wp_upload_arr['basedir']."/".strtolower(sanitize_title(THEMENAME))."/");
define("THEMEUPLOADURL", $wp_upload_arr['baseurl']."/".strtolower(sanitize_title(THEMENAME))."/");
if(!is_dir(THEMEUPLOAD))
{
	mkdir(THEMEUPLOAD);
}

/**
*  Begin Global variables functions
*/

//Get default WordPress post variable
function grandportfolio_get_wp_post() {
	global $post;
	return $post;
}

//Get default WordPress file system variable
function grandportfolio_get_wp_filesystem() {
	global $wp_filesystem;
	return $wp_filesystem;
}

//Get default WordPress wpdb variable
function grandportfolio_get_wpdb() {
	global $wpdb;
	return $wpdb;
}

//Get default WordPress customize variable
function grandportfolio_get_wp_customize() {
	global $wp_customize;
	return $wp_customize;
}

//Get default WordPress current screen variable
function grandportfolio_get_current_screen() {
	global $current_screen;
	return $current_screen;
}

//Get default WordPress paged variable
function grandportfolio_get_paged() {
	global $paged;
	return $paged;
}

//Get default WordPress registered widgets variable
function grandportfolio_get_registered_widget_controls() {
	global $wp_registered_widget_controls;
	return $wp_registered_widget_controls;
}

//Get default WordPress registered sidebars variable
function grandportfolio_get_registered_sidebars() {
	global $wp_registered_sidebars;
	return $wp_registered_sidebars;
}

//Get default Woocommerce variable
function grandportfolio_get_woocommerce() {
	global $woocommerce;
	return $woocommerce;
}

//Get default theme screen class variable
function grandportfolio_get_screen_class($new_value = '') {
	global $grandportfolio_screen_class;
	return $grandportfolio_screen_class;
}

//Set default theme screen class variable
function grandportfolio_set_screen_class($new_value = '') {
	global $grandportfolio_screen_class;
	$grandportfolio_screen_class = $new_value;
}

//Get default theme page content class variable
function grandportfolio_get_page_content_class() {
	global $grandportfolio_page_content_class;
	return $grandportfolio_page_content_class;
}

//Set default theme page content class variable
function grandportfolio_set_page_content_class($new_value = '') {
	global $grandportfolio_page_content_class;
	$grandportfolio_page_content_class = $new_value;
}

//Get default theme homepage style variable
function grandportfolio_get_homepage_style() {
	global $grandportfolio_homepage_style;
	return $grandportfolio_homepage_style;
}

//Set default theme homepage style variable
function grandportfolio_set_homepage_style($new_value = '') {
	global $grandportfolio_homepage_style;
	$grandportfolio_homepage_style = $new_value;
}

//Get default theme top bar variable
function grandportfolio_get_topbar() {
	global $grandportfolio_topbar;
	return $grandportfolio_topbar;
}

//Set default theme top bar variable
function grandportfolio_set_topbar($new_value = '') {
	global $grandportfolio_topbar;
	$grandportfolio_topbar = $new_value;
}

//Get default theme options variable
function grandportfolio_get_options() {
	global $grandportfolio_options;
	return $grandportfolio_options;
}

//Set default theme options variable
function grandportfolio_set_options($new_value = '') {
	global $grandportfolio_options;
	$grandportfolio_options = $new_value;
}

//Get default page gallery ID variable
function grandportfolio_get_page_gallery_id() {
	global $grandportfolio_page_gallery_id;
	return $grandportfolio_page_gallery_id;
}

//Set default page gallery ID variable
function grandportfolio_set_page_gallery_id($new_value = '') {
	global $grandportfolio_page_gallery_id;
	$grandportfolio_page_gallery_id = $new_value;
}

//Get default hide title variable
function grandportfolio_get_hide_title() {
	global $grandportfolio_hide_title;
	return $grandportfolio_hide_title;
}

//Set default hide title variable
function grandportfolio_set_hide_title($new_value = '') {
	global $grandportfolio_hide_title;
	$grandportfolio_hide_title = $new_value;
}

//Get default page menu transparent variable
function grandportfolio_get_page_menu_transparent() {
	global $grandportfolio_page_menu_transparent;
	return $grandportfolio_page_menu_transparent;
}

//Set default page menu transparent variable
function grandportfolio_set_page_menu_transparent($new_value = '') {
	global $grandportfolio_page_menu_transparent;
	$grandportfolio_page_menu_transparent = $new_value;
}

//Get default page template variable
function grandportfolio_get_page_template() {
	global $grandportfolio_page_template;
	return $grandportfolio_page_template;
}

//Set default page template variable
function grandportfolio_set_page_template($new_value = '') {
	global $grandportfolio_page_template;
	$grandportfolio_page_template = $new_value;
}

//Define all google font usages in customizer
function grandportfolio_get_google_fonts() {
	$grandportfolio_google_fonts = array('tg_body_font', 'tg_header_font', 'tg_menu_font', 'tg_sidemenu_font', 'tg_sidebar_title_font', 'tg_button_font');
	
	return $grandportfolio_google_fonts;
}

//Get page custom fields values
function grandportfolio_get_page_postmetas() {
	global $grandportfolio_page_postmetas;
	
	//Get all sidebars
	$theme_sidebar = array(
		'' => '',
		'Page Sidebar' => 'Page Sidebar', 
		'Contact Sidebar' => 'Contact Sidebar', 
		'Blog Sidebar' => 'Blog Sidebar',
	);
	
	$dynamic_sidebar = get_option('pp_sidebar');
	
	if(!empty($dynamic_sidebar))
	{
		foreach($dynamic_sidebar as $sidebar)
		{
			$theme_sidebar[$sidebar] = $sidebar;
		}
	}
	
	/*
		Get gallery list
	*/
	$args = array(
	    'numberposts' => -1,
	    'post_type' => array('galleries'),
	);
	
	$galleries_arr = get_posts($args);
	$galleries_select = array();
	$galleries_select['(Display Post Featured Image)'] = '';
	
	foreach($galleries_arr as $gallery)
	{
		$galleries_select[$gallery->ID] = $gallery->post_title;
	}
	
	/*
		Get all menus available
	*/
	$menus = get_terms('nav_menu');
	$menus_select = array(
		 '' => '---- Default Menu ----'
	);
	foreach($menus as $each_menu)
	{
		$menus_select[$each_menu->slug] = $each_menu->name;
	}
	
	$grandportfolio_page_postmetas = 
	array (
		/*
			Begin Page custom fields
		*/
		
		array("section" => "Page Title", "id" => "page_show_title", "type" => "checkbox", "title" => "Hide Page Header", "description" => "Check this option if you want to hide page header."),
		
		array("section" => "Page Tagline", "id" => "page_tagline", "type" => "textarea", "title" => "Page Tagline (Optional)", "description" => "Enter page tagline. It will displays under page title (*Note: HTML code also support)"),
		
		array("section" => "Select Sidebar (Optional)", "id" => "page_sidebar", "type" => "select", "title" => "Page Sidebar (Optional)", "description" => "Select this page's sidebar to display.<br/><br/><strong>NOTE: to use this option, you have to select page template end with \"...Sidebar\" only</strong>", "items" => $theme_sidebar),
		
		array("section" => "Select Menu", "id" => "page_menu", "type" => "select", "title" => "Page Menu (Optional)", "description" => "Select this page's menu if you want to display main menu other than default one", "items" => $menus_select),
		
		array("section" => "Content Type", "id" => "page_gallery_id", "type" => "select", "title" => "Gallery", "description" => "You can select image gallery to display on this page. <strong>(If you select Gallery as page template)</strong>", "items" => $galleries_select),
		
		array("section" => "Vimeo Video ID", "id" => "page_ft_vimeo", "type" => "text", "title" => "Vimeo Video ID", "description" => "Please enter Vimeo Video ID for example 73317780 (*Note enter if you select \"Vimeo Video\" as Featured Content Type)"),
			
		array("section" => "Youtube Video ID", "id" => "page_ft_youtube", "type" => "text", "title" => "Youtube Video ID", "description" => "Please enter Youtube Video ID for example 6AIdXisPqHc (*Note enter if you select \"Youtube Video\" as Featured Content Type)"),
	);
	
	$pp_menu_layout = get_option('pp_menu_layout');
	
	if($pp_menu_layout != 'leftmenu')
	{
		$grandportfolio_page_postmetas[] = array("section" => "Page Menu", "id" => "page_menu_transparent", "type" => "checkbox", "title" => "Make Menu Transparent", "description" => "Check this option if you want to display menu in transparent");
	}
	
	return $grandportfolio_page_postmetas;
}

/**
*  End Global variables functions
*/
?>