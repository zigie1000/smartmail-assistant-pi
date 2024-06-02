<?php
/**
 * Plugin Name: SmartMail Assistant Pi
 * Plugin URI: https://example.com/
 * Description: PI version of SmartMail Assistant for managing PI integrations.
 * Version: 1.0.0
 * Author: Marco Zagato
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define plugin constants
define('SMARTMAIL_PI_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('SMARTMAIL_PI_PLUGIN_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once SMARTMAIL_PI_PLUGIN_PATH . 'includes/admin-settings.php';
require_once SMARTMAIL_PI_PLUGIN_PATH . 'includes/api-functions.php';

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
        90
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
            settings_fields('smartmail_pi_settings');
            do_settings_sections('smartmail-pi');
            submit_button();
            ?>
        </form>
    </div>
    <?php
}

// Register settings
function smartmail_pi_register_settings() {
    register_setting('smartmail_pi_settings', 'smartmail_pi_api_key');
    add_settings_section('smartmail_pi_section', 'API Settings', null, 'smartmail-pi');
    add_settings_field('smartmail_pi_api_key', 'API Key', 'smartmail_pi_api_key_callback', 'smartmail-pi', 'smartmail_pi_section');
}
add_action('admin_init', 'smartmail_pi_register_settings');

// API Key field callback
function smartmail_pi_api_key_callback() {
    $api_key = get_option('smartmail_pi_api_key');
    echo '<input type="text" name="smartmail_pi_api_key" value="' . esc_attr($api_key) . '" class="regular-text">';
}
?>
