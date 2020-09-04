<?php
/**
 * Set access credentials for plugin repository
 */
add_filter('github_updater_set_options', function () {
    return [
        '10d-wordcare-report'    => 'e24779cb075222911d8477559c3211996ae77360',
    ];
});

/**
 * Remove Github Updater settings page
 */
add_filter('github_updater_hide_settings', '__return_true');
