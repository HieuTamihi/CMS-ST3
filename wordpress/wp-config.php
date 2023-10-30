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
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

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
define( 'AUTH_KEY',         'XW#tu-&g@+z5nM}XwM6`?Jxh!?_je(wv4D^}3nRN5?8=&rYvt2SR_^MzyZlJac.{' );
define( 'SECURE_AUTH_KEY',  '%D~Kr[febUsUQ{;Ls5O;Q#uRU0)`3s(d)`2N0ZNUlF5YkUc5gk|VmnDNn&89%c(9' );
define( 'LOGGED_IN_KEY',    'hzT(8oxH-}]Jm(Xa?dq1 d5oZ$=oS^Y0uF)Ns<n0XoVy2<5.AqP){BTa{YSxn[z!' );
define( 'NONCE_KEY',        ':!6?X*T?~m[+2NWWW4WjQ?> u-:qO/at;U#Qvhf+ty6#BbyEkEhs3>K<l,y 7b+e' );
define( 'AUTH_SALT',        '3!WHF+`==i=[](^dVeUQ&Rlg (e$elE_.3r9dxG>@=vhPg<|XnAR1a=>:`n<%G^g' );
define( 'SECURE_AUTH_SALT', '9o0~GTfkdl6ZsfO]b8OhfmLaDFG)&UK`Mv(ZJE4Iol!jconuEB~Mo=O7a=Z%]}y]' );
define( 'LOGGED_IN_SALT',   '*C)I:H)Nt>O[5/WOZgX,GNa0VJQE_2Wnn>oEH7drU]4~`e{tk%V:W}@2];dU!]}V' );
define( 'NONCE_SALT',       'bg5a%jdtsg,dX<BY684Ce0(Bv vlx[HB7w^>NIr&{xyOb^i>B.=v22+(8<RMVO:$' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_wordpress';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
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
