<?php

/**
 * Set access credentials for plugin repository
 */
add_filter('gu_set_options', function () {
    return [
        '10d-support-report'    => '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',
    ];
});

/**
 * Remove Github Updater settings page
 */
add_filter('gu_hide_settings', function () {
    $current_user = wp_get_current_user();

    if (!$current_user) {
        return true;
    }

    $has_10degrees_email = strpos($current_user->user_email, '@10degrees.uk');

    if ($has_10degrees_email === false) {
        return true;
    }

    return false;
});
