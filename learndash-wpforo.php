<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wbcomdesigns.com/plugins
 * @since             1.0.0
 * @package           Learndash_Wpforo
 *
 * @wordpress-plugin
 * Plugin Name:       Learndash wpForo
 * Plugin URI:        https://wbcomdesigns.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.6.0
 * Author:            wbcomdesigns
 * Author URI:        https://wbcomdesigns.com/plugins
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       learndash-wpforo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */

if ( ! defined( 'LEARNDASH_WPFORO_VERSION' ) ) {
	define( 'LEARNDASH_WPFORO_VERSION', '1.6.0' );
}
if ( ! defined( 'LEARNDASH_WPFORO_FILE' ) ) {
	define( 'LEARNDASH_WPFORO_FILE', __FILE__ );
}
if ( ! defined( 'LEARNDASH_WPFORO_BASENAME' ) ) {
	define( 'LEARNDASH_WPFORO_BASENAME', plugin_basename( __FILE__ ) );
}
if ( ! defined( 'LEARNDASH_WPFORO_URL' ) ) {
	define( 'LEARNDASH_WPFORO_URL', plugin_dir_url( __FILE__ ) );
}
if ( ! defined( 'LEARNDASH_WPFORO_DIR_PATH' ) ) {
	define( 'LEARNDASH_WPFORO_DIR_PATH', plugin_dir_path( __FILE__ ) );
}
if ( ! defined( 'LEARNDASH_WPFORO_PLUGIN_PATH' ) ) {
	define( 'LEARNDASH_WPFORO_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-learndash-wpforo-activator.php
 */
function activate_learndash_wpforo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-learndash-wpforo-activator.php';
	Learndash_Wpforo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-learndash-wpforo-deactivator.php
 */
function deactivate_learndash_wpforo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-learndash-wpforo-deactivator.php';
	Learndash_Wpforo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_learndash_wpforo' );
register_deactivation_hook( __FILE__, 'deactivate_learndash_wpforo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-learndash-wpforo.php';
require plugin_dir_path( __FILE__ ) . 'edd-license/edd-plugin-license.php';
/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_learndash_wpforo() {

	$plugin = new Learndash_Wpforo();
	$plugin->run();

}
run_learndash_wpforo();
