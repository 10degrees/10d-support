<?php /**
 * Create the function to output the contents of our Dashboard Widget.
 */
function td_plugin_report_dashboard_display() {

    // Table for WordPress Plugin Updates Log

    if($log = get_option('td_plugin_update_log')) {

        $count = count($log);

        echo td_view('plugin-update-log', array(
          'count' => $count,
          'log' => $log,
        ));

    } else {

        echo 'No Plugin Updates in the log at the moment. ';

    }

    // Table for WordPress Core Updates Log
    if(!get_option('td_core_update_log')){

      echo 'No WordPress Core Updates in the log at the moment.';

    } else {

        $log = get_option('td_core_update_log');

        $count = count($log);

        echo td_view('core-update-log', array(
          'count' => $count,
          'log' => $log,
        ));

    }

    // check WP version and display
    $WP_version = get_bloginfo( 'version' );

    $url = 'https://api.wordpress.org/core/version-check/1.7/';
    $response = wp_remote_get($url);
    $json = $response['body'];
    $obj = json_decode($json);

    $upgrade = $obj->offers[0];

    if($WP_version == $upgrade->version) {

        echo '<p>
            <svg class="tend-icon" fill="#32bd32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
            <path d="M27 4l-15 15-7-7-5 5 12 12 20-20z"></path>
            </svg>';

        echo ' You are running the latest version of WordPress (' . $WP_version . ').</p>';

    }

    // check for SSL and display
    if(isset($_SERVER['HTTPS'])) {

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
    $timeOfTest = $testResults['timeStamp'];

    if($timeOfTest < (time() - (7 * 24 * 60 * 60))) {

        $NewTestRequired = TRUE;

    }

    if ($testResults && ($NewTestRequired == FALSE) ) {

        echo td_view('gt-metrix-overview', array('testResults' => $testResults));

    } else {

        // run the test
        echo '<div id="js-generate-report">Loading new performance report... (This may take a couple of minutes).</div>';

    }

    $ReportRecipient = new ReportRecipient;

    echo td_view('update-email-recipient', array('currentEmail' => $ReportRecipient->getReportRecipient()));


    /* Give 10d Users the ability to clear the log by emptying the option */
    $current_user = wp_get_current_user();

    if (strpos($current_user->user_email, '@10degrees.uk') !== false) {

        echo '<hr /><h3>Tidy Log</h3><p>
        <p>Removes all entries older than 2 months</p>
        <p>
        <a class="button button-primary" href="?clear-the-update-log-10d" class="clear-log">Tidy Up Log</a>
        </p>';

    }

}

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function td_wordcare_report_dashboard_widget_function() {

    if( current_user_can('manage_options') ) {

    	wp_add_dashboard_widget(
             'td_plugin_report_dashboard_widget',         // Widget slug.
             '10° WordCare Reporting',         // Title.
             'td_plugin_report_dashboard_display' // Display function.
        );

        global $wp_meta_boxes;

       	// Get the regular dashboard widgets array
       	// (which has our new widget already but at the end)

       	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

       	// Backup and delete our new dashboard widget from the end of the array
       	$example_widget_backup = array( 'td_plugin_report_dashboard_widget' => $normal_dashboard['td_plugin_report_dashboard_widget'] );

       	unset( $normal_dashboard['td_plugin_report_dashboard_widget'] );

       	// Merge the two arrays together so our widget is at the beginning
       	$sorted_dashboard = array_merge( $example_widget_backup, $normal_dashboard );

       	// Save the sorted array back into the original metaboxes
       	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;

    }

}
add_action( 'wp_dashboard_setup', 'td_wordcare_report_dashboard_widget_function' );