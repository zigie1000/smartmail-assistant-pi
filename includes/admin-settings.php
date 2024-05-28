<?php

function pi_sma_register_settings() {
    add_option('pi_sma_email_server_incoming', '');
    add_option('pi_sma_email_server_outgoing', '');
    add_option('pi_sma_email_username', '');
    add_option('pi_sma_email_password', '');
    register_setting('pi_sma_options_group', 'pi_sma_email_server_incoming', 'sanitize_text_field');
    register_setting('pi_sma_options_group', 'pi_sma_email_server_outgoing', 'sanitize_text_field');
    register_setting('pi_sma_options_group', 'pi_sma_email_username', 'sanitize_text_field');
    register_setting('pi_sma_options_group', 'pi_sma_email_password', 'sanitize_text_field');
}
add_action('admin_init', 'pi_sma_register_settings');

function pi_sma_register_options_page() {
    add_options_page('SmartMail Pi Settings', 'SmartMail Pi', 'manage_options', 'pi_sma', 'pi_sma_options_page');
}
add_action('admin_menu', 'pi_sma_register_options_page');

function pi_sma_options_page() {
?>
  <div>
  <h2>SmartMail Pi Settings</h2>
  <form method="post" action="options.php">
  <?php settings_fields('pi_sma_options_group'); ?>
  <table>
  <tr valign="top">
  <th scope="row"><label for="pi_sma_email_server_incoming">Incoming Mail Server</label></th>
  <td><input type="text" id="pi_sma_email_server_incoming" name="pi_sma_email_server_incoming" value="<?php echo esc_attr(get_option('pi_sma_email_server_incoming')); ?>" /></td>
  </tr>
  <tr valign="top">
  <th scope="row"><label for="pi_sma_email_server_outgoing">Outgoing Mail Server</label></th>
  <td><input type="text" id="pi_sma_email_server_outgoing" name="pi_sma_email_server_outgoing" value="<?php echo esc_attr(get_option('pi_sma_email_server_outgoing')); ?>" /></td>
  </tr>
  <tr valign="top">
  <th scope="row"><label for="pi_sma_email_username">Email Username</label></th>
  <td><input type="text" id="pi_sma_email_username" name="pi_sma_email_username" value="<?php echo esc_attr(get_option('pi_sma_email_username')); ?>" /></td>
  </tr>
  <tr valign="top">
  <th scope="row"><label for="pi_sma_email_password">Email Password</label></th>
  <td><input type="password" id="pi_sma_email_password" name="pi_sma_email_password" value="<?php echo esc_attr(get_option('pi_sma_email_password')); ?>" /></td>
  </tr>
  </table>
  <?php submit_button(); ?>
  </form>
  </div>
<?php
}
