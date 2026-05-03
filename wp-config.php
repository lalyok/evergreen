<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('WP_CACHE', true);
define( 'WPCACHEHOME', '/Applications/XAMPP/xamppfiles/htdocs/evergreen/wp-content/plugins/wp-super-cache/' );
define( 'DB_NAME', 'evergreen' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'ilyas-macbook-air-2.local' );

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
define( 'AUTH_KEY',         '%1.%=dR4+vQ|x(8N8V0RLE/qWX:.|2%>ZyP$`dj!HR[e~Y96hy. *:i{>Yj`{qIP' );
define( 'SECURE_AUTH_KEY',  '3>sN&M/!<ECRleyHyWasfmw_Rk|2Z(g,m *]QB9#FF([g1Mm+>uvugZQ&,4l+Sfq' );
define( 'LOGGED_IN_KEY',    '9sfP_!gyFh1|tcp5P.{`Q:PXpgMq;*]ZCX1geFLBR/&a9nRb~oEN:OtBI+jZip J' );
define( 'NONCE_KEY',        'HP<f-jGv[!(6uAreoR# iHpE=;^K^[&1j.aF-@L4mCY{H(aJYM_43c~Y0]O<q{cC' );
define( 'AUTH_SALT',        '>r>Xr!RCA;sHArQO0[oon>D!![=R{ro3@6<v4K0X{^g?3CJJkv-&QRAXUA#N0`#[' );
define( 'SECURE_AUTH_SALT', 'v1yBwMTZdES/0)XfEo GsW?2&_nt`9(tBwI9*eI;SvJ0ff/1mcZ]sLYt<UCo!:Zx' );
define( 'LOGGED_IN_SALT',   'yvF{lW=r/]VA5>Sbdx=c_mInheaL#`nb88?mZM@fxlWO@mB^ F&(@jl`K<zMiL%B' );
define( 'NONCE_SALT',       'v!{}//u8Y-9=)Ro{^9:Xf+mWHz}f}Q]EWB:f]imnJB+G{g%}O<[jH [;*1x^8@sg' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', false);
// define('WP_DEBUG_LOG', true);
// define('WP_DEBUG_DISPLAY', false);
// @ini_set('display_errors', 0);

// define('FS_METHOD', 'direct');

/* Add any custom values between this line and the "stop editing" line. */

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
