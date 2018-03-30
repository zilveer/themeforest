<?php
/**
 * This file belongs to the YIT Framework.
 *
 * This source file is subject to the GNU GENERAL PUBLIC LICENSE (GPL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

/**
 * Constants definition
 *
 * @package Yithemes
 * @author Andrea Grillo <andrea.grillo@yithemes.com>
 * @since 1.0.0
 *
 */

/**
 * Check if we'are using use a YIT Theme
 */
!defined( 'YIT') && define( 'YIT', TRUE );

/**
 * Framework Version
 */
define( 'YIT_CORE_VERSION', '2.0.0-alpha' );

/**
 * Minimum supported WP Version
 */
define( 'YIT_MINIMUM_WP_VERSION', '3.5' );

/*========== ROOT SECTION ==========*/

/**
 * Root folder path
 */
define( 'YIT_PATH', get_template_directory() );

/**
 * Root folder url
 */
define('YIT_URL', get_template_directory_uri());

/**
 * Root folder url
 */
define('YIT_STYLESHEET_URL', get_stylesheet_directory_uri());

/**
 * Root languages folder path
 */
define( 'YIT_LANGUAGES_PATH', YIT_PATH . '/languages' );

/**
 * Root languages folder url
 */
define( 'YIT_LANGUAGES_URL', YIT_URL . '/languages' );

/**
 * Root css folder path
 */
define( 'YIT_CSS_PATH', YIT_PATH . '/css' );

/**
 * Root css folder url
 */
define( 'YIT_CSS_URL', YIT_URL . '/css' );

/**
 * Root js folder path
 */
define( 'YIT_JS_PATH', YIT_PATH . '/js' );

/**
 * Root js folder url
 */
define( 'YIT_JS_URL', YIT_URL . '/js' );

/**
 * Root images folder path
 */
define( 'YIT_IMAGES_PATH', YIT_PATH . '/images' );

/**
 * Root images folder url
 */
define( 'YIT_IMAGES_URL', YIT_URL . '/images' );

/*========== CORE SECTION ==========*/

/**
 * Core folder path
 */
define( 'YIT_CORE_PATH', YIT_PATH . '/core' );

/**
 * Core folder url
 */
define( 'YIT_CORE_URL', YIT_URL . '/core' );

/**
 * Core assets folder path
 */
define( 'YIT_CORE_ASSETS_PATH', YIT_CORE_PATH . '/assets' );

/**
 * Core assets folder url
 */
define( 'YIT_CORE_ASSETS_URL', YIT_CORE_URL . '/assets' );

/**
 * Core lib folder path
 */
define( 'YIT_CORE_LIB_PATH', YIT_CORE_PATH . '/lib' );

/**
 * Core lib folder url
 */
define( 'YIT_CORE_LIB_URL', YIT_CORE_URL . '/lib' );

/**
 * Core templates folder path
 */
define( 'YIT_CORE_TEMPLATES_PATH',  YIT_CORE_PATH . '/templates' );

/**
 * Core templates folder utl
 */
define( 'YIT_CORE_TEMPLATES_URL',  YIT_CORE_URL . '/templates' );

/**
 * Core widgets folder path
 */
define( 'YIT_CORE_YIT_WIDGETS_PATH',  YIT_CORE_PATH . '/yit/widgets' );

/**
 * Core walkers folder path
 */
define( 'YIT_CORE_YIT_WALKER_PATH',  YIT_CORE_PATH . '/yit/walkers' );

/*========== THEME SECTION ==========*/

/**
 * Theme folder path
 */
define( 'YIT_THEME_PATH', YIT_PATH . '/theme' );

/**
 * Theme folder url
 */
define( 'YIT_THEME_URL', YIT_URL . '/theme' );

/**
 * Theme templates folder path
 */
define( 'YIT_THEME_TEMPLATES_PATH', YIT_THEME_PATH . '/templates' );

/**
 * Theme templates folder url
 */
define( 'YIT_THEME_TEMPLATES_URL', YIT_THEME_URL . '/templates' );

/**
 * Theme assets folder path
 */
define( 'YIT_THEME_ASSETS_PATH', 	 YIT_THEME_PATH . '/assets' );

/**
 * Theme assets folder url
 */
define( 'YIT_THEME_ASSETS_URL', 	YIT_THEME_URL . '/assets' );

/**
 * Theme widgets folder url
 */
define( 'YIT_THEME_YIT_WIDGETS_PATH',  YIT_THEME_PATH . '/yit/widgets' );

/**
 * Theme plugins folder url
 */
define( 'YIT_THEME_PLUGINS_PATH', YIT_THEME_PATH . '/plugins' );

/**
 * Theme Sample Backgrouns
 */
define( 'YIT_CUSTOM_BACKGROUNDS', 'https://dl.dropbox.com/s/0nwtcg3p8pbb7np/backgrounds_v1.0.zip' );

/*========== WP SECTION ==========*/
$uploads = wp_upload_dir();
/**
 * Site url
 */
define( 'YIT_SITE_URL', site_url() );
/**
 * Upload dir
 */
define( 'YIT_WPCONTENT_DIR', $uploads['basedir'] );
/**
 * Upload url
 */
define( 'YIT_WPCONTENT_URL', $uploads['baseurl'] );
/**
 * Admin url
 */
define( 'YIT_WPADMIN_URL', YIT_SITE_URL . '/wp-admin' );
/**
 * FS_CHMOD_DIR: Fix for WP filesystem
 */
if( ! defined( 'FS_CHMOD_DIR' ) ){
    define( 'FS_CHMOD_DIR', ( 0755 & ~ umask() ) );
}
/**
 * FS_CHMOD_FILE: Fix for WP filesystem
 */
if( ! defined( 'FS_CHMOD_FILE' ) ){
    define( 'FS_CHMOD_FILE', ( 0644 & ~ umask() ) );
}

//include the main YIT class
require_once( 'yit/Yit.php' );
$GLOBALS['yit'] = new YIT();
