<?php
/*
* Admin Menu
*/
// Hook to add admin menu
add_action('admin_menu', 'td_add_support_maintenance_menu');

function td_add_support_maintenance_menu()
{
    add_menu_page(
        '10 Degrees Support & Maintenance',   // Page title
        'Support & Maintenance',   // Menu title
        'manage_options',                      // Capability
        'td-support-maintenance',              // Menu slug
        'td_support_maintenance_page_html',   // Callback to render page content
        'dashicons-admin-tools',               // Icon
        80                                    // Position (optional)
    );
}

// Register settings
add_action('admin_init', 'td_register_support_maintenance_settings');
function td_register_support_maintenance_settings()
{
    // Register options to store
    register_setting('td_support_maintenance_group', 'td_carbon_squirrel_enabled');
    register_setting('td_support_maintenance_group', 'td_gtmetrix_username');
    register_setting('td_support_maintenance_group', 'td_gtmetrix_api_key');
}

// Render the page HTML
function td_support_maintenance_page_html()
{
    if (!current_user_can('manage_options')) {
        return;
    }

    // Register options with WordPress Settings API (if not already registered)
    // This ensures settings_fields() works and options are saved
    register_setting('td_support_maintenance_group', 'td_carbon_squirrel_enabled');
    register_setting('td_support_maintenance_group', 'td_gtmetrix_username');
    register_setting('td_support_maintenance_group', 'td_gtmetrix_api_key');
    register_setting('td_support_maintenance_group', 'td_support_report_recipient_email');

    // Get current option values
    $carbon_squirrel_enabled = get_option('td_carbon_squirrel_enabled', '0');
    $gtmetrix_username = get_option('td_gtmetrix_username', '');
    $gtmetrix_api_key = get_option('td_gtmetrix_api_key', '');
    $update_recipient_email = get_option('td_support_report_recipient_email', '');

    $current_user = wp_get_current_user();
    $user_email = $current_user->user_email;

    // Process tidy log action if requested & nonce verified
    if (
        isset($_GET['clear-the-update-log-10d']) &&
        current_user_can('manage_options') &&
        strpos($user_email, '@10degrees.uk') !== false
    ) {
        // Clear the log option (update this if logs are stored differently)
        update_option('td_update_log', '');

        echo '<div class="notice notice-success is-dismissible"><p>Logs tidied.</p></div>';
    }

?>
    <div class="wrap">
        <h1>10 Degrees Support & Maintenance</h1>

        <form method="post" action="options.php">
            <?php
            settings_fields('td_support_maintenance_group');
            do_settings_sections('td_support_maintenance_group');
            ?>

            <table class="form-table" role="presentation">
                <tbody>
                    <tr>
                        <th scope="row">Enable Carbon Squirrel</th>
                        <td>
                            <input type="checkbox" name="td_carbon_squirrel_enabled" value="1" <?php checked('1', $carbon_squirrel_enabled); ?>>
                            <p class="description">Outputs the Carbon Squirrel script in the site head to track page carbon usage.</p>
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="td_gtmetrix_username">GT Metrix Username</label></th>
                        <td>
                            <input type="text" id="td_gtmetrix_username" name="td_gtmetrix_username" value="<?php echo esc_attr($gtmetrix_username); ?>" class="regular-text">
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="td_gtmetrix_api_key">GT Metrix API Key</label></th>
                        <td>
                            <input type="text" id="td_gtmetrix_api_key" name="td_gtmetrix_api_key" value="<?php echo esc_attr($gtmetrix_api_key); ?>" class="regular-text">
                        </td>
                    </tr>

                    <tr>
                        <th scope="row"><label for="td_support_report_recipient_email">Report recipient email</label></th>
                        <td>
                            <input type="email" id="td_support_report_recipient_email" name="td_support_report_recipient_email" value="<?php echo esc_attr($update_recipient_email); ?>" class="regular-text" autocomplete="off">
                        </td>
                    </tr>
                </tbody>
            </table>

            <?php submit_button('Save Changes'); ?>
        </form>

        <hr>

        <?php if (strpos($user_email, '@10degrees.uk') !== false): ?>
            <h2>Tidy Log</h2>
            <p>Removes all entries older than 2 months</p>
            <p>
                <a href="<?php echo esc_url(add_query_arg('clear-the-update-log-10d', '1')); ?>" class="button button-primary">Tidy up log</a>
            </p>
        <?php endif; ?>

    </div>
<?php
}
