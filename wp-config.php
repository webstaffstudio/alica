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
define( 'DB_NAME', 'alica' );

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
define( 'AUTH_KEY',         'xTI/v8&2&x7wFHc}1,fkh$~8k$Q^b|OB(.nly+z;GF(lB+XWSE-WcLmr,eLBY< 2' );
define( 'SECURE_AUTH_KEY',  'FXbxJ`[B2}!y(2xld:A}/u#X7rhWWC<%e$Lbb0YD|d[gUWTA;c9xI7ww`m>0H* l' );
define( 'LOGGED_IN_KEY',    'RH;W76YvXmjZyTmIA~D5wy:c&<}d|`[N#NJ0mS5U?7%&xC)q4 vEq](^#FEV?*<<' );
define( 'NONCE_KEY',        'B:wwZ#&wf@&uA.Rq-j7px,j?0_0n@$w+*wMsFG;BtTu}qz9~QSbrR$%hp}gCbsm|' );
define( 'AUTH_SALT',        'zrL+_3!e!q@~{15(L-b8K@yQ-(@o%]A=v||Hd7 Jl8g8u7! xBqv;B,!K/Jc1nx9' );
define( 'SECURE_AUTH_SALT', 'UM45VI,e_%[O1|ixerFE(V5aMU1U3/O%<}v5KKpsC;aa:ws $n1u6qr,wr#:OmN&' );
define( 'LOGGED_IN_SALT',   'E8,LgG%>KBz*1WBinCc/SZia9Y3wLXk(SwT%*X!d|Sj_IY9SX{V)C1~n78%0,XC;' );
define( 'NONCE_SALT',       '$F7dd2Lg/3fQ>Llyiu(wlynO)VcUgn5*l.tw*VM84RJjk@5dOh-#SJz&Q!Q>yx$&' );

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
