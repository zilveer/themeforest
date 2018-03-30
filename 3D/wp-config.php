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
define('DB_NAME', 'iamilkay_imtheme');

/** MySQL database username */
define('DB_USER', 'iamilkay_imtheme');

/** MySQL database password */
define('DB_PASSWORD', 'Pascal5447');

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
define('AUTH_KEY',         'Qx(:!PHv[n oNAn6g[_+_xJ%MQ`dn4SA;4V~Lyv&3^Jo[YS-?qd [MnylT,d)FXR');
define('SECURE_AUTH_KEY',  'G^*KZqK6&8lDT^Awmovb7QS%_ FJXVF&gpXiy%2UZ-CZ1x 56lsa/-<En#!S&r})');
define('LOGGED_IN_KEY',    'ck$idE+e5*5vgdSFq)e||O8U@+[spD;D;[mlObh$a:kZhWH+j=T+!xwnVzLP|qVg');
define('NONCE_KEY',        ']%G%y_Pq8JE{pD>Un9j)Pd*Bg?eFbo(UWHhQT%Pp;6}+Lg}[r`c`B(~qZ_+F(3]5');
define('AUTH_SALT',        'Jd{n|l|<XqTOlzs-E;|-/)j|Eg|<<a4*3AK]io*p4+1P:OsK4`4M^8H~k}:uszfo');
define('SECURE_AUTH_SALT', '`}Fq=}MF54HyNDODio7a(@]WX.^D`vf+z+E-S2e?^JxLzWm+|_H,CXLibRA/;f+!');
define('LOGGED_IN_SALT',   'C^Ca@6EO.cA|grm2{6-r0V|LHfrA5e_F*NG]:lQx`O_&Me,|qurd(OlM~0[dO2}x');
define('NONCE_SALT',       'E3bJC8nfgj-$+bdNW*g`~<#4a{;I0g,|898ssqICFG LP8!3HxeS}g1_-Y|Gw<FZ');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_idea3d_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
