<?php

function td_support_assets()
{
    wp_enqueue_style('support-report', TEND_PLUGIN_DIR . '/assets/10d-support-report.css', false);
    wp_enqueue_script('support-report', TEND_PLUGIN_DIR . '/assets/10d-support-report.js');
}
add_action('admin_enqueue_scripts', 'td_support_assets');