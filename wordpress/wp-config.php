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
define('DB_NAME', 'cdcol');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         'D;$L:+7KR;c570ZTDbl&=GXEzm7s[# }gIvituF]IHYl`?pwl}[@6{Pojo5%;xyR');
define('SECURE_AUTH_KEY',  'f+cR&A5;_~cImFhL+|G4S=#t79Bc?z^7Y]l3|j+>exvl-^UPw*.%Be_0,nRjL>Pe');
define('LOGGED_IN_KEY',    'aCbKSI/Kfki@RGRm;X>{7:qiRcszsKGwy3AbDOCqinP_OY@w+a6=7-y-_a_RzRd>');
define('NONCE_KEY',        '7o8MJL:TYx?tVD92*$C3T8LpfEt#yzB/%3t:A}?812s-km ,-fN8y.~[y.%@>!o>');
define('AUTH_SALT',        'gUpoLrjm-?Ic5p+A*0)p=9!-S3ezjSC^*%T&VSrFoRS:+.+,ODA0tCvI5IaD}J M');
define('SECURE_AUTH_SALT', 'B^q*bcer98Lur]2)xSG.=J=;-Zym^a5xNiprqn]oe~yZVzO:iooCw^4]p-tpT4FQ');
define('LOGGED_IN_SALT',   '%@q|wI*kvn+tQWbUT<HWp1Qm@wv?=.^fPoz.mwgD|-i~/@sE^a<y`;jbiV&DCdzq');
define('NONCE_SALT',       'e6ZA673[RTh+38eYTQJ!wt~m1FS=N Vn@7i0TsnP#4%c?r843oF&qsvc></B*v++');

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
define('FS_METHOD', 'ftpsockets');
define('FTP_BASE', '/opt/lampp/htdocs/wordpress');
define('FTP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'].'/wordpress');
define('FTP_PLUGIN_DIR ', $_SERVER['DOCUMENT_ROOT'].'/wordpress/wp-content/plugins');
define( 'FTP_USER', 'sanjeev-ftp' );
define( 'FTP_PASS', 'sanjeev103' );
define( 'FTP_HOST', 'localhost');
if(is_admin()) {
  add_filter('filesystem_method', create_function('$a', 'return "direct";' ));
   define( 'FS_CHMOD_DIR', 0777 );
}


