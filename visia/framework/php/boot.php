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

	function pe_theme_error_handler($errno, $errstr, $errfile, $errline) {
		global $_pe_theme_errors;

		if (!isset($_pe_theme_errors)) {
			$_pe_theme_errors = array();
			register_shutdown_function('pe_theme_shutdown');
		}
		$_pe_theme_errors[] = array($errno, $errstr, $errfile, $errline);
	}

	function pe_theme_error_sort($a,$b) {
		$s = strnatcmp($a[2],$b[2]);
		return $s === 0 ? $a[3] - $b[3] : $s;
	}

	function pe_theme_shutdown() {
		if (defined('DOING_AJAX')) return;

		global $_pe_theme_errors;
		usort($_pe_theme_errors,"pe_theme_error_sort");
		echo "<script>";
		$base = dirname(PE_FRAMEWORK)."/";
		foreach ($_pe_theme_errors as $err) {
			$file = str_replace($base,"",$err[2]);
			if (!defined('PE_DEBUG_FRAMEWORK') && strpos($file,"framework") === 0) continue;
			printf('console.warn("%s",["%s",%d]);',$err[1],$file,$err[3]);
		}
		echo "</script>";
	}

	set_error_handler("pe_theme_error_handler", E_ALL);
}

?>
