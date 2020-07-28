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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'admin' );

/** MySQL database password */
define( 'DB_PASSWORD', 'kominfo' );

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
define( 'AUTH_KEY',         'mLO+L0_5Hwiu%%XVpz7mYKgM:;;N[hfS7]`G7z;T1F7>SR6XLjmI#{<i4Sot~XWs' );
define( 'SECURE_AUTH_KEY',  'OusD00XTk.s`JZ<jws.4 ql7-],fH!nVQS!{cC!-JjPz==AApg:2p+Kx@*gG4Nn&' );
define( 'LOGGED_IN_KEY',    '?mvK@d3VH n*1J35?M2C0T+*K%EJ?dY*$j_0t$Ic[-2`B(U],Z|:QaraUOViHrx+' );
define( 'NONCE_KEY',        '2qT,Ydlxp!8 (Y9G*wR44 T$ZJq;iIA`<-zW0$/_Yq6Fk&bBI_?:.U%&PzzR[ANT' );
define( 'AUTH_SALT',        '6obV3jy<qJHjU8},Dh_>{} iC}as;*Yz;a7}-S){`3xvgnrz)5?^2N!UujFC_j3o' );
define( 'SECURE_AUTH_SALT', '8CW)@x2[8s:.G;%WZ_99i0aod0d;0!dX.?7TRX#?YM+/D@MVC4%f!_-X/!nKqli-' );
define( 'LOGGED_IN_SALT',   '{`FP49)Lpw ?#q8CcZF(#)aNI`{;?s**?tW:/j:vnAS8= ar(KSdpo?$HKACba1y' );
define( 'NONCE_SALT',       'JLx/WLti<J+xy^cd{ze95~oF`?j[.]SCM[jO${U`kmhM;Cbm-LAkUW$ff$=i5Ia~' );

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

