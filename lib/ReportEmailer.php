<?php
/* Email report - construct the content */

function td_email_the_report()
{
    if (isset($_REQUEST["iewrgfiy2498yr42igr24igiojfoeifbfei88s"])) {
        $ReportRecipient = new ReportRecipient;
        $to = $ReportRecipient->getReportRecipient();

        if ($to) {
            $sitename = get_bloginfo('url');
            $subject = date('F') . ' Activity Report for ' . $sitename;
            ob_start();
            require_once(ABSPATH . '/wp-content/plugins/10d-wordcare-report/lib/ReportEmailTemplate.php');
            $message = ob_get_contents();
            $headers = array('Content-Type: text/html; charset=UTF-8' , 'Bcc: reports@10degrees.uk ');
            wp_mail($to, $subject, $message, $headers);
        }
    }
}
add_action('init', 'td_email_the_report');

// define the wp_mail_failed callback
function action_wp_mail_failed($wp_error)
{
    return error_log(print_r($wp_error, true));
}

// add the action
add_action('wp_mail_failed', 'action_wp_mail_failed', 10, 1);
