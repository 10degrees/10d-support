<?php
/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function td_plugin_report_dashboard_display()
{
    $NewTestRequired = null;

    //WordCare Contact Details
    echo '<h3>WordCare Contact Details</h3>
        <h4>Support available Monday-Friday 9am-5pm</h4>
        <p class="td_contact_details">
            <svg class="tend-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M21 16.42v3.536a1 1 0 0 1-.93.998c-.437.03-.794.046-1.07.046-8.837 0-16-7.163-16-16 0-.276.015-.633.046-1.07A1 1 0 0 1 4.044 3H7.58a.5.5 0 0 1 .498.45c.023.23.044.413.064.552A13.901 13.901 0 0 0 9.35 8.003c.095.2.033.439-.147.567l-2.158 1.542a13.047 13.047 0 0 0 6.844 6.844l1.54-2.154a.462.462 0 0 1 .573-.149 13.901 13.901 0 0 0 4 1.205c.139.02.322.042.55.064a.5.5 0 0 1 .449.498z" fill="#000"/></svg>
            Call us: <a href="tel:01183913910">0118 391 3910</a>
        </p>
        <p class="td_contact_details">
            <svg class="tend-icon" width="24" height="24" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M20,4 L4,4 C2.9,4 2.01,4.9 2.01,6 L2,18 C2,19.1 2.9,20 4,20 L20,20 C21.1,20 22,19.1 22,18 L22,6 C22,4.9 21.1,4 20,4 Z M19.6,8.25 L12.53,12.67 C12.21,12.87 11.79,12.87 11.47,12.67 L4.4,8.25 C4.15,8.09 4,7.82 4,7.53 C4,6.86 4.73,6.46 5.3,6.81 L12,11 L18.7,6.81 C19.27,6.46 20,6.86 20,7.53 C20,7.82 19.85,8.09 19.6,8.25 Z" id="🔹Icon-Color" fill="#1D1D1D"></path></svg>
            Email us: <a href="mailto:support@10degrees.uk">support@10degrees.uk</a>
        </p>
        <hr />';

    // Table for WordPress Plugin Updates Log
    if ($log = get_option('td_plugin_update_log')) {
        $count = count($log);
        echo td_wc_view('plugin-update-log', array(
          'count' => $count,
          'log' => $log,
        ));
    } else {
        echo '<p>No plugin updates in the log at the moment.</p>';
    }

    // Table for WordPress Theme Updates Log
    if (!get_option('td_theme_update_log')) {
        echo '<p>No theme updates in the log at the moment.</p>';
    } else {
        $log = get_option('td_theme_update_log');
        $count = count($log);
        echo td_wc_view('theme-update-log', array(
            'count' => $count,
            'log' => $log,
        ));
    }

    // Table for WordPress Core Updates Log
    if (!get_option('td_core_update_log')) {
        echo '<p>No WordPress core updates in the log at the moment.</p>';
    } else {
        $log = get_option('td_core_update_log');
        $count = count($log);
        echo td_wc_view('core-update-log', array(
          'count' => $count,
          'log' => $log,
        ));
    }

    // Check WP version and display
    $WP_version = get_bloginfo('version');
    $url = 'https://api.wordpress.org/core/version-check/1.7/';
    $response = wp_remote_get($url);
    if (is_array($response) && !is_wp_error($response)) {
        $json = $response['body'];
        $obj = json_decode($json);
        $upgrade = $obj->offers[0];
    
        if ($WP_version == $upgrade->version) {
            echo '<p>
                <svg class="tend-icon" fill="#32bd32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
                <path d="M27 4l-15 15-7-7-5 5 12 12 20-20z"></path>
                </svg>';
            echo ' You are running the latest version of WordPress (' . $WP_version . ').</p>';
        }
    }

    // Check for SSL and display
    if (isset($_SERVER['HTTPS'])) {
        if ($_SERVER['HTTPS'] == "on") {
            echo '<p>
            <svg class="tend-icon" fill="#32bd32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
            <path d="M18.5 14h-0.5v-6c0-3.308-2.692-6-6-6h-4c-3.308 0-6 2.692-6 6v6h-0.5c-0.825 0-1.5 0.675-1.5 1.5v15c0 0.825 0.675 1.5 1.5 1.5h17c0.825 0 1.5-0.675 1.5-1.5v-15c0-0.825-0.675-1.5-1.5-1.5zM6 8c0-1.103 0.897-2 2-2h4c1.103 0 2 0.897 2 2v6h-8v-6z"></path>
            </svg>';
            echo ' Your site is secured with HTTPS.</p>';
        }
    }

    echo '<hr /><h3>Monthly Performance Report</h3>';

    $testResults = get_option('td_GT_metrix_test');
    if ($testResults) {
        $timeOfTest = $testResults['timeStamp'];

        if ($timeOfTest < (time() - (7 * 24 * 60 * 60))) {
            $NewTestRequired = true;
        }
    }

    
    if ($testResults && ($NewTestRequired == false)) {
        echo td_wc_view('gt-metrix-overview', array('testResults' => $testResults));
    } else {
        // run the test
        echo '<div id="js-generate-report">Loading new performance report... (This may take a couple of minutes).</div>';
    }

    $ReportRecipient = new ReportRecipient;

    echo td_wc_view('update-email-recipient', array('currentEmail' => $ReportRecipient->getReportRecipient()));

    /* Give 10d Users the ability to clear the log by emptying the option */
    $current_user = wp_get_current_user();
    if (strpos($current_user->user_email, '@10degrees.uk') !== false) {
        echo '<hr /><h3>Tidy log</h3><p>
        <p>Removes all entries older than 2 months</p>
        <p>
        <a class="button button-primary" href="?clear-the-update-log-10d" class="clear-log">Tidy up log</a>
        </p>';
        
        echo '<hr /><h3>Send client report</h3><p>
        <p>Send the report to the client</p>
        <p>
        <a class="button button-primary" href="?iewrgfiy2498yr42igr24igiojfoeifbfei88s" class="clear-log">Send report</a>
        </p>';

        if (isset($_GET[ 'iewrgfiy2498yr42igr24igiojfoeifbfei88s' ])) {
            echo "<p class='td-notification'>Report sent to client</p>";
        }
    }
}

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function td_wordcare_report_dashboard_widget_function()
{
    if (current_user_can('manage_options')) {
        wp_add_dashboard_widget(
            'td_plugin_report_dashboard_widget',         // Widget slug.
            '10 Degrees WordCare',         // Title.
            'td_plugin_report_dashboard_display' // Display function.
        );
        global $wp_meta_boxes;
        // Get the regular dashboard widgets array
        // (which has our new widget already but at the end)

        $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

        // Backup and delete our new dashboard widget from the end of the array
        $example_widget_backup = array( 'td_plugin_report_dashboard_widget' => $normal_dashboard['td_plugin_report_dashboard_widget'] );

        unset($normal_dashboard['td_plugin_report_dashboard_widget']);

        // Merge the two arrays together so our widget is at the beginning
        $sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);

        // Save the sorted array back into the original metaboxes
        $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
    }
}
add_action('wp_dashboard_setup', 'td_wordcare_report_dashboard_widget_function');
