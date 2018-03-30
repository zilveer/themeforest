<?php
/**
 * Exposure functions and definitions.
 *
 * @package WordPress
 * @subpackage Exposure
 * @since Exposure 1.0
 */

/**
 * Framework and configuration.
 * PLEASE LEAVE THIS AREA UNTOUCHED, IN ORDER NOT TO BREAK CORE FUNCTIONALITY.
 * -----------------------------------------------------------------------------
 */
if( !defined('THB_THEME_KEY') ) define( 'THB_THEME_KEY', 'exposure' );

include 'framework/boot.php';
include 'config/config.php';

/**
 * You can start adding your custom functions from here!
 * -----------------------------------------------------------------------------
 */

if( !isset($content_width) ) $content_width = 960;