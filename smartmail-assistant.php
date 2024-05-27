<?php
/*
Plugin Name: SmartMail Assistant
Description: An AI-powered email assistant plugin for WordPress.
Version: 1.0
Author: Your Name
*/

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Include necessary files
require_once plugin_dir_path(__FILE__) . 'includes/admin-settings.php';
require_once plugin_dir_path(__FILE__) . 'includes/shortcodes.php';
require_once plugin_dir_path(__FILE__) . 'includes/api-functions.php';

// Activation and deactivation hooks
register_activation_hook(__FILE__, 'sma_activate');
register_deactivation_hook(__FILE__, 'sma_deactivate');

function sma_activate() {
    // Set default options
    update_option('sma_free_features', array('email_categorization', 'priority_inbox'));
    update_option('sma_pro_features', array('auto_responses', 'email_summarization', 'meeting_scheduler', 'follow_up_reminders', 'sentiment_analysis', 'email_templates'));
}

function sma_deactivate() {
    // Cleanup options
    delete_option('sma_free_features');
    delete_option('sma_pro_features');
}

// Load scripts and styles
function sma_enqueue_scripts() {
    wp_enqueue_style('sma-styles', plugin_dir_url(__FILE__) . 'assets/css/style.css');
    wp_enqueue_script('sma-scripts', plugin_dir_url(__FILE__) . 'assets/js/script.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'sma_enqueue_scripts');