<?php
/**
 * Include all 
 * 
 * @package WordPress
 * @subpackage Kassyopea
 */     

define( 'YIW_SHORTCODES_DIR', dirname(__FILE__) . '/default-shortcodes/' );

// additional widgets
include_once YIW_THEME_FUNC_DIR . 'shortcodes.php';

// widgets
include_once YIW_SHORTCODES_DIR . 'widgets.php';

// content
include_once YIW_SHORTCODES_DIR . 'content.php'; 

// formatting
include_once YIW_SHORTCODES_DIR . 'formatting.php';  

// media
include_once YIW_SHORTCODES_DIR . 'media.php';

?>