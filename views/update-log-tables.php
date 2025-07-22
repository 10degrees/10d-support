<?php
// Table for WordPress Plugin Updates Log
$log = get_option('td_plugin_update_log');
if (is_array($log)) {
    $count = count($log);
    echo td_wc_view('plugin-update-log', array(
        'count' => $count,
        'log' => $log,
    ));
} else { ?>
    <div class="widget_section">
        <h3>Plugin updates</h3>
        <p>No plugin updates in the log at the moment.</p>
    </div>
<?php }

// Table for WordPress Theme Updates Log
$log = get_option('td_theme_update_log');
if (is_array($log)) {
    $count = count($log);
    echo td_wc_view('theme-update-log', array(
        'count' => $count,
        'log' => $log,
    ));
} else { ?>
    <div class="widget_section">
        <h3>Theme updates</h3>
        <p>No theme updates in the log at the moment.</p>
    </div>
<?php }

// Table for WordPress Core Updates Log
$log = get_option('td_core_update_log');
if (is_array($log)) {
    $count = count($log);
    $limited_log = array_slice($log, -2); // Show only the last 2 entries
    echo td_wc_view('core-update-log', array(
        'count' => $count,
        'log' => $limited_log,
    ));
} else { ?>
    <div class="widget_section">
        <h3>WordPress core updates</h3>
        <p>No WordPress updates in the log at the moment.</p>
    </div>
<?php }
