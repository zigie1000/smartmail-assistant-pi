<?php
// Admin settings for SmartMail Assistant Pi Plugin

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
