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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          'Y;O)UHxU]@Qge!kVJpCy?qD1sd;[7P7kfZ`<gb>+s^Be!ahty,P3[DbSu:TU/Vmi' );
define( 'SECURE_AUTH_KEY',   '>?Y`T -JvkYb]*F`.KZ@&%VDqHg-fS!b|[VA@J~`hzP*Fcg!c!=EHQI06Ep C/%0' );
define( 'LOGGED_IN_KEY',     'GvL6[VcRPv~~.zk`)4d8O(@m`)Lq;0hP@/LdG5|uG;ItUdeY%iI0o[C`D(c]ff@g' );
define( 'NONCE_KEY',         'rox~a#|$SoK406<&#r!Rz 7FpD L%4w4F3eVxUjH<j;@KF)<l=+oE WIx!?7_`d2' );
define( 'AUTH_SALT',         'MqZR>;3k-({WA?rp!YpY H2K!rZWQ8xQ3iG_reo>BO >)@Zl PxWlB$98XSK yG=' );
define( 'SECURE_AUTH_SALT',  'N:J=LMK]ke)X~,~[^X3p6M|M^wSP@{),:G+(U#m~`4%g$V+VnD0}SlG#Wis`pMK ' );
define( 'LOGGED_IN_SALT',    '9.dbf+aWujTVNe^B!>@(sOxVQo(jNrhZ=FFST>yDbe0XYo>cstg45h)PS{t%c+c!' );
define( 'NONCE_SALT',        'ZEV;?=qd cNVeT@ty1e&k;zoBp}esk4`j]oh-55Ve`x |V#2dy|sjWH)zk1jl`]@' );
define( 'WP_CACHE_KEY_SALT', 'guuk~_B!Qgeh{gE/o[|V1[{d:M<O+@l8{W8mdV~t4/:>v$L2)N v C.9*NKuSX7e' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
