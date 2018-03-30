<?php
/**
 * @package Evential
 * @subpackage Evential
 * @since Evential 1.0
 */

define('THEME_DIR', get_template_directory());
define('THEME_URL', get_template_directory_uri());

define('RMS_FRAMEWORK_DIR', THEME_DIR . '/includes/Framework');
define('RMS_FRAMEWORK_URL', THEME_URL . '/includes/Framework');
/*
*   Load FRAMEWORK.
*/
require dirname(__FILE__) . '/Framework/bootstrap_load.php';