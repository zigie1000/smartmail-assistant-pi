<?php
// Add admin settings page
function smartmail_pi_admin_settings() {
    add_options_page(
        'SmartMail Assistant Pi Settings',
        'SmartMail Assistant Pi',
        'manage_options',
        'smartmail-pi',
        'smartmail_pi_admin_settings_page'
    );
}
add_action('admin_menu', 'smartmail_pi_admin_settings');

// Admin settings page content
function smartmail_pi_admin_settings_page() {
    echo '<div class="wrap">';
    echo '<h1>SmartMail Assistant Pi Settings</h1>';
    echo '<form method="post" action="options.php">';
    settings_fields('smartmail_pi_options_group');
    do_settings_sections('smartmail-pi');
    submit_button();
    echo '</form>';
    echo '</div>';
}

// Register and define the settings
function smartmail_pi_register_settings() {
    register_setting('smartmail_pi_options_group', 'smartmail_pi_options');
    add_settings_section('smartmail_pi_main_section', 'Main Settings', 'smartmail_pi_section_callback', 'smartmail-pi');
    add_settings_field('smartmail_pi_field', 'API Key', 'smartmail_pi_field_callback', 'smartmail-pi', 'smartmail_pi_main_section');
}
add_action('admin_init', 'smartmail_pi_register_settings');

// Section callback
function smartmail_pi_section_callback() {
    echo 'Enter your SmartMail Pi settings below:';
}

// Field callback
function smartmail_pi_field_callback() {
    $options = get_option('smartmail_pi_options');
    echo '<input type="text" name="smartmail_pi_options[api_key]" value="' . esc_attr($options['api_key']) . '">';
}
?>
