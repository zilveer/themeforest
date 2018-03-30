<?php
/**
 * Your Inspiration Themes
 *
 * @package WordPress
 * @subpackage Your Inspiration Themes
 * @author Your Inspiration Themes Team <info@yithemes.com>
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

//define area
define( 'DS', DIRECTORY_SEPARATOR );
define( 'PS', PATH_SEPARATOR );
define( 'IS_YITH', true );

define( 'YIT_CORE_VERSION', '1.0.0');

define( 'YIT_MINIMUM_WP_VERSION', '3.2.0' );

define( 'YIT_THEME_PATH', dirname(dirname(__FILE__)) );
define( 'YIT_THEME_URL', get_template_directory_uri() );
define( 'YIT_CORE_PATH', YIT_THEME_PATH . '/core' );
define( 'YIT_CORE_URL', get_template_directory_uri() . '/core' );
define( 'YIT_CORE_ASSETS', YIT_CORE_PATH . '/assets' );
define( 'YIT_CORE_ASSETS_URL', YIT_CORE_URL . '/assets' );
define( 'YIT_CORE_LIB', YIT_THEME_PATH . '/core/lib' );
define( 'YIT_CORE_TEMPLATES_DIR',  YIT_CORE_PATH . '/templates' );
define( 'YIT_CORE_SLIDERS_DIR',  YIT_CORE_TEMPLATES_DIR . '/sliders' );
define( 'YIT_IMAGES',  get_template_directory() . '/images' );
define( 'YIT_IMAGES_URL',  get_template_directory_uri() . '/images' );

define( 'YIT_THEME_I18N_DIR', 	     YIT_THEME_PATH . '/languages' );
define( 'YIT_THEME_FUNC_DIR', 	     YIT_THEME_PATH . '/theme' );
define( 'YIT_THEME_CSS_DIR', 	     YIT_THEME_PATH . '/css' );
define( 'YIT_THEME_JS_DIR', 	     YIT_THEME_PATH . '/js' );
define( 'YIT_THEME_IMG_DIR', 	     YIT_THEME_PATH . '/images' );
define( 'YIT_THEME_TEMPLATES_DIR',   YIT_THEME_FUNC_DIR . '/templates' );
define( 'YIT_THEME_ASSETS_DIR', 	 YIT_THEME_FUNC_DIR . '/assets' );
define( 'YIT_THEME_PLUGINS_DIR',     YIT_THEME_FUNC_DIR . '/plugins' );
define( 'YIT_THEME_SLIDERS_DIR',     YIT_THEME_TEMPLATES_DIR . '/sliders' );

define( 'YIT_THEME_I18N_URL', 	    get_template_directory_uri() . '/languages' );
define( 'YIT_THEME_FUNC_URL', 	    get_template_directory_uri() . '/theme' );
define( 'YIT_THEME_CSS_URL', 	    get_template_directory_uri() . '/css' );
define( 'YIT_THEME_JS_URL', 	    get_template_directory_uri() . '/js' );
define( 'YIT_THEME_IMG_URL', 	    get_template_directory_uri() . '/images' );
define( 'YIT_THEME_TEMPLATES_URL',  YIT_THEME_FUNC_URL . '/templates' );
define( 'YIT_THEME_ASSETS_URL', 	YIT_THEME_FUNC_URL . '/assets' );
define( 'YIT_THEME_PLUGINS_URL',    YIT_THEME_FUNC_URL . '/plugins' );
define( 'YIT_THEME_SLIDERS_URL',    YIT_THEME_TEMPLATES_URL . '/sliders' );

$uploads = wp_upload_dir();
define( 'YIT_SITE_URL', site_url() );
define( 'YIT_WPCONTENT_DIR', $uploads['basedir'] );
define( 'YIT_WPCONTENT_URL', $uploads['baseurl'] );

if ( ! defined( 'YIT_CACHE_DIR' ) ) define( 'YIT_CACHE_DIR', get_stylesheet_directory() . '/cache' );
if ( ! defined( 'YIT_CACHE_URL' ) ) define( 'YIT_CACHE_URL', get_stylesheet_directory_uri() . '/cache' );

//Load functions files. Must be here because adds functions used by YIT
require_once YIT_CORE_PATH . '/functions-core.php';
require_once YIT_CORE_PATH . '/functions-template.php';

//Load core hooks
require_once YIT_CORE_PATH . '/hooks.php';

//include the main YIT class
if( file_exists( YIT_THEME_FUNC_DIR . '/Yit.php' ) ) {
	require_once( YIT_THEME_FUNC_DIR . '/Yit.php' );
} else {
	require_once( 'Yit.php' );
}

if( !defined( 'WPLANG' ) ) define( 'WPLANG', '' );

if( WPLANG != '' ) {
    load_theme_textdomain( 'yit', dirname( locate_template( 'languages/' . WPLANG . '.mo' ) ) );
} else {
    load_theme_textdomain( 'yit', get_template_directory() . '/languages' );
}

do_action('yit_init');
$yit = new YIT;
do_action('yit_loaded');

if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) do_action( 'yit_activated' );