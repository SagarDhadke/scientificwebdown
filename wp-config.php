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
define( 'DB_NAME', 'scientificweb_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         '5dP&?tH**4$N6vQMKTTLFg1b|#amuePGvXbPk@?*F }h?-k[J`8FP5X$zzH4.j^=' );
define( 'SECURE_AUTH_KEY',  '4INx6M4qvASNYtQbd2CYec7vOGC`YiB5oKi>EMuUaI-pACnvs@+E_uzb,.=M%k|T' );
define( 'LOGGED_IN_KEY',    'SSglanU%pw1M^NbH#6(x&HT#exrb2J9l/{d|k-cM>Qp@u>1c-mpXQUKTs!zM?Co)' );
define( 'NONCE_KEY',        ':-,!N7}5Z6o{|5FI8&?s7s&M2_{gFTX0>3OeT1j5#hKi>[A?weK[+-N&<d$l$+E3' );
define( 'AUTH_SALT',        ']&@= 6TB]H)&n8L;T!n6.Q>OdHG}2KlP$/dlF>+;=d_7|^$IF!dw:(#s-U!}9^O@' );
define( 'SECURE_AUTH_SALT', 'j0XNqE)XlK7g[2}l?p#*V|qe/f[|0CYwRlP<Q$.i[,D?7WuI}Z?)^C5n`Wd0Eaxr' );
define( 'LOGGED_IN_SALT',   'n[?yHcVb@h4Y0{_5{kVgE->=p}ybneoYTMN>@e72O>^<o@^d2*zt<!TMR@L)hc ;' );
define( 'NONCE_SALT',       ':N,dF`=~#5>Ltv}1a!,z.$N^z$g:n}rj]NUL[FijfBlkZXBa~dI-t2VYMm~>7fmn' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
