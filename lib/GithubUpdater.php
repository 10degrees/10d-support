<?php
/**
 * Set access credentials for plugin repository
 */
add_filter('github_updater_set_options', function () {
    return [
        '10D-wordcare-report'    => '1',
        'github_access_token' => 'ef331884b63f5d0849fe722da5feadb528194add',
    ];
});

/**
 * Remove Github Updater settings page
 */
add_filter('github_updater_hide_settings', '__return_true');
