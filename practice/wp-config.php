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
define('DB_NAME', 'wp_practice');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'z~l1:T.{O-6QkzSWhi?3a*n$]T~:rpR#_v;wov;Hd&On#IS-w?mnNhTVm+gnHADk');
define('SECURE_AUTH_KEY',  '1GRKq0wMLflT #+j%)|`j~J_I&#^%g!aXyO!PS/Oi&m$,KoHP`ni:7w#4qaNTO3q');
define('LOGGED_IN_KEY',    '||/8y)#_/pV^C4|{H!Pv{}|561KG7n (kHhr)|q5vdz,(@BX]w;Hx&<J1k.Uk^Vw');
define('NONCE_KEY',        'VwD46L]Om]7_VcwE!}t$|SvsmnrotzHZYE bT!=vu&a??#=ld()6:-2}C| Y%ZP7');
define('AUTH_SALT',        '_[LI`&}*.`W+Za4FB+b`3>~ 8i9gB4&kU/+6>DF(Z8>HuIp)J/yxbeIgM$0Ll;>u');
define('SECURE_AUTH_SALT', '[0#vUFvG{}*QM}Ef^oJ:^&-:1Z-qNTyxn+E$H+w 0)dw(*6i< L0yz[9`TouDFhI');
define('LOGGED_IN_SALT',   'UfRIy1!U!aT|E%_dp7IOM4&U~6v?)bCvJ*qV<gkv84)<:$S3OtOtgA{qmA%]{k6i');
define('NONCE_SALT',       'xo6<)nhib|A fk+ n.v}ln0}r`S%xeWiiai!{yO_u|-yKxZBp~a+8{`ceK=nr@)h');

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
