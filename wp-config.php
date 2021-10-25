<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'plandeempleodb');

/** MySQL database username */
define('DB_USER', 'planempleo');

/** MySQL database password */
define('DB_PASSWORD', 'pl4n3mpl30DB*');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'l.Ioa9gZTO];E@|c+FP4;Zo.-<$,A^efw+`M*M]#lLSWkxQ19Rz.[PxOw$k*CBN#');
define('SECURE_AUTH_KEY',  'b`hL~584;Z1u~&N!P+-}^M[<IIJX}er,>wz#$ml]X^Kf!!ltygQ(lEAqNT?S+SSL');
define('LOGGED_IN_KEY',    '7pm4]M!5ac]H5FW++euvyY?a4bp!j<+W<6%9KY8<5R0d^Zi@i}F)QUd|-Q^kL$W7');
define('NONCE_KEY',        '!~A8tS|APiJq7Ak~HImGL~sFC1L-5wu#a@9Y*_Lk;q=_}T!+T*(lQ?la{8MH).`4');
define('AUTH_SALT',        '@;1m>gMw^hMOuVGC?l/GF|P2UWqZ+viNvM/6>wxLHdwjS.iMl;CR,*#|Q]<A9;Gr');
define('SECURE_AUTH_SALT', '5N= $8A+GZ`f(j8eQ*b>Ylj#2vCs.TTMb9G9Bl0Grhlvy.eV/Dx<Int5np|O{D}b');
define('LOGGED_IN_SALT',   'nvyOe:(?N#PFkPsWyS#G~-N=Fs/u-lu4/a1xL(!GwjY>0z{8L/p_S5@/.3*=J1>`');
define('NONCE_SALT',       'c0oS#L5^HfyuJBw_r{5r|`^pK~XpFhT]z!d6/m[ DRd_rb4LbtqtJFU3Q[sKd|ME');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'pgd3_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
