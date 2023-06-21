<?php

/**
 * This function runs when WordPress completes its upgrade process
 * It iterates through each plugin updated to see if ours is included
 * @param $upgrader_object Array
 * @param $options Array
 */
function td_plugin_upgrade_completed($upgrader_object, $options)
{
    // If an update has taken place and the updated type is plugins and the plugins element exists
    if ($options['action'] == 'update' && $options['type'] == 'plugin') {

        // Iterate through the plugins being updated and check if ours is there
        if (get_option('td_plugin_update_log')) {
            $allUpdates = get_option('td_plugin_update_log');
        } else {
            $allUpdates = array();
        }

        foreach ($options['plugins'] as $plugin) {

            // get Plugin Data
            $pluginFolderPath = plugin_dir_path(plugin_dir_path(__DIR__));
            $pluginPath = $pluginFolderPath . $plugin;
            $pluginData = get_plugin_data($pluginPath);
            $logStatement =  '<tr><td><small>' . date('F') . '</small></td><td><small>We updated the plugin <b>' . $pluginData["Name"] . '</b> to version ' . $pluginData["Version"] . ' on ' . date('l, jS F') . '.</small></td></tr>';
            array_push($allUpdates, $logStatement);
        }

        update_option('td_plugin_update_log', $allUpdates);
    } elseif ($options['action'] == 'update' && $options['type'] == 'core') {

        if (get_option('td_core_update_log')) {

            $allUpdates = get_option('td_core_update_log');
        } else {

            $allUpdates = array();
        }

        $WP_version = file_get_contents(ABSPATH . WPINC . '/version.php');

        $logStatement =  '<tr><td colspan="3"><small>We updated the WordPress Core to the latest available version (' . $WP_version . ') on ' . date('l, jS F') . '.</small></td></tr>';

        array_push($allUpdates, $logStatement);

        update_option('td_core_update_log', $allUpdates);
    } elseif ($options['action'] == 'update' && $options['type'] == 'theme') {
        if (get_option('td_theme_update_log')) {

            $themeUpdates = get_option('td_theme_update_log');
        } else {

            $themeUpdates = array();
        }

        foreach ($options['themes'] as $themeName) {
            $themeData = wp_get_theme($themeName);
            if ($themeData->exists()) {
                $logStatement =  '<tr><tr><td><small>' . date('F') . '</small></td><td colspan="3"><small>We updated the theme <b>' . $themeData->get('Name') . '</b> to version ' . $themeData['Version'] . ' on ' . date('l, jS F') . '.</small></td></tr>';
                array_push($themeUpdates, $logStatement);
            }
        }

        update_option('td_theme_update_log', $themeUpdates);
    }
}
add_action('upgrader_process_complete', 'td_plugin_upgrade_completed', 10, 2);





/* Clear the Log */

function td_clear_the_plugin_log()
{

    $current_user = wp_get_current_user();

    if (strpos($current_user->user_email, '@10degrees.uk') !== false) {

        if (isset($_REQUEST["clear-the-update-log-10d"])) {

            td_clear_log('td_plugin_update_log'); // Plugins
            td_clear_log('td_core_update_log'); // Core
            td_clear_log('td_theme_update_log'); // Themes
        }
    }
}
add_action('admin_init', 'td_clear_the_plugin_log');

/**
 * Clear all entries older than 2 months from the database
 *
 * @param   string  $logOptionName  Option key for the log entries
 *
 * @return  void
 */
function td_clear_log($logOptionName)
{
    $logEntries = get_option($logOptionName) ? get_option($logOptionName) : [];

    // Search
    foreach ($logEntries as $logEntry => $value) {

        if (strpos($value, date('F')) !== false) {

            //keep this Entry as it is from this month

        } elseif (strpos($value, date("F", strtotime("-1 month"))) !== false) {

            // keep this Entry as it is from last month

        } else {

            unset($logEntries[$logEntry]);
        }
    }

    update_option($logOptionName, $logEntries);
}