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

// We include composer directory after all base WP stuff loaded
require_once dirname(__FILE__) . '/html/vendor/autoload.php';

// We try to parse the .env file and put values to env
$env_file = realpath(__DIR__.DIRECTORY_SEPARATOR.'.env');

if (file_exists($env_file)) {
	$dotenv = Dotenv\Dotenv::createImmutable( dirname( $env_file ) );
	$dotenv->load();
}

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv( 'DB_NAME' ) );

/** MySQL database username */
define( 'DB_USER', getenv( 'DB_USER' ) );

/** MySQL database password */
define( 'DB_PASSWORD', getenv( 'DB_PASSWORD' ) );

/** MySQL hostname */
define( 'DB_HOST', getenv( 'DB_HOST' ) );
define( 'DB_PORT', getenv( 'DB_PORT' ) ?: '3306' );
define( 'DB_SOCKET', getenv( 'DB_SOCKET' ) ?: null );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', getenv( 'DB_CHARSET' ) ?: 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', getenv( 'DB_COLLATE' ) ?: 'utf8mb4_unicode_ci' );

define( 'DB_TABLE_PREFIX', getenv( 'DB_TABLE_PREFIX' ) ?: 'wp_' );
define( 'DB_STRICT_MODE', ! ! getenv( 'DB_STRICT_MODE' ) );
define( 'DB_ENGINE', getenv( 'DB_ENGINE' ) ?: null );

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = DB_TABLE_PREFIX;

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', getenv( 'AUTH_KEY' ) ?: hash( 'sha256', md5( php_uname( 'n' ).'1' ) ) );
define( 'SECURE_AUTH_KEY', getenv( 'SECURE_AUTH_KEY' ) ?: hash( 'sha256', md5( php_uname( 'n' ).'2' ) ) );
define( 'LOGGED_IN_KEY', getenv( 'LOGGED_IN_KEY' ) ?: hash( 'sha256', md5( php_uname( 'n' ).'3' ) ) );
define( 'NONCE_KEY', getenv( 'NONCE_KEY' ) ?: hash( 'sha256', md5( php_uname( 'n' ).'4' ) ) );
define( 'AUTH_SALT', getenv( 'AUTH_SALT' ) ?: hash( 'sha256', md5( php_uname( 'n' ).'5' ) ) );
define( 'SECURE_AUTH_SALT', getenv( 'SECURE_AUTH_SALT' ) ?: hash( 'sha256', md5( php_uname( 'n' ).'6' ) ) );
define( 'LOGGED_IN_SALT', getenv( 'LOGGED_IN_SALT' ) ?: hash( 'sha256', md5( php_uname( 'n' ).'7' ) ) );
define( 'NONCE_SALT', getenv( 'NONCE_SALT' ) ?: hash( 'sha256', md5( php_uname( 'n' ).'8' ) ) );
define( 'WP_CACHE_KEY_SALT', getenv( 'WP_CACHE_KEY_SALT' ) ?: hash( 'sha256', md5( php_uname( 'n' ).'9' ) ) );

/* That's all, stop editing! Happy blogging. */
define( 'WP_ENV', getenv( 'WP_ENV' ) ?: 'production' );

define( 'WP_DEBUG', getenv( 'WP_DEBUG' ) ? ! ! getenv( 'WP_DEBUG' ) : false );
define( 'WP_DEBUG_DISPLAY', getenv( 'WP_DEBUG_DISPLAY' ) ? ! ! getenv( 'WP_DEBUG_DISPLAY' ) : false );
// set to 'true' means the default debug.log file would be wp-content/debug.log
define( 'WP_DEBUG_LOG', (getenv( 'WP_DEBUG_LOG_PATH' ) ?: WP_CONTENT_DIR ) . DIRECTORY_SEPARATOR . 'debug.log');
define( 'SAVEQUERIES', ! ! getenv( 'SAVEQUERIES' ) );

define('ADMIN_COOKIE_PATH', getenv( 'ADMIN_COOKIE_PATH' ) ?: '/');
define('COOKIE_DOMAIN', getenv( 'COOKIE_DOMAIN' ) ?: '');
define('COOKIEPATH', getenv( 'COOKIEPATH' ) ?: '');
define('SITECOOKIEPATH', getenv( 'SITECOOKIEPATH' ) ?: '');

define( 'ALLOW_UNFILTERED_UPLOADS', getenv( 'ALLOW_UNFILTERED_UPLOADS' ) ?: false);

/* Multisite */
define( 'WP_ALLOW_MULTISITE', getenv( 'WP_ALLOW_MULTISITE' ) ? !! getenv( 'WP_ALLOW_MULTISITE' ) : false );
if (WP_ALLOW_MULTISITE) {
	define( 'MULTISITE', getenv( 'MULTISITE' ) ? !! getenv( 'MULTISITE' ) : true );
	define( 'SUBDOMAIN_INSTALL', getenv( 'SUBDOMAIN_INSTALL' ) ? !! getenv( 'SUBDOMAIN_INSTALL' ) : true );
	define( 'DOMAIN_CURRENT_SITE', getenv( 'DOMAIN_CURRENT_SITE' ) ?: 'network.tamara-demo.com' );
	define( 'PATH_CURRENT_SITE', getenv( 'PATH_CURRENT_SITE' ) ?: '/' );
	define( 'SITE_ID_CURRENT_SITE', getenv( 'SITE_ID_CURRENT_SITE' ) ?: 1 );
	define( 'BLOG_ID_CURRENT_SITE', getenv( 'BLOG_ID_CURRENT_SITE' ) ?: 1 );
}


// ## Below snippets are for installing plugins, themes from the Admin Dashboard
// define( 'FS_METHOD', 'direct' );
// define( 'FS_CHMOD_DIR', (0755 & ~ umask()) );
// define( 'FS_CHMOD_FILE', (0664 & ~ umask()) );

// For https
// If we're behind a proxy server and using HTTPS, we need to alert WordPress of that fact
// see also http://codex.wordpress.org/Administration_Over_SSL#Using_a_Reverse_Proxy
if ( isset( $_SERVER['HTTP_X_FORWARDED_PROTO'] ) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https' ) {
	$_SERVER['HTTPS'] = 'on';
}

define('WP_FORCE_HTTPS', getenv('WP_FORCE_HTTPS') ? !! getenv('WP_FORCE_HTTPS'): false);
define('WP_HTTPS_EXCLUDE_DOMAINS', getenv('WP_HTTPS_EXCLUDE_DOMAINS') ?: '');
if (!empty($_SERVER['HTTP_HOST']) && (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] !== 'on') && (WP_FORCE_HTTPS && strpos($_SERVER['HTTP_HOST'], WP_HTTPS_EXCLUDE_DOMAINS) === false)) {
	header('Location: https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], 301);
	exit;
}

if ( isset( $_SERVER['HTTP_HOST'] ) ) {
	$http_protocol = isset( $_SERVER['HTTPS'] ) && 'on' === $_SERVER['HTTPS'] ? 'https' : 'http';
	define( 'WP_HOME', $http_protocol . '://' . $_SERVER['HTTP_HOST'] );
	define( 'WP_SITEURL', $http_protocol . '://' . $_SERVER['HTTP_HOST'] );
}

// For WP_Application wp_app()
define( 'WP_APP_FORCE_CREATE_WP_APP_FOLDER', ! ! getenv( 'WP_APP_FORCE_CREATE_WP_APP_FOLDER' ) );

define( 'AUTOMATIC_UPDATER_DISABLED', ! ! getenv( 'AUTOMATIC_UPDATER_DISABLED' ) ?: true);
define( 'WP_AUTO_UPDATE_CORE', ! ! getenv( 'WP_AUTO_UPDATE_CORE' ) ?: false);

define( 'DISABLE_WP_CRON', ! ! getenv( 'DISABLE_WP_CRON' ) ?: true);
define( 'WP_CRON_LOCK_TIMEOUT', getenv( 'WP_CRON_LOCK_TIMEOUT' ) ?: 60 );

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	// For this installation, wp-config.php file is 1 level upper to `html` folder which is the WordPress directory
	define( 'ABSPATH', dirname( __FILE__ ) . DIRECTORY_SEPARATOR . 'html' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
