<?php
/*
* Plugin Name: 10 Degrees Wordcare
* Description: Management and reporting for 10 Degrees WordCare clients.
* Version: 1.1.0
* Author: 10 Degrees
* Author URI: https://10degrees.uk
* Text Domain: td
*/

/*
* Prevent direct access to this file
*/
if (!defined('ABSPATH')) {
    exit;
}

/*
* Helpers
*/
require_once('lib/Helpers.php');

/*
* Enqueue assets
*/
require_once('lib/Enqueue.php');

/*
* GT Metrix
*/
require_once('gt-metrix/src/GTMetrixBrowser.php');
require_once('gt-metrix/src/GTMetrixClient.php');
require_once('gt-metrix/src/GTMetrixException.php');
require_once('gt-metrix/src/GTMetrixConfigurationException.php');
require_once('gt-metrix/src/GTMetrixLocation.php');
require_once('gt-metrix/src/GTMetrixTest.php');
require_once('lib/GtMetrix.php');
require_once('lib/GtMetrixAjax.php');

/*
* Not Live Chat
*/
// require_once('lib/not-live-chat.php');

/*
* Watch for upgrades and log results
*/
require_once('lib/UpgradeWatcher.php');

/*
* Report Widget and Email
*/
require_once('lib/ReportDashboardWidget.php');
require_once('lib/ReportRecipient.php');
require_once('lib/ReportEmailer.php');
