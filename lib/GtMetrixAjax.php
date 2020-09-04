<?php

function td_get_gt_metrix_report()
{
    $Td_GT_Metrix = new Td_GT_Metrix();
    $testResults = $Td_GT_Metrix->test();
    update_option('td_GT_metrix_test', $testResults);
    wp_send_json(td_wc_view('_gt-metrix-overview', array('testResults' => $testResults)));
}

add_action('wp_ajax_td_get_gt_metrix_report', 'td_get_gt_metrix_report');
add_action('wp_ajax_nopriv_td_get_gt_metrix_report', 'td_get_gt_metrix_report');
