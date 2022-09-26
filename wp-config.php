<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'soda-db' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost:8889' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'PzxE=e2^-;HI7O!7:-fv,afn~oA22&|+]^?(v4&m;M*`W|vV0lfr;O+XLTEW?njc' );
define( 'SECURE_AUTH_KEY',  'GFselPSkZzMQYuRJJqGP~ZzBr&V{,^oJHgJmg;Rs;34pEpn:Yv{OCiRNS1i<tW*I' );
define( 'LOGGED_IN_KEY',    'X{N*X`BO<1U ,O/sRyMo9aIe D(~G*u59Vp:d/A5<?)-k*7iE?sN+W~N*48ezwR~' );
define( 'NONCE_KEY',        '{A8t&P4hN*6|DI30SG|d/(@J$!9|AD##I2x8cUV]0d|Xa3ArWSl0EwW%^O^{ x|O' );
define( 'AUTH_SALT',        'pAx]lm0Z>_ :2Z<dwD)g1wNFbI{zD?H)G1tC0bp_=|,5Wnv=19s^b vlI)Cen&kB' );
define( 'SECURE_AUTH_SALT', 'cj!hA#3 P4,-{thJ-H*YkF(lTFoYdV3J1h<~{GP$D|${9M8N:B2@LUfX;],5- ~8' );
define( 'LOGGED_IN_SALT',   'teI<4F[qqmrMnn_OUs:G?]lxB!IwqkLYqC,J1nVkt!aFmhTK]+d|b{:|usnTA6D`' );
define( 'NONCE_SALT',       'I|BOOHbg$wa5vP{ec%]W*qJ2``a)uxX(;RZ+2?@I)2Lc:,uc@FR~p*w,K%Fq]Tg:' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'g9_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
