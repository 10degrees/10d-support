<?php
/*

Plugin Name: 10° Wordcare Report
Description: Logging all the WordPress updates, export to a report and email it out.
Version: 1.0.0
Author: Tom Kay and Ralph Morris
Author URI: https://10degrees.uk
Text Domain: td

*/

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {

    exit;

}

require_once('lib/helpers.php');

require_once('gt-metrix/src/GTMetrixBrowser.php');
require_once('gt-metrix/src/GTMetrixClient.php');
require_once('gt-metrix/src/GTMetrixException.php');
require_once('gt-metrix/src/GTMetrixConfigurationException.php');;
require_once('gt-metrix/src/GTMetrixLocation.php');
require_once('gt-metrix/src/GTMetrixTest.php');

require_once('lib/Td_GT_Metrix.php');
require_once('lib/gt-metrix-ajax.php');

require_once('lib/ReportRecipient.php');
require_once('lib/report-dashboard-widget.php');
require_once('lib/not-live-chat.php');

// add Our css and js
function td_10d_wordcare_report_scripts() {
    wp_enqueue_style( 'plugin_report_admin_css', plugins_url() . '/10d-wordcare-report/10d-plugin-report.css', false );
    wp_enqueue_script( 'plugin_report_admin_js', plugins_url() . '/10d-wordcare-report/10d-plugin-report.js' );
}
add_action( 'admin_enqueue_scripts', 'td_10d_wordcare_report_scripts' );

/**
 * This function runs when WordPress completes its upgrade process
 * It iterates through each plugin updated to see if ours is included
 * @param $upgrader_object Array
 * @param $options Array
 */
function td_plugin_upgrade_completed( $upgrader_object, $options ) {

    // If an update has taken place and the updated type is plugins and the plugins element exists
    if ($options['action'] == 'update' && $options['type'] == 'plugin' ){

    // Iterate through the plugins being updated and check if ours is there
    if(get_option('td_plugin_update_log')) {

        $allUpdates = get_option('td_plugin_update_log');

    } else {

        $allUpdates = array();

    }

    foreach( $options['plugins'] as $plugin ) {

        // get Plugin Data
        $pluginFolderPath = plugin_dir_path( __DIR__ );
        $pluginPath = $pluginFolderPath . $plugin;
        $pluginData = get_plugin_data( $pluginPath );
        $logStatement =  '<tr><td><small>' . date('Y') . '</small></td><td><small>' . date('F') . '</small></td><td><small>We updated the plugin <b>' . $pluginData["Name"] . '</b> to version ' . $pluginData["Version"] . ' on ' . date('l, jS F') . '.</small></td></tr>';
        array_push($allUpdates , $logStatement);

    }

    update_option('td_plugin_update_log' , $allUpdates);

    } elseif ( $options['action'] == 'update' && $options['type'] == 'core' ) {

        if(get_option('td_core_update_log')){

            $allUpdates = get_option('td_core_update_log');

        } else {

            $allUpdates = array();

        }

        $WP_version = get_bloginfo( 'version' );

        $logStatement =  '<tr><td colspan="3"><small>We updated the WordPress Core to the latest available version (' . $WP_version . ') on ' . date('l, jS F') . '.</small></td></tr>';

        array_push($allUpdates , $logStatement);

        update_option('td_core_update_log' , $allUpdates);

    }

}
add_action( 'upgrader_process_complete', 'td_plugin_upgrade_completed', 10, 2 );

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



/* Clear the Log */

function td_clear_the_plugin_log() {

    $current_user = wp_get_current_user();

    if (strpos($current_user->user_email, '@10degrees.uk') !== false) {

        if(isset($_REQUEST["clear-the-update-log-10d"])) {

            // Clear Plugin Log

            $allUpdates = get_option('td_plugin_update_log');

            // Search
            foreach($allUpdates as $logEntry => $value) {

                if (strpos($value, date('F')) !== false) {

                    // echo date('F');
                    //keep this Entry as it is from this month

                } elseif (strpos($value, date("F",strtotime("-1 month"))) !== false) {

                    // echo date("F",strtotime("-1 month"));
                    //keep this Entry as it is from last month

                } else {

                    unset($allUpdates[$logEntry]);

                }

            }

            update_option('td_plugin_update_log' , $allUpdates);

            // Clear the core log

            $allCoreUpdates = get_option('td_core_update_log');

            // Search
            foreach($allCoreUpdates as $logEntry => $value) {

                if (strpos($value, date('F')) !== false) {

                    // echo date('F');
                    //keep this Entry as it is from this month

                } elseif (strpos($value, date("F",strtotime("-1 month"))) !== false) {

                    // echo date("F",strtotime("-1 month"));
                    // keep this Entry as it is from last month

                } else {

                    unset($allCoreUpdates[$logEntry]);

                }

            }

            update_option('td_core_update_log' , $allCoreUpdates);


        }

    }

}
add_action('admin_init', 'td_clear_the_plugin_log');


/* Email report - construct the content */

function td_email_the_report() {

    if(isset($_REQUEST["email-client-report-iewrgfiy2498yr42igr24ig"])) {

        $ReportRecipient = new ReportRecipient;

        $to = $ReportRecipient->getReportRecipient();

        if ($to)
        {

            $sitename = get_bloginfo('url');
            $subject = date('F') . ' Activity Report for ' . $sitename;
            // $content = file_get_contents( plugin_dir_path( __FILE__ ) . 'email-template/report.php');

            ob_start();

            require_once( ABSPATH . '/wp-content/plugins/10d-wordcare-report/email-template/report.php');
            $message = ob_get_contents();

            var_dump($message);

            // $message = eval("$content");

            $headers = array('Content-Type: text/html; charset=UTF-8' , 'Bcc: reports@10degrees.uk ');

            wp_mail( $to, $subject, $message, $headers);
        }

    }

}
add_action('admin_init', 'td_email_the_report');
