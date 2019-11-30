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
define('DB_NAME', 'raiydhalha');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

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
define('AUTH_KEY',         '?#OuUlNmS}^PuLzul.Vt h~jP>*@r[2C.zWG#{8}uIrbRJrEX1a: n4L#K]k8B<u');
define('SECURE_AUTH_KEY',  'h8=zkA}HBJ%u-yVEy$A=O:O,y9l$j2<7)uXISP.,<ej0SqF0P((PzHb0tda}eD_}');
define('LOGGED_IN_KEY',    '?I}oEoIw,u+)LAl9 w9Nr_9yDjjQU,e8W66ox :lUcqg qmBW;^*}v!>?sK!3z3 ');
define('NONCE_KEY',        'LX<H6y>lj]*7.DqG]mDE(%yku2-xOKJR,3-O.Vx7L?=En{2lhfhWif)3,o9paCjE');
define('AUTH_SALT',        'i[&SMTh0U%#1@cDnF|[H9O7{.okhttoe93fC:$JhmN&J=SC[>3dGp|OC_// plW3');
define('SECURE_AUTH_SALT', ']1J?VohOG.G>niJ7t6r1hm;RqjztkcA0}0B:jww!~BWP|;9y@Ua%HU-_dzsi+Lr=');
define('LOGGED_IN_SALT',   'qi#(w[`5B/a62N!*(~l0xgmn,K>.,Bqf2IoDtv~S`47TimrOiG?aPilJmF7WisV ');
define('NONCE_SALT',       '?q[c1m0$??nW=Z`nOqVn~1Tx_9R4JNZ0#Yms|{4Dxs.t$fq}No}{./T^[BjOsDrx');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
