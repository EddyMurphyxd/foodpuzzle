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

define('WP_DEBUG', true);

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'foodpuzzle');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

define('FS_METHOD', 'direct');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '<pzFs2q*+jwpQ1zfrkuXT|`0,og?9KXCf(4ek9:.)>b*spvh6+D/c-&Dm~xo_XIf');
define('SECURE_AUTH_KEY',  ';6##]xdp:B*flA+Py-rRjAZl@F_i4:w+]pD$R@<k/DX`oJnZFtTnl;{V-xfYnA@b');
define('LOGGED_IN_KEY',    '98A?1UgMG_fHX-NyG]OW>.iV+ XR 69W;?%K=wD[!}|$HzP|7[z;-%sZjSjdE 5/');
define('NONCE_KEY',        'b34Pa<;<PyR~s}+1N`.<N>pi5ji,0:`,h6<e{~9>[^u+m[=n~Tu1E:!4W-Ax]-}A');
define('AUTH_SALT',        'oU*{b/-OjQgbbltL%~_GVv-o1`&?uM5tmrLu-vbq-sA<4!%~6TQ(@qL)-Cgu]pH)');
define('SECURE_AUTH_SALT', 'DYn`0nq$|DwNPEK+#2ZNHEpU>sr3|6+8S/tW]A5J ,vbhZ_0B%On%C-x2>Q!DJog');
define('LOGGED_IN_SALT',   'nN,1+S=|i8KO9w{-Trn5;rPMa-9]/M{7*Zhw=Bf8_Wp/LZAJ$E-fVsUi%{Beq6eP');
define('NONCE_SALT',       'h&^7f+eO_hDcH=TQq<vQH`::V^Uk@xpRZIA15y+Gn=#b^;q4@:ng/`TZqQnJVtl)');

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
