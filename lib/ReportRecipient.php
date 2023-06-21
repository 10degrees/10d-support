<?php
class ReportRecipient
{
    public $recipientOptionKey = 'td_support_report_recipient_email';

    public function __construct()
    {
        if (isset($_POST['td_update_report_recipient']) && wp_verify_nonce($_POST['td_update_report_recipient'], 'td_update_report_recipient')) {
            $this->updateReportRecipient();
        }
    }

    public function updateReportRecipient()
    {
        $email = sanitize_email($_POST[$this->recipientOptionKey]);
        if ($email != '') {
            update_option($this->recipientOptionKey, $email);
        }
    }

    public function getReportRecipient()
    {
        return get_option($this->recipientOptionKey);
    }
}

function td_ReportRecipient()
{
    new ReportRecipient;
}
add_action('admin_init', 'td_ReportRecipient');
