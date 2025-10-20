<?php
/*
* Plugin Name: 10 Degrees Support and Maintenance
* Description: WordPress management and reporting for 10 Degrees support and maintenance clients.
* Version: 1.9.0
* Author: 10 Degrees
* Author URI: https://www.10degrees.uk
* Github Plugin URI: https://github.com/10degrees/10d-support-report
* Text Domain: td
*/

/*
* Prevent direct access to this file
*/
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Plugin's self directory
 */
define('TEND_PLUGIN_DIR', plugin_dir_url(__FILE__));
define('TEND_PLUGIN_PATH', plugin_dir_path(__FILE__));

/**
 * Composer
 */
require __DIR__ . '/vendor/autoload.php';

/*
* Admin menu options
*/
require_once('lib/AdminMenuOptions.php');

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

/*
* Carbon Squirrel
*/
require_once('lib/CarbonSquirrel.php');

/*
* Update Checker
*/
require_once('lib/PluginUpdateChecker.php');

/*
* Disable WordPress functions
*/
require_once('lib/Disable.php');
