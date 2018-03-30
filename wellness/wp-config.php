<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
//define('WP_CACHE', true); //Added by WP-Cache Manager
define( 'WPCACHEHOME', '/home2/brataweb/public_html/themes/wellness20/wp-content/plugins/wp-super-cache/' ); //Added by WP-Cache Manager
define('MMAFF', 'hostgator' ); //Added by QuickInstall

define('DB_NAME', 'brataweb_wrdp2');

/** MySQL database username */
define('DB_USER', 'brataweb_wrdp2');

/** MySQL database password */
define('DB_PASSWORD', 'TeERumZwFZ5X4u');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');




/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'FD3HF*0JB^\`:M~D1w|>2mT59*_Np;1OJHX9hG!e$EW/n_jp*>fT;n-Na(qOtm>-XA0_xft\`BXS');
define('SECURE_AUTH_KEY',  '');
define('LOGGED_IN_KEY',    'aon)Vh4FZt<1Zptc@v=(\`!M#;G!H?Xo~K<$6tR=n7=>*!eI7w!668F0W7;_e(HVnIzC');
define('NONCE_KEY',        '|(BuraI2ztD5\`>e;DBr5nG)m3ZP5s0v(|inZbtq#ny\`o7s70Q0ov<hPmX_mbdezhI!?Z!l');
define('AUTH_SALT',        '0)A(YijM5894voD0bVB0)Fq9ZTuS4K?QvFhR@Jztcc=^_7N#2zDhf8uhyx30fS)e~P;*Y');
define('SECURE_AUTH_SALT', 's/cv<D)XxHwFIOxge$WpG(oF<Y7YmV)XB4>;0?bi\`i4Fl:u8OLXx5zX#-r>s-g(T@');
define('LOGGED_IN_SALT',   '0VGwHC2YuX=*LCz(;^6nNHPdV:hRz!kpkxm\`_3(3*HtR6??|A$i|wyKajf\`M(*5ZX$WuQz$R');
define('NONCE_SALT',       'FgPAQt<g=s-90CBswn1ld7KP~*T;8SJ-9BDnDHrIgK2Tw/v6se1bV6xV7Oii>A#Y_7oRYszgGupJ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', 'es');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
