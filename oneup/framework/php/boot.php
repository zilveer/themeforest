<?php

define('ENVATO_PHASE_2',false);

// framework location
define('PE_FRAMEWORK',dirname(dirname(__FILE__)));
define('PE_THEME_META','pe_theme_meta');

if (defined('PE_THEME_PLUGIN_MODE')) {
	define('PE_THEME_URL',plugins_url()."/pe-theme-framework");
} else {
	define('PE_THEME_URL',get_bloginfo("template_url"));
	define('PE_THEME_PLUGIN_MODE',false);
}

if (!defined('PE_THEME_PLUGIN')) {
	define('PE_THEME_PLUGIN',!ENVATO_PHASE_2);
}

if (!defined('PE_META_REVISIONED')) {
	define('PE_META_REVISIONED',true);
}

if (!defined('PE_SAVE_BUILDER_IN_POST_CONTENT')) {
	define('PE_SAVE_BUILDER_IN_POST_CONTENT',true);
}

define('PE_THEME_MODE',!PE_THEME_PLUGIN_MODE);

function __pe($text) {return $text;}
function e__pe($text) {echo $text;}

require(PE_FRAMEWORK."/php/PeGlobal.php");

PeGlobal::$config["classPath"] = apply_filters('pe_theme_class_paths',
	array(
		  PE_THEME_PATH."/theme/php/PeTheme",
		  PE_FRAMEWORK."/php/PeTheme"
		  ));

PeGlobal::$config["libPath"] = apply_filters('pe_theme_lib_paths',
	array(
		  PE_FRAMEWORK."/php/libs"
		  ));

PeGlobal::init();

// instantiate the controller
if (!function_exists("peTheme")) {
	$peThemeClassName = apply_filters('pe_theme_controller_classname','PeTheme'.PE_THEME_NAME);
	
	PeGlobal::$controller = new $peThemeClassName();

	function &peTheme() {
		return PeGlobal::$controller;
	}

	peTheme()->boot();
	
}

if ( ! isset( $content_width ) ) {
	$content_width = PeGlobal::$config["content-width"];
}

add_action("init", array(peTheme(),"init"));

if (has_action("after_switch_theme")) {
	// 3.3 and upper
	add_action("after_switch_theme", array(peTheme(),"after_switch_theme"));
} else if (is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
	// below 3.3
	peTheme()->after_switch_theme('pe_theme');
}

add_action("after_setup_theme", array(peTheme(),"after_setup_theme"));
//add_action("template_redirect", array(peTheme(),"enqueueAssets"),1);
add_action("wp_enqueue_scripts", array(peTheme(),"enqueueAssets"),1);

add_action("add_meta_boxes", array(peTheme(),"add_meta_boxes"),10,2);
add_action("save_post",array(peTheme(),"save_post"),10,2);

if (PE_THEME_MODE && PE_SAVE_BUILDER_IN_POST_CONTENT && peTheme()->options->get("builderInContent") === 'yes') {
	add_filter("wp_insert_post_data",array(peTheme(),"wp_insert_post_data_filter"),10,2);
}

// revision stuff
if (PE_THEME_PLUGIN && PE_META_REVISIONED) {
	add_action("save_post_revision",array(peTheme(),"save_post_revision"),10,2);
	add_action("admin_action_editpost",array(peTheme(),"admin_action_editpost"));
	add_action("wp_restore_post_revision",array(peTheme(),"wp_restore_post_revision"),10,2);
	add_filter("wp_save_post_revision_check_for_changes",array(peTheme(),"wp_save_post_revision_check_for_changes"),10,3);
	add_filter("_wp_post_revision_field_post_content",array(peTheme(),"_wp_post_revision_field_post_content"),10,4);
	add_filter("_wp_post_revision_field_post_title",array(peTheme(),"_wp_post_revision_field_post_title"),10,4);
	add_filter("the_preview",array(peTheme(),"the_preview_filter"),99,1);
}

if (PE_THEME_PLUGIN_MODE) {
	add_action("pre_post_update",array(peTheme(),"save_post"),10,2);
}

add_action("edit_attachment",array(peTheme(),"edit_attachment"),10,2);

add_action("admin_menu",array(peTheme(),"admin_menu"));
add_action("admin_init",array(peTheme(),"admin_init"));
add_action("widgets_init",array(peTheme(),"widgets_init"));
add_action("dbx_post_advanced",array(peTheme(),"dbx_post_advanced"));
add_action("sidebar_admin_setup",array(peTheme(),"sidebar_admin_setup"));

add_action("export_wp",array(peTheme(),"export_wp"));
add_action("rss2_head",array(peTheme(),"rss2_head"));

add_action("wp_ajax_nopriv_peThemeContactForm",array(peTheme(),"contactForm"));
add_action("wp_ajax_peThemeContactForm",array(peTheme(),"contactForm"));

add_action("wp_ajax_nopriv_peThemeNewsletter",array(peTheme(),"newsletter"));
add_action("wp_ajax_peThemeNewsletter",array(peTheme(),"newsletter"));



if ((defined('PE_DEBUG_THEME') || defined('PE_DEBUG_FRAMEWORK'))) {
	peTheme()->debug->init();
}

?>
