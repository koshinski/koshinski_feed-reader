<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.koshinski.de/
 * @since             1.0.0
 * @package           Koshinski_feed-reader
 *
 * @wordpress-plugin
 * Plugin Name:       Kleinwerkstatt - Feed Reader
 * Plugin URI:        https://www.koshinski.de/
 * Description:       Liest die aktuellen Nachrichten von koshinski aus.
 * Version:           1.0.1
 * Author:            koshinski
 * Author URI:        https://www.koshinski.de/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       koshinski
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 */
function activate_koshinski_feed_reader() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-koshinski-feed-reader-activator.php';
	Koshinski_feed_reader_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_koshinski_feed_reader() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-koshinski-feed-reader-deactivator.php';
	Koshinski_feed_reader_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_koshinski_feed_reader' );
register_deactivation_hook( __FILE__, 'deactivate_koshinski_feed_reader' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-koshinski-feed-reader.php';


/**
 * Plugin Update Möglichkeit via Github
 */
if( ! class_exists( 'Smashing_Updater' ) ){
	include_once( plugin_dir_path( __FILE__ ) . 'updater.php' );
}
$updater = new Smashing_Updater( __FILE__ );
$updater->set_username( 'koshinski' );
$updater->set_repository( 'koshinski_feed-reader' );
/* $updater->authorize( 'abc' ); // Your auth code goes here for private repos */
$updater->initialize();



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_koshinski_feed_reader() {

	$plugin = new Koshinski_feed_reader();
	$plugin->run();

}
run_koshinski_feed_reader();


