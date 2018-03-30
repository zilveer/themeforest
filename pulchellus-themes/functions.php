<?php
	define("THEME_NAME", 'pulchellus');
	define("THEME_FULL_NAME", 'Pulchellus');
	
	define("THEME_FUNCTIONS", "functions/");
	define("THEME_INCLUDES", "includes/");
	define("THEME_SLIDERS", THEME_INCLUDES."sliders/");
	define("THEME_SHORTCODES", THEME_INCLUDES."shortcodes/");
	define("THEME_WIDGETS", THEME_INCLUDES."widgets/");
	define("THEME_ADMIN_INCLUDES", THEME_INCLUDES."admin/");
	define("THEME_SCRIPTS", "lib/js/");
	define("THEME_CSS", "lib/css/");

	define("THEME_URL", get_template_directory_uri());

	define("THEME_CSS_URL",THEME_URL."/lib/css/");
	define("THEME_CSS_ADMIN_URL",THEME_URL."/lib/css/admin/");
	define("THEME_JS_URL",THEME_URL."/lib/js/");
	define("THEME_JS_ADMIN_URL",THEME_URL."/lib/js/admin/");
	define("THEME_IMAGE_URL",THEME_URL."/lib/img/");
	define("THEME_IMAGE_CPANEL_URL",THEME_IMAGE_URL."/control-panel-images/");
	define("THEME_FUNCTIONS_URL",THEME_URL."/functions/");
	define("THEME_SHORTCODES_URL",THEME_URL."/includes/shortcodes/");
	define("THEME_ADMIN_URL",THEME_URL."/includes/admin/");

	get_template_part(THEME_FUNCTIONS."init");
	get_template_part(THEME_INCLUDES."widgets/init");
	get_template_part(THEME_INCLUDES."shortcodes/init");
	get_template_part(THEME_INCLUDES."theme-config");
	get_template_part(THEME_INCLUDES."/admin/notifier/update-notifier");


	//remove layserslider notifier
	$GLOBALS['lsAutoUpdateBox'] = false;
	
?>