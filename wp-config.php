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
define( 'DB_NAME', 'survery_plug' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'h|xru!D%Paj6yR!]_F@8x#qOa|_z7[H@Nmg$EMd_.r:Jx9oN{%zqSer+*eYMfw^S' );
define( 'SECURE_AUTH_KEY',  'UeMTrcb4a=OQ1 /a~y}_ODW)@G$?mX6NlKVsw>#R.m FEFWCBh|G4(kPuJw64G~.' );
define( 'LOGGED_IN_KEY',    '4-A=zS`Fwq_BDzV7rGTS>bFJaq_M=qX|$||L~5`f6$P]%O.>[<NoQidd:8](Re$u' );
define( 'NONCE_KEY',        'Kv/$KSZkdhI[xu[O<&30[|<)BouDocB1*.u=X#-Ait*D!OmFNi=0.rG=rY=F#30`' );
define( 'AUTH_SALT',        'F){oi|XRum ie;4wu}xzOHmpv)fVa(bOv_(s1zm`BSYFAEI`>+NkHbFmDQ,)/ ^1' );
define( 'SECURE_AUTH_SALT', 'FRhyTKG<9^xau3?k{Ov%}e9&4/gr`jUACGRPG>j7~>l||4OyIByv{Y~Hk.i@*]9i' );
define( 'LOGGED_IN_SALT',   '^JMkcYW{b2ZwdToU3=x6.t;M=bgIc@Ic$?{e8y@D+K/Kxl,p}Q[U)a|M0IVVIdV]' );
define( 'NONCE_SALT',       '.CcE7QH&f4=^TccSxWk.b_;ue{$m+}0q<*(1TSRNl|)C+?!Jio~5)q?MYK#-s;1f' );

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
define( 'WP_DEBUG', true );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
