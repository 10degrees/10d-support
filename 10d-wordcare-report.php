<?php
/*Plugin Name: 10° Wordcare Report
Description: Logging all the WordPress updates, export to a report and email it out.
Version: 1.0.0
Author: Tom Kay and Ralph Morris
Author URI: https://10degrees.uk
Text Domain: tend
*/



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
 exit;
}

require_once('gt-metrix/src/GTMetrixBrowser.php');
require_once('gt-metrix/src/GTMetrixClient.php');
require_once('gt-metrix/src/GTMetrixException.php');
require_once('gt-metrix/src/GTMetrixConfigurationException.php');;
require_once('gt-metrix/src/GTMetrixLocation.php');
require_once('gt-metrix/src/GTMetrixTest.php');
require_once('10d-gt-metrix.php');

  // add Our css and js

  add_action( 'admin_enqueue_scripts', 'load_plugin_report_styles_scripts' );
  function load_plugin_report_styles_scripts() {
    wp_enqueue_style( 'plugin_report_admin_css', plugins_url() . '/10d-plugin-report/10d-plugin-report.css', false );
    wp_enqueue_script( 'plugin_report_admin_js', plugins_url() . '/10d-plugin-report/10d-plugin-report.js' );
  }


/**
 * This function runs when WordPress completes its upgrade process
 * It iterates through each plugin updated to see if ours is included
 * @param $upgrader_object Array
 * @param $options Array
 */
function tend_plugin_upgrade_completed( $upgrader_object, $options ) {

 // If an update has taken place and the updated type is plugins and the plugins element exists
if ($options['action'] == 'update' && $options['type'] == 'plugin' ){
  // Iterate through the plugins being updated and check if ours is there

  if(get_option('tend_plugin_update_log')){
    $allUpdates = get_option('tend_plugin_update_log');
  } else {
    $allUpdates = array();
  }

  foreach( $options['plugins'] as $plugin ) {
    // get Plugin Data
    $pluginFolderPath = plugin_dir_path( __DIR__ );
    $pluginPath = $pluginFolderPath . $plugin;
    $pluginData = get_plugin_data( $pluginPath );
    $logStatement =  '<tr><td><small>' . date('Y') . '</small></td><td><small>' . date('F') . '</small></td><td><small>We updated the plugin <b>' . $pluginData["Name"] . '</b> to version ' . $pluginData["Version"] . ' on ' . date('l, jS F') . '.</small></td></tr>';
    array_push($allUpdates , $logStatement);
  }

  update_option('tend_plugin_update_log' , $allUpdates);

} elseif ( $options['action'] == 'update' && $options['type'] == 'core' ) {


 if(get_option('tend_core_update_log')){
   $allUpdates = get_option('tend_core_update_log');
 } else {
   $allUpdates = array();
 }

   $WP_version = get_bloginfo( 'version' );
   $logStatement =  '<tr><td colspan="3"><small>We updated the WordPress Core to the latest available version (' . $WP_version . ') on ' . date('l, jS F') . '.</small></td></tr>';

   array_push($allUpdates , $logStatement);


 update_option('tend_core_update_log' , $allUpdates);

}


}
add_action( 'upgrader_process_complete', 'tend_plugin_upgrade_completed', 10, 2 );





/**
 * Add a widget to the dashboard.
 *
 * This function is hooked into the 'wp_dashboard_setup' action below.
 */
function tend_plugin_report_dashboard_widget_function() {

  if( current_user_can('manage_options') ) {

	wp_add_dashboard_widget(
                 'tend_plugin_report_dashboard_widget',         // Widget slug.
                 '10° WordCare Reporting',         // Title.
                 'tend_plugin_report_dashboard_display' // Display function.
        );

        global $wp_meta_boxes;

       	// Get the regular dashboard widgets array
       	// (which has our new widget already but at the end)

       	$normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];

       	// Backup and delete our new dashboard widget from the end of the array

       	$example_widget_backup = array( 'tend_plugin_report_dashboard_widget' => $normal_dashboard['tend_plugin_report_dashboard_widget'] );
       	unset( $normal_dashboard['tend_plugin_report_dashboard_widget'] );

       	// Merge the two arrays together so our widget is at the beginning

       	$sorted_dashboard = array_merge( $example_widget_backup, $normal_dashboard );

       	// Save the sorted array back into the original metaboxes

       	$wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;

  }


}
add_action( 'wp_dashboard_setup', 'tend_plugin_report_dashboard_widget_function' );





/**
 * Create the function to output the contents of our Dashboard Widget.
 */
function tend_plugin_report_dashboard_display() {


  // Table for WordPress Plugin Updates Log

  if($log = get_option('tend_plugin_update_log')){


    $count = count($log);

    echo '<h3>Plugin Updates</h3><table><tbody><th style="text-align: left;">Year</th><th style="text-align: left;">Month</th><th style="text-align: left;">Update ('.$count.')

    <a target="_blank" href="https://www.10degrees.uk/">
    <svg width="72px" height="72px" viewBox="0 0 72 72" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                        <defs>
                            <polygon id="path-1" points="0 71.9831907 0 0.0409027237 71.9596576 0.0409027237 71.9596576 71.9831907"></polygon>
                        </defs>
                        <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <g id="Light-Header" transform="translate(0.000000, -1.000000)">
                                <g id="Nav">
                                    <g id="10-logo-white" transform="translate(0.000000, 1.000000)">
                                        <path d="M61.6179922,12.0242802 C63.2260856,12.0242802 64.5290895,13.3284047 64.5290895,14.9353774 C64.5290895,16.5426304 63.2260856,17.8467549 61.6179922,17.8467549 C60.0098988,17.8467549 58.7068949,16.5426304 58.7068949,14.9353774 C58.7068949,13.3284047 60.0098988,12.0242802 61.6179922,12.0242802 Z M55.9501634,14.9891673 C55.9501634,18.1067393 58.4763268,20.6331829 61.5936187,20.6331829 C64.7092296,20.6331829 67.2359533,18.1067393 67.2359533,14.9891673 C67.2359533,11.872716 64.7092296,9.34627237 61.5936187,9.34627237 C58.4763268,9.34627237 55.9501634,11.872716 55.9501634,14.9891673 L55.9501634,14.9891673 Z" id="Fill-1" fill="#FFFFFE"></path>
                                        <g id="Group-5">
                                            <mask id="mask-2" fill="white">
                                                <use xlink:href="#path-1"></use>
                                            </mask>
                                            <g id="Clip-3"></g>
                                            <path d="M41.3663813,27.6423969 C39.0237198,27.6423969 37.2559377,28.4509261 36.0638755,30.0677043 C35.069323,31.4174942 34.5717665,33.1779922 34.5717665,35.3475175 C34.5717665,37.8493074 34.970428,39.6983346 35.7657899,40.8937588 C36.8696031,42.555642 38.9144591,43.3857432 41.896716,43.3857432 C44.4161556,43.3857432 46.1836576,42.5763735 47.2006226,40.9615564 C47.9962646,39.6983346 48.392965,37.8268949 48.392965,35.3475175 C48.392965,33.0670506 47.8522646,31.2519222 46.7691829,29.9012918 C45.5527471,28.3954553 43.7524669,27.6423969 41.3663813,27.6423969" id="Fill-2" fill="#FFFFFE" mask="url(#mask-2)"></path>
                                            <path d="M67.9677198,19.5358132 C67.1986926,20.6110506 66.1665992,21.4854163 64.9641712,22.0611362 C67.1317354,26.3788949 68.3543346,31.2494008 68.3543346,36.4011829 C68.3543346,54.084607 53.9677821,68.4711595 36.2837977,68.4711595 C18.5992529,68.4711595 4.21185992,54.084607 4.21185992,36.4011829 C4.21185992,18.7174786 18.5992529,4.33064591 36.2837977,4.33064591 C43.3420389,4.33064591 49.8735875,6.62428016 55.1760934,10.503035 C55.9790195,9.35803891 57.079751,8.43772763 58.3653852,7.85388327 C52.2210117,2.96404669 44.44193,0.0409027237 35.9789883,0.0409027237 C16.1083891,0.0409027237 0,16.1501323 0,36.021572 C0,55.8916109 16.1083891,72 35.9789883,72 C55.8512685,72 71.9596576,55.8916109 71.9596576,36.021572 C71.9596576,30.079751 70.5182568,24.474677 67.9677198,19.5358132" id="Fill-4" fill="#FFFFFE" mask="url(#mask-2)"></path>
                                        </g>
                                        <path d="M54.293323,35.4808716 C54.293323,39.9944591 53.0441089,43.2246537 50.5484825,45.1722957 C48.5142724,46.7422879 45.5527471,47.528965 41.6647471,47.528965 C37.3567938,47.528965 34.1750661,46.6209805 32.1198444,44.8066926 C29.8654319,42.8156265 28.7392062,39.6182101 28.7392062,35.2158444 C28.7392062,31.6099611 29.7441245,28.7991595 31.7542412,26.7854008 C33.9428171,24.595144 37.2125136,23.5000156 41.565572,23.5000156 C46.3604358,23.5000156 49.7413541,24.5503191 51.7077665,26.6523268 C53.4304436,28.5114397 54.293323,31.4539144 54.293323,35.4808716 Z M20.1389883,47.0975253 L26.3702101,47.0975253 L26.3702101,23.9297743 L20.1389883,23.9297743 L20.1389883,47.0975253 Z M36.2837977,7.61771206 C20.4118599,7.61771206 7.49892607,20.5298054 7.49892607,36.4011829 C7.49892607,52.2717198 20.4118599,65.1838132 36.2837977,65.1838132 C52.1548949,65.1838132 65.0672685,52.2717198 65.0672685,36.4011829 C65.0672685,31.4936965 63.8317821,26.8702879 61.6569339,22.8228794 C61.6359222,22.8231595 61.6149105,22.8245603 61.5938988,22.8245603 C57.2733385,22.8245603 53.7585058,19.3097276 53.7585058,14.9891673 C53.7585058,14.5280311 53.8008093,14.0767004 53.877572,13.6374163 C49.0093074,9.86596109 42.9044358,7.61771206 36.2837977,7.61771206 L36.2837977,7.61771206 Z" id="Fill-6" fill="#FFFFFE"></path>
                                    </g>
                                </g>
                            </g>
                        </g>
                    </svg>
                    </a>
                    </th>';


      $newestFirst = array_reverse($log);

      foreach($newestFirst as $entry){
        echo $entry;
      }


      echo '</tbody></table>';


      echo '<p><a href="javascript:void();" class="button button-primary tend-download-report-button">Export Report</a></p> <hr />';

    } else {

        echo 'No Plugin Updates in the log at the moment.';


    }

    // Table for WordPress Core Updates Log


    if(!get_option('tend_core_update_log')){

      echo 'No WordPress Core Updates in the log at the moment.';

    } else {

      $log = get_option('tend_core_update_log');

      $count = count($log);

      echo '<h3>WordPress Core Updates</h3><table><tbody><th style="text-align: left;">Recent Core Updates ('.$count.')

      <a target="_blank" href="https://www.10degrees.uk/">
      <svg width="72px" height="72px" viewBox="0 0 72 72" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                          <defs>
                              <polygon id="path-1" points="0 71.9831907 0 0.0409027237 71.9596576 0.0409027237 71.9596576 71.9831907"></polygon>
                          </defs>
                          <g id="Symbols" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <g id="Light-Header" transform="translate(0.000000, -1.000000)">
                                  <g id="Nav">
                                      <g id="10-logo-white" transform="translate(0.000000, 1.000000)">
                                          <path d="M61.6179922,12.0242802 C63.2260856,12.0242802 64.5290895,13.3284047 64.5290895,14.9353774 C64.5290895,16.5426304 63.2260856,17.8467549 61.6179922,17.8467549 C60.0098988,17.8467549 58.7068949,16.5426304 58.7068949,14.9353774 C58.7068949,13.3284047 60.0098988,12.0242802 61.6179922,12.0242802 Z M55.9501634,14.9891673 C55.9501634,18.1067393 58.4763268,20.6331829 61.5936187,20.6331829 C64.7092296,20.6331829 67.2359533,18.1067393 67.2359533,14.9891673 C67.2359533,11.872716 64.7092296,9.34627237 61.5936187,9.34627237 C58.4763268,9.34627237 55.9501634,11.872716 55.9501634,14.9891673 L55.9501634,14.9891673 Z" id="Fill-1" fill="#FFFFFE"></path>
                                          <g id="Group-5">
                                              <mask id="mask-2" fill="white">
                                                  <use xlink:href="#path-1"></use>
                                              </mask>
                                              <g id="Clip-3"></g>
                                              <path d="M41.3663813,27.6423969 C39.0237198,27.6423969 37.2559377,28.4509261 36.0638755,30.0677043 C35.069323,31.4174942 34.5717665,33.1779922 34.5717665,35.3475175 C34.5717665,37.8493074 34.970428,39.6983346 35.7657899,40.8937588 C36.8696031,42.555642 38.9144591,43.3857432 41.896716,43.3857432 C44.4161556,43.3857432 46.1836576,42.5763735 47.2006226,40.9615564 C47.9962646,39.6983346 48.392965,37.8268949 48.392965,35.3475175 C48.392965,33.0670506 47.8522646,31.2519222 46.7691829,29.9012918 C45.5527471,28.3954553 43.7524669,27.6423969 41.3663813,27.6423969" id="Fill-2" fill="#FFFFFE" mask="url(#mask-2)"></path>
                                              <path d="M67.9677198,19.5358132 C67.1986926,20.6110506 66.1665992,21.4854163 64.9641712,22.0611362 C67.1317354,26.3788949 68.3543346,31.2494008 68.3543346,36.4011829 C68.3543346,54.084607 53.9677821,68.4711595 36.2837977,68.4711595 C18.5992529,68.4711595 4.21185992,54.084607 4.21185992,36.4011829 C4.21185992,18.7174786 18.5992529,4.33064591 36.2837977,4.33064591 C43.3420389,4.33064591 49.8735875,6.62428016 55.1760934,10.503035 C55.9790195,9.35803891 57.079751,8.43772763 58.3653852,7.85388327 C52.2210117,2.96404669 44.44193,0.0409027237 35.9789883,0.0409027237 C16.1083891,0.0409027237 0,16.1501323 0,36.021572 C0,55.8916109 16.1083891,72 35.9789883,72 C55.8512685,72 71.9596576,55.8916109 71.9596576,36.021572 C71.9596576,30.079751 70.5182568,24.474677 67.9677198,19.5358132" id="Fill-4" fill="#FFFFFE" mask="url(#mask-2)"></path>
                                          </g>
                                          <path d="M54.293323,35.4808716 C54.293323,39.9944591 53.0441089,43.2246537 50.5484825,45.1722957 C48.5142724,46.7422879 45.5527471,47.528965 41.6647471,47.528965 C37.3567938,47.528965 34.1750661,46.6209805 32.1198444,44.8066926 C29.8654319,42.8156265 28.7392062,39.6182101 28.7392062,35.2158444 C28.7392062,31.6099611 29.7441245,28.7991595 31.7542412,26.7854008 C33.9428171,24.595144 37.2125136,23.5000156 41.565572,23.5000156 C46.3604358,23.5000156 49.7413541,24.5503191 51.7077665,26.6523268 C53.4304436,28.5114397 54.293323,31.4539144 54.293323,35.4808716 Z M20.1389883,47.0975253 L26.3702101,47.0975253 L26.3702101,23.9297743 L20.1389883,23.9297743 L20.1389883,47.0975253 Z M36.2837977,7.61771206 C20.4118599,7.61771206 7.49892607,20.5298054 7.49892607,36.4011829 C7.49892607,52.2717198 20.4118599,65.1838132 36.2837977,65.1838132 C52.1548949,65.1838132 65.0672685,52.2717198 65.0672685,36.4011829 C65.0672685,31.4936965 63.8317821,26.8702879 61.6569339,22.8228794 C61.6359222,22.8231595 61.6149105,22.8245603 61.5938988,22.8245603 C57.2733385,22.8245603 53.7585058,19.3097276 53.7585058,14.9891673 C53.7585058,14.5280311 53.8008093,14.0767004 53.877572,13.6374163 C49.0093074,9.86596109 42.9044358,7.61771206 36.2837977,7.61771206 L36.2837977,7.61771206 Z" id="Fill-6" fill="#FFFFFE"></path>
                                      </g>
                                  </g>
                              </g>
                          </g>
                      </svg>
                      </a>
                      </th>';


        $newestFirst = array_reverse($log);

        foreach($newestFirst as $entry){
          echo $entry;
        }


        echo '</tbody></table> <hr />';


      }




      // check WP version and display

     $WP_version = get_bloginfo( 'version' );


      $url = 'https://api.wordpress.org/core/version-check/1.7/';
      $response = wp_remote_get($url);
      $json = $response['body'];
      $obj = json_decode($json);

      $upgrade = $obj->offers[0];
      if($WP_version == $upgrade->version) {

        echo '<p>
            <svg class="tend-icon" fill="#32bd32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
            <path d="M27 4l-15 15-7-7-5 5 12 12 20-20z"></path>
            </svg>';

        echo ' You are running the latest version of WordPress (' . $WP_version . ').</p>';

      }



      // check for SSL and display

      if(isset($_SERVER['HTTPS'])) {
        if ($_SERVER['HTTPS'] == "on") {
              echo '<p>
              <svg class="tend-icon" fill="#32bd32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
              <path d="M18.5 14h-0.5v-6c0-3.308-2.692-6-6-6h-4c-3.308 0-6 2.692-6 6v6h-0.5c-0.825 0-1.5 0.675-1.5 1.5v15c0 0.825 0.675 1.5 1.5 1.5h17c0.825 0 1.5-0.675 1.5-1.5v-15c0-0.825-0.675-1.5-1.5-1.5zM6 8c0-1.103 0.897-2 2-2h4c1.103 0 2 0.897 2 2v6h-8v-6z"></path>
              </svg>';
              echo ' Your site is secure.</p>';
        }
      }







 echo '<hr /><h3>Monthly Performance Report</h3>';


$testResults = get_option('tend_GT_metrix_test');
$timeOfTest = $testResults['timeStamp'];

if($timeOfTest < (time() - (7 * 24 * 60 * 60))) {
  $NewTestRequired = TRUE;
}

if ($testResults && ($NewTestRequired == FALSE) ){

$reportTime = $testResults['timeStamp'];
echo '<p>Date of last test: '  . date( "d F Y", $reportTime) . '<br />';
echo 'PageSpeed Score: ' . $testResults['pagespeedScore'] . '%<br />';
$loadTime = ($testResults['fullyLoadedTime'] / 1000);
echo 'Fully Loaded Time: ' . round($loadTime , 1)  . ' seconds<br/>';
echo '<a target="_blank" href="' . $testResults['reportUrl']. '">View Full Report</a></p>';



} else {

  // run the test

  echo 'A new performance report is being generated...';

  $thisURL = site_url();

  $Td_GT_Metrix = new Td_GT_Metrix($thisURL);

  $testObject = $Td_GT_Metrix->test();

  update_option('tend_GT_metrix_test' , $testObject);


}



/* Give 10d Users the ability to clear the log by emptying the option */

$current_user = wp_get_current_user();
if (strpos($current_user->user_email, '@10degrees.uk') !== false) {

echo '<hr /><p>
      <a href="?clear-the-update-log-10d" class="clear-log">Click Here to Tidy Up Log</a><br/>
      <small>Removes all entries older than 2 months</small>
      </p>';

}



}





/* Clear the Log */

add_action('admin_init', 'clear_the_plugin_log');

function clear_the_plugin_log() {

  $current_user = wp_get_current_user();
  if (strpos($current_user->user_email, '@10degrees.uk') !== false) {

    if(isset($_REQUEST["clear-the-update-log-10d"])) {


      //Clear Plugin Log

      $allUpdates = get_option('tend_plugin_update_log');

      // Search
      foreach($allUpdates as $logEntry => $value){
        if (strpos($value, date('F')) !== false) {
          // echo date('F');
          //keep this Entry as it is from this month
        }
        elseif (strpos($value, date("F",strtotime("-1 month"))) !== false) {
          // echo date("F",strtotime("-1 month"));
          //keep this Entry as it is from last month
        } else {

          unset($allUpdates[$logEntry]);

        }

      }


      update_option('tend_plugin_update_log' , $allUpdates);



      // cLear the core log

      $allCoreUpdates = get_option('tend_core_update_log');

      // Search
      foreach($allCoreUpdates as $logEntry => $value){
        if (strpos($value, date('F')) !== false) {
          // echo date('F');
          //keep this Entry as it is from this month
        }
        elseif (strpos($value, date("F",strtotime("-1 month"))) !== false) {
          // echo date("F",strtotime("-1 month"));
          //keep this Entry as it is from last month
        } else {

          unset($allCoreUpdates[$logEntry]);

        }

      }


      update_option('tend_core_update_log' , $allCoreUpdates);


    }

  }
}











/* Email report - construct the content */

add_action('admin_init', 'email_the_report');

function email_the_report() {


    if(isset($_REQUEST["email-client-report-iewrgfiy2498yr42igr24ig"])) {


      $to = 'tom@10degrees.uk , support@10degrees.uk';
      $subject = date('F') . ' Activity Report';
      // $content = file_get_contents( plugin_dir_path( __FILE__ ) . 'email-template/report.php');

      ob_start();
      require_once( ABSPATH . '/wp-content/plugins/10d-plugin-report/email-template/report.php');
      $message = ob_get_contents();

      var_dump($message);

      // $message = eval("$content");


      $headers = array('Content-Type: text/html; charset=UTF-8');



       wp_mail( $to, $subject, $message, $headers);


      }


    }
