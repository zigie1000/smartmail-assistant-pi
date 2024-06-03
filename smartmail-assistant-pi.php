<?php
/**
 * Plugin Name: SmartMail Assistant Pi
 * Plugin URI: https://smartmail.store
 * Description: A Pi network plugin to manage SmartMail functionality.
 * Version: 1.0.0
 * Author: Marco Zagato
 * Author URI: https://smartmail.store
 * License: MIT
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin constants
define('SMARTMAIL_PI_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SMARTMAIL_PI_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once SMARTMAIL_PI_PLUGIN_PATH . 'src/pi-network-functions.php';
require_once SMARTMAIL_PI_PLUGIN_PATH . 'src/pi-sdk-integration.php';
require_once SMARTMAIL_PI_PLUGIN_PATH . 'src/pi-specific-functions.php';

// Activation hook
function smartmail_pi_activate() {
    // Activation code here
}
register_activation_hook(__FILE__, 'smartmail_pi_activate');

// Deactivation hook
function smartmail_pi_deactivate() {
    // Deactivation code here
}
register_deactivation_hook(__FILE__, 'smartmail_pi_deactivate');

// Admin menu
function smartmail_pi_admin_menu() {
    add_menu_page(
        'SmartMail Assistant Pi',
        'SmartMail Pi',
        'manage_options',
        'smartmail-pi',
        'smartmail_pi_admin_page',
        'dashicons-admin-generic',
        6
    );
}
add_action('admin_menu', 'smartmail_pi_admin_menu');

// Admin page content
function smartmail_pi_admin_page() {
    ?>
    <div class="wrap">
        <h1>SmartMail Assistant Pi</h1>
        <form method="post" action="options.php">
            <?php
            settings_fields('smartmail_pi_options_group');
            do_settings_sections('smartmail-pi');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function smartmail_pi_register_settings() {
    register_setting('smartmail_pi_options_group', 'smartmail_pi_option_name');
    add_settings_section('smartmail_pi_main_section', 'Main Settings', 'smartmail_pi_main_section_cb', 'smartmail-pi');
    add_settings_field('smartmail_pi_option_name', 'Option Name', 'smartmail_pi_option_name_cb', 'smartmail-pi', 'smartmail_pi_main_section');
}
add_action('admin_init', 'smartmail_pi_register_settings');

function smartmail_pi_main_section_cb() {
    echo '<p>Main description of this section here.</p>';
}

function smartmail_pi_option_name_cb() {
    $setting = get_option('smartmail_pi_option_name');
    echo "<input type='text' name='smartmail_pi_option_name' value='" . esc_attr($setting) . "'>";
}
