<?php

//define constants
define('MIKADO_ROOT', get_template_directory_uri());
define('MIKADO_ROOT_DIR', get_template_directory());
define('MIKADO_ASSETS_ROOT', get_template_directory_uri().'/assets');
define('MIKADO_ASSETS_ROOT_DIR', get_template_directory().'/assets');
define('MIKADO_FRAMEWORK_ROOT', get_template_directory_uri().'/framework');
define('MIKADO_FRAMEWORK_ROOT_DIR', get_template_directory().'/framework');
define('MIKADO_FRAMEWORK_MODULES_ROOT', get_template_directory_uri().'/framework/modules');
define('MIKADO_FRAMEWORK_MODULES_ROOT_DIR', get_template_directory().'/framework/modules');
define('MIKADO_THEME_ENV', 'dev');

//include necessary files
include_once MIKADO_ROOT_DIR.'/framework/mkd-framework.php';
include_once MIKADO_ROOT_DIR.'/includes/nav-menu/mkd-menu.php';
include_once MIKADO_ROOT_DIR.'/includes/sidebar/mkd-custom-sidebar.php';
include_once MIKADO_ROOT_DIR.'/includes/mkd-related-posts.php';
include_once MIKADO_ROOT_DIR.'/includes/mkd-options-helper-functions.php';
include_once MIKADO_ROOT_DIR.'/includes/sidebar/sidebar.php';
require_once MIKADO_ROOT_DIR.'/includes/plugins/class-tgm-plugin-activation.php';
include_once MIKADO_ROOT_DIR.'/includes/plugins/plugins-activation.php';
include_once MIKADO_ROOT_DIR.'/assets/custom-styles/general-custom-styles.php';
include_once MIKADO_ROOT_DIR.'/assets/custom-styles/general-custom-styles-responsive.php';
include_once MIKADO_ROOT_DIR.'/includes/mkd-gradient-helper-functions.php';

if(!is_admin()) {
	include_once MIKADO_ROOT_DIR.'/includes/mkd-body-class-functions.php';
	include_once MIKADO_ROOT_DIR.'/includes/mkd-loading-spinners.php';
}