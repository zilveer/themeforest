<?php

//define constants
define('ELATED_ROOT', get_template_directory_uri());
define('ELATED_ROOT_DIR', get_template_directory());
define('ELATED_ASSETS_ROOT', get_template_directory_uri().'/assets');
define('ELATED_ASSETS_ROOT_DIR', get_template_directory().'/assets');
define('ELATED_FRAMEWORK_ROOT', get_template_directory_uri().'/framework');
define('ELATED_FRAMEWORK_ROOT_DIR', get_template_directory().'/framework');
define('ELATED_FRAMEWORK_MODULES_ROOT', get_template_directory_uri().'/framework/modules');
define('ELATED_FRAMEWORK_MODULES_ROOT_DIR', get_template_directory().'/framework/modules');
define('ELATED_THEME_ENV', 'dev');

//include necessary files
include_once ELATED_ROOT_DIR.'/framework/eltd-framework.php';
include_once ELATED_ROOT_DIR.'/includes/nav-menu/eltd-menu.php';
include_once ELATED_ROOT_DIR.'/includes/sidebar/eltd-custom-sidebar.php';
include_once ELATED_ROOT_DIR.'/includes/eltd-related-posts.php';
include_once ELATED_ROOT_DIR.'/includes/eltd-options-helper-functions.php';
include_once ELATED_ROOT_DIR.'/includes/sidebar/sidebar.php';
require_once ELATED_ROOT_DIR.'/includes/plugins/class-tgm-plugin-activation.inc';
include_once ELATED_ROOT_DIR.'/includes/plugins/plugins-activation.php';
include_once ELATED_ROOT_DIR.'/assets/custom-styles/general-custom-styles.php';
include_once ELATED_ROOT_DIR.'/assets/custom-styles/general-custom-styles-responsive.php';

if(!is_admin()) {
    include_once ELATED_ROOT_DIR.'/includes/eltd-body-class-functions.php';
    include_once ELATED_ROOT_DIR.'/includes/eltd-loading-spinners.php';
}