<?php
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
$log = get_option('td_core_update_log');
$count = count($log);
$limited_log = array_slice($log, -2); // Show only the last 2 entries
echo td_wc_view('core-update-log', array(
    'count' => $count,
    'log' => $limited_log,
));
