<?php

function td_wordcare_assets()
{
    wp_enqueue_style('wordcare-report', plugins_url() . '/10d-wordcare-report/assets/10d-wordcare-report.css', false);
    wp_enqueue_script('wordcare-report', plugins_url() . '/10d-wordcare-report/assets/10d-wordcare-report.js');
}
add_action('admin_enqueue_scripts', 'td_wordcare_assets');
