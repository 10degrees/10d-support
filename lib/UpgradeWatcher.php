<?php
/**
 * This function runs when WordPress completes its upgrade process
 * It iterates through each plugin updated to see if ours is included
 * @param $upgrader_object Array
 * @param $options Array
 */
function td_plugin_upgrade_completed( $upgrader_object, $options ) {
    // If an update has taken place and the updated type is plugins and the plugins element exists
    if ($options['action'] == 'update' && $options['type'] == 'plugin' ){

        // Iterate through the plugins being updated and check if ours is there
        if(get_option('td_plugin_update_log')) {
            $allUpdates = get_option('td_plugin_update_log');
        } else {
            $allUpdates = array();
        }

        foreach( $options['plugins'] as $plugin ) {

            // get Plugin Data
            $pluginFolderPath = plugin_dir_path( plugin_dir_path( __DIR__ ) );
            $pluginPath = $pluginFolderPath . $plugin;
            $pluginData = get_plugin_data( $pluginPath );
            $logStatement =  '<tr><td><small>' . date('F') . '</small></td><td><small>We updated the plugin <b>' . $pluginData["Name"] . '</b> to version ' . $pluginData["Version"] . ' on ' . date('l, jS F') . '.</small></td></tr>';
            array_push($allUpdates , $logStatement);

        }

        update_option('td_plugin_update_log' , $allUpdates);

    } elseif ( $options['action'] == 'update' && $options['type'] == 'core' ) {

        if(get_option('td_core_update_log')){

            $allUpdates = get_option('td_core_update_log');

        } else {

            $allUpdates = array();

        }

        $WP_version = get_bloginfo( 'version' );

        $logStatement =  '<tr><td colspan="3"><small>We updated the WordPress Core to the latest available version (' . $WP_version . ') on ' . date('l, jS F') . '.</small></td></tr>';

        array_push($allUpdates , $logStatement);

        update_option('td_core_update_log' , $allUpdates);

    } elseif ( $options['action'] == 'update' && $options['type'] == 'theme' ) {
        if(get_option('td_theme_update_log')){

            $themeUpdates = get_option('td_theme_update_log');

        } else {

            $themeUpdates = array();

        }

        foreach ($options['themes'] as $themeName) {
            $themeData = wp_get_theme($themeName);
            if ($themeData->exists()) {
                $logStatement =  '<tr><td colspan="3"><small>We updated the theme <b>' . $themeData->get('Name') . '</b> to version '. $themeData['Version'] .' on ' . date('l, jS F') . '.</small></td></tr>';
                array_push($themeUpdates, $logStatement);
            }
        }

        update_option('td_core_update_log' , $themeUpdates);

        error_log('UPDATES: ');
        error_log(json_encode(get_option('td_core_update_log')));
    }

}
add_action( 'upgrader_process_complete', 'td_plugin_upgrade_completed', 10, 2 );





/* Clear the Log */

function td_clear_the_plugin_log() {

    $current_user = wp_get_current_user();

    if (strpos($current_user->user_email, '@10degrees.uk') !== false) {

        if(isset($_REQUEST["clear-the-update-log-10d"])) {

            // Clear Plugin Log

            $allUpdates = get_option('td_plugin_update_log');

            // Search
            foreach($allUpdates as $logEntry => $value) {

                if (strpos($value, date('F')) !== false) {

                    // echo date('F');
                    //keep this Entry as it is from this month

                } elseif (strpos($value, date("F",strtotime("-1 month"))) !== false) {

                    // echo date("F",strtotime("-1 month"));
                    //keep this Entry as it is from last month

                } else {

                    unset($allUpdates[$logEntry]);

                }

            }

            update_option('td_plugin_update_log' , $allUpdates);

            // Clear the core log

            $allCoreUpdates = get_option('td_core_update_log');

            // Search
            foreach($allCoreUpdates as $logEntry => $value) {

                if (strpos($value, date('F')) !== false) {

                    // echo date('F');
                    //keep this Entry as it is from this month

                } elseif (strpos($value, date("F",strtotime("-1 month"))) !== false) {

                    // echo date("F",strtotime("-1 month"));
                    // keep this Entry as it is from last month

                } else {

                    unset($allCoreUpdates[$logEntry]);

                }

            }

            update_option('td_core_update_log' , $allCoreUpdates);


        }

    }

}
add_action('admin_init', 'td_clear_the_plugin_log');