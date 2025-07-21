<?php

/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function td_plugin_report_dashboard_display()
{
    //Support Contact Details
    echo td_wc_view('contact-details');

    //Update log tables
    echo td_wc_view('update-log-tables');

    //GT Metrix scores
    echo td_wc_view('gt-metrix-overview');

    //Site health
    echo td_wc_view('site-health');

    //Send report
    echo td_wc_view('send-report');
}

/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function td_support_report_dashboard_widget_function()
{
    if (current_user_can('manage_options')) {
        wp_add_dashboard_widget(
            'td_plugin_report_dashboard_widget',         // Widget slug.
            '10 Degrees Support & Maintenance',         // Title.
            'td_plugin_report_dashboard_display' // Display function.
        );
        global $wp_meta_boxes;
        // Get the regular dashboard widgets array
        // (which has our new widget already but at the end)

        $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

        // Backup and delete our new dashboard widget from the end of the array
        $example_widget_backup = array('td_plugin_report_dashboard_widget' => $normal_dashboard['td_plugin_report_dashboard_widget']);

        unset($normal_dashboard['td_plugin_report_dashboard_widget']);

        // Merge the two arrays together so our widget is at the beginning
        $sorted_dashboard = array_merge($example_widget_backup, $normal_dashboard);

        // Save the sorted array back into the original metaboxes
        $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
    }
}
add_action('wp_dashboard_setup', 'td_support_report_dashboard_widget_function');
