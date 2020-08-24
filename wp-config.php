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
define( 'DB_NAME', 'monalisha_db' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '>2;J~dT[%-{InO=cDVEik;Ai%RQ/hItK&Q?QvN~9QnkVv5CJ(dE@,4RRT,uf*uBa' );
define( 'SECURE_AUTH_KEY',  '1o,@~`Zg]2K#}c`pjvR[sJBWGG/e/_IW j>+ moa~w,oIVgrr}*_O@xuF_IFGh#+' );
define( 'LOGGED_IN_KEY',    'eW#l6ygF.6N-#`Ob@60L-RkyuPdz.f/2Zt?K`Wnv)WC$e=&NVH_E,g|p y1GT<p.' );
define( 'NONCE_KEY',        'lm_CDtyN>gM/iLjKR0oxT8dc,Y(tknM,;EMmodWfQhn9X0EqAcv i-xbPaG2Pv(j' );
define( 'AUTH_SALT',        'Qt(upI)7c.(%^&Q5ga@*!TW,d%0[$9-+e_,?eSu:6):8N*^9PdM65;iB_0h`1>.%' );
define( 'SECURE_AUTH_SALT', 'at`L(,?9wx}Wd(4WnGdr%v|%E~1zP~no2lhNd )S!o5PhlRAy<9+6/L%HPv4` Nu' );
define( 'LOGGED_IN_SALT',   'qdBW=2J?7dB#b_<_L:.~eJVgZ[]o|qr7184bM2MYesKn8KK2ge@8?^={t~{Ba49m' );
define( 'NONCE_SALT',       '[lX>DjK]3`&=EB3F!+N3BAN9{mPlvPtL<PNU2K,Mn3 (:RV3l8-0JgB}H,(<*q|l' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
