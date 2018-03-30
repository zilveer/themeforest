<?php
/**
 * Functions and definitions.
 *
 * @package WordPress
 * @subpackage One
 * @since One 1.0
 */

/**
 * Framework.
 * PLEASE LEAVE THIS AREA UNTOUCHED, IN ORDER NOT TO BREAK CORE FUNCTIONALITY.
 * -----------------------------------------------------------------------------
 */
if( !defined('THB_THEME_KEY') ) define( 'THB_THEME_KEY', 'one' ); // Required, not displayed anywhere.

/**
 * Framework.
 */
require_once 'framework/boot.php';

/**
 * General configuration.
 */
thb_system_require_config( 'config-general.php' );

/**
 * Theme functionalities.
 */
thb_system_require_config( 'config-functionalities.php' );

/**
 * Theme options.
 */
thb_system_require_config( 'config-options.php' );

/**
 * Theme customizations.
 */
thb_system_require_config( 'config-custom.php' );

/**
 * Theme plugins.
 */
thb_system_require_config( 'config-plugins.php' );

/**
 * Custom functions.
 */
thb_require_custom_functions();

/**
 * You can start adding your custom functions from here!
 * -----------------------------------------------------------------------------
 */

if( !isset($content_width) ) $content_width = 960;