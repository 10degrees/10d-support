<?php
// Toggle script on/off
function td_carbon_squirrel_toggle()
{
    if (
        isset($_POST['td_carbon_squirrel_nonce']) &&
        wp_verify_nonce($_POST['td_carbon_squirrel_nonce'], 'td_carbon_squirrel_toggle')
    ) {
        if (isset($_POST['td_carbon_squirrel_enabled']) && $_POST['td_carbon_squirrel_enabled'] === '1') {
            update_option('td_carbon_squirrel_enabled', '1');
        } else {
            update_option('td_carbon_squirrel_enabled', '0');
        }
    }
}
add_action('admin_init', 'td_carbon_squirrel_toggle');

function td_enqueue_carbon_squirrel_script()
{
    if (get_option('td_carbon_squirrel_enabled') === '1') {
        wp_enqueue_script('carbon-squirrel', 'https://app.carbonsquirrel.uk/api/script', [], null, [
            'strategy'  => 'defer',
            'in_footer' => false,
        ]);
    }
}
add_action('wp_enqueue_scripts', 'td_enqueue_carbon_squirrel_script');

if (!function_exists('Carbon_Squirrel')) {
    add_action('wp_enqueue_scripts', 'td_enqueue_carbon_squirrel_script');
}
