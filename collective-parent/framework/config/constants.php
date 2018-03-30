<?php

if (!defined('TFUSE'))
    exit('Direct access forbidden.');
/*
 * This file contains the framework constants
 */

define('TF_PREFIX', 'TF_');
define('TFUSE_THEME_DIR', get_template_directory());
define('TFUSE_THEME_URI', get_template_directory_uri());
define('TFUSE_CHILD_DIR', get_stylesheet_directory());
define('TFUSE_CHILD_URI', get_stylesheet_directory_uri());
define('TFUSE_CHILD', TFUSE_CHILD_DIR . '/framework');

define('TFUSE_THEME_LIBRARY', TFUSE_THEME_DIR . '/includes');
define('TFUSE_THEME_INSTALL', TFUSE_THEME_DIR . '/install');
define('TFUSE_FRAMEWORK', TFUSE_THEME_DIR . '/library');

define('TFUSE_CHILD_LIBRARY', TFUSE_CHILD_DIR . '/includes');
define('TFUSE_CHILD_INSTALL', TFUSE_CHILD_DIR . '/install');
define('TFUSE_CHILD_FRAMEWORK', TFUSE_CHILD_DIR . '/library');
define('TFUSE_OPTIONS', TFUSE_CHILD . '/options');


define('TFUSE_THEME_ADMIN', TFUSE_FRAMEWORK . '/admin');
define('TFUSE_THEME_FUNCTIONS', TFUSE_FRAMEWORK . '/functions');

define('TFUSE_CHILD_ADMIN', TFUSE_CHILD_FRAMEWORK . '/admin');
define('TFUSE_CHILD_FUNCTIONS', TFUSE_CHILD_FRAMEWORK . '/functions');


define('TFUSE_ADMIN_IMAGES', TFUSE_THEME_URI . '/framework/static/images');
define('TFUSE_ADMIN_CSS', TFUSE_THEME_URI . '/framework/static/css');
define('TFUSE_ADMIN_JS', TFUSE_THEME_URI . '/framework/static/javascript');

define('TFUSE_CHILD_IMAGES', TFUSE_CHILD_URI . '/framework/static/images');
define('TFUSE_CHILD_CSS', TFUSE_CHILD_URI . '/framework/static/css');
define('TFUSE_CHILD_JS', TFUSE_CHILD_URI . '/framework/static/javascript');

define('TFUSE_MIN', TFUSE . '/min');
define('TFUSE_MIN_CACHE', TFUSE_THEME_DIR . '/cache');

define('TFUSE_CONFIG', TFUSE_THEME_DIR . '/theme_config');
define('TFUSE_CONFIG_DIR', 'theme_config');

define('TFUSE_CONFIG_ADMIN_INCLUDES', TFUSE_THEME_DIR . '/theme_config/admin_includes');
define('TFUSE_CONFIG_ADMIN_INCLUDES_DIR', 'theme_config/admin_includes');

define('TFUSE_CONFIG_THEME_INCLUDES', TFUSE_THEME_DIR . '/theme_config/theme_includes');
define('TFUSE_CONFIG_THEME_INCLUDES_DIR', 'theme_config/theme_includes');

define('TFUSE_CONFIG_COMMON_INCLUDES', TFUSE_THEME_DIR . '/theme_config/common_includes');
define('TFUSE_CONFIG_COMMON_INCLUDES_DIR', 'theme_config/common_includes');

define('TFUSE_CONFIG_SHORTCODES', TFUSE_THEME_DIR . '/theme_config/extensions/shortcodes');
define('TFUSE_CONFIG_SHORTCODES_DIR', 'theme_config/shortcodes');

define('TFUSE_CONFIG_WIDGETS', TFUSE_THEME_DIR . '/theme_config/widgets');
define('TFUSE_CONFIG_WIDGETS_DIR', 'theme_config/widgets');

define('TFUSE_CHILD_CONFIG', TFUSE_CHILD_DIR . '/theme_config');
define('TFUSE_CHILD_EXT_CONFIG', TFUSE_CHILD_CONFIG . '/extensions');
define('TFUSE_CONFIG_FILE', TFUSE_CONFIG . '/config/theme_config.php');
define('TFUSE_THEME_CONFIG_URL', TFUSE_THEME_URI . '/theme_config');

define('TFUSE_EXT_DIR', TFUSE . '/extensions');
define('TFUSE_EXT_URI', TFUSE_THEME_URI . '/framework/extensions');
define('TFUSE_EXT_CONFIG_URI', TFUSE_THEME_URI . '/theme_config/extensions');
define('TFUSE_EXT_CONFIG', TFUSE_CONFIG . '/extensions');
define('TFUSE_EXT_CONFIG_DIR', TFUSE_CONFIG_DIR . '/extensions');