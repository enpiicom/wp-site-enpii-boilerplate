<?php
/**
 * Plugin Name: Demoda
 * Plugin URI:  https://enpii.com/
 * Description: Demo plugin to use Enpii Base for development
 * Author:      dev@enpii.com, nptrac@yahoo.com
 * Author URI:  https://enpii.com/
 * Version:     1.0.0
 * Text Domain: enpii
 */

use Enpii\Demoda\App\WP\Demoda_WP_Plugin;

// Update these constants whenever you bump the version
defined( 'DEMODA_PLUGIN_VERSION' ) || define( 'DEMODA_PLUGIN_VERSION', '1.0.0' );

// We set the slug for the plugin here.
// This slug will be used to identify the plugin instance from the WP_Application container
defined( 'DEMODA_PLUGIN_SLUG' ) || define( 'DEMODA_PLUGIN_SLUG', 'demoda' );

// We include composer autoload here
if ( ! class_exists( Demoda_WP_Plugin::class ) ) {
	require_once __DIR__ . DIR_SEP . 'vendor' . DIR_SEP . 'autoload.php';
}

// We register this plugin as a Service Provider
wp_app()->register_plugin(
	Demoda_WP_Plugin::class,
	DEMODA_PLUGIN_SLUG,
	__DIR__,
	plugin_dir_url( __FILE__ )
);
