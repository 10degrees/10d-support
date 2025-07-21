<?php

/**
 * This function runs when WordPress completes its upgrade process
 * It iterates through each plugin updated to see if ours is included
 * @param $upgrader_object Array
 * @param $options Array
 */

// Capture the WordPress version before core update runs
function td_remember_current_wp_version($upgrader_object, $hook_extra)
{
    if (!empty($hook_extra['type']) && $hook_extra['type'] === 'core') {
        update_option('td_prev_wp_version', get_bloginfo('version'));
    }
}
add_filter('upgrader_pre_install', 'td_remember_current_wp_version', 10, 2);

function td_plugin_upgrade_completed($upgrader_object, $options)
{
    // Plugin Updates
    if ($options['action'] == 'update' && $options['type'] == 'plugin') {

        $allUpdates = get_option('td_plugin_update_log') ?: [];

        foreach ($options['plugins'] as $plugin) {
            $pluginFolderPath = plugin_dir_path(plugin_dir_path(__DIR__));
            $pluginPath = $pluginFolderPath . $plugin;
            $pluginData = get_plugin_data($pluginPath);
            $logStatement =  '<tr><td><small>' . date('F') . '</small></td><td><small>We updated the plugin <b>' . esc_html($pluginData["Name"]) . '</b> to version <b>' . esc_html($pluginData["Version"]) . '</b> on ' . date('l, jS F') . '.</small></td></tr>';
            array_push($allUpdates, $logStatement);
        }

        update_option('td_plugin_update_log', $allUpdates);
    }

    // Core Updates
    if ($options['action'] == 'update' && $options['type'] == 'core') {
        $allUpdates = get_option('td_core_update_log') ?: [];

        $prev_version = get_option('td_prev_wp_version');
        delete_option('td_prev_wp_version');

        if ($prev_version) {
            $logStatement = '<tr><td colspan="3"><small>We updated WordPress Core from version <b>' . esc_html($prev_version) . '</b> to the latest version on ' . date('l, jS F') . '.</small></td></tr>';
        } else {
            $logStatement = '<tr><td colspan="3"><small>We updated WordPress Core to the latest version on ' . date('l, jS F') . '.</small></td></tr>';
        }

        array_push($allUpdates, $logStatement);

        update_option('td_core_update_log', $allUpdates);
    }

    // Theme Updates
    if ($options['action'] == 'update' && $options['type'] == 'theme') {
        $themeUpdates = get_option('td_theme_update_log') ?: [];

        foreach ($options['themes'] as $themeName) {
            $themeData = wp_get_theme($themeName);
            if ($themeData->exists()) {
                $logStatement = '<tr><td><small>' . date('F') . '</small></td><td colspan="3"><small>We updated the theme <b>' . esc_html($themeData->get('Name')) . '</b> to version <b>' . esc_html($themeData['Version']) . '</b> on ' . date('l, jS F') . '.</small></td></tr>';
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
    $logEntries = get_option($logOptionName) ?: [];

    foreach ($logEntries as $logEntry => $value) {
        if (strpos($value, date('F')) !== false) {
            // keep entries from this month
        } elseif (strpos($value, date("F", strtotime("-1 month"))) !== false) {
            // keep entries from last month
        } else {
            unset($logEntries[$logEntry]);
        }
    }

    update_option($logOptionName, $logEntries);
}
