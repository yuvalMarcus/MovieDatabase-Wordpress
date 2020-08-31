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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'moviedatabasewordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'ijn124ttyy' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'wCb@W7bzsA>+`LsMDE@gxu$|/m,4aLJp?S tnU;IB1;=hAf[h?O.u]fFpkCE, TB' );
define( 'SECURE_AUTH_KEY',  ':L&d<K@74Ea8?PLKTq~1/i!5O_Gh=)xgvjPa>ZXVp}d`1vq 79f0%Qaxh%1r*4<q' );
define( 'LOGGED_IN_KEY',    ')@RqJlC~`5[(vIU1bXZQ[JnR/6ueDkwbkgGd!4r3[PB5ffpOiUZC{Ul6NDCbsPP2' );
define( 'NONCE_KEY',        'AB`fM<5?x<cLD%BFH]s)&4x}cB+xKGf9J@:lC`ZwppRq][c$V3#>4t}=+msw^rc8' );
define( 'AUTH_SALT',        'i nNqDeZq;A]2e:.I0OPP_G671fx_xYQ?2E_Gk!!j+*xWT$<beT_4GrQN%+8N9{U' );
define( 'SECURE_AUTH_SALT', 'Cl^tR5V.`OTPd.bkQv}Rw$@&$2Vj:(|WyYzB*b56>}eN`-(ok!6S.QGC^==e ;ez' );
define( 'LOGGED_IN_SALT',   'saV1fe8ww_+H2+T;XT=Q@W3l7MdagG+!(nq$cdT|GbsCe1}gU*ie;fcjv|q}iw;.' );
define( 'NONCE_SALT',       'msW{>/m<9[{9D*Mr !)C>l6VV^iWqKe:7tePa~k7MhZq&4-Epd2_4j?[$9U7?_jl' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mw_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
