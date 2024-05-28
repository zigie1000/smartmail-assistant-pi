// Register custom page template
function pi_sma_register_template($templates) {
    $templates['templates/pi-smartmail-page.php'] = 'Pi SmartMail Page';
    return $templates;
}
add_filter('theme_page_templates', 'pi_sma_register_template');

function pi_sma_load_template($template) {
    if (get_page_template_slug() == 'templates/pi-smartmail-page.php') {
        $template = plugin_dir_path(__FILE__) . 'templates/pi-smartmail-page.php';
    }
    return $template;
}
add_filter('template_include', 'pi_sma_load_template');

// Handle Pi Payment AJAX request
function handle_pi_payment() {
    $amount = $_POST['amount'];
    $pi_functions = new PiSpecificFunctions();
    $result = $pi_functions->processPayment('order_id_placeholder', $amount, 'USD', array());
    if ($result) {
        echo 'Payment successful. Transaction ID: ' . $result;
    } else {
        echo 'Payment failed. Please try again.';
    }
    wp_die();
}
add_action('wp_ajax_pi_payment', 'handle_pi_payment');
add_action('wp_ajax_nopriv_pi_payment', 'handle_pi_payment');
