<?php
/*
* Plugin Name: 10 Degrees WordCare
* Description: Management and reporting for 10 Degrees WordCare clients.
* Version: 1.1.1
* Author: 10 Degrees
* Author URI: https://www.10degrees.uk
* Github Plugin URI: https://github.com/10degrees/10D-wordcare-report
* Text Domain: td
*/

/*
* Prevent direct access to this file
*/
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Composer
 */
require __DIR__ . '/vendor/autoload.php';

/*
* Helpers
*/
require_once('lib/Helpers.php');

/*
* Access credentials for the BitBucket repository for this plugin
*/
require_once('lib/GithubUpdater.php');

/*
* Enqueue assets
*/
require_once('lib/Enqueue.php');

/*
* GT Metrix
*/
require_once('lib/GtMetrix.php');
require_once('lib/GtMetrixAjax.php');

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
