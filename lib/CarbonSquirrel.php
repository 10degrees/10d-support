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
        wp_enqueue_script('carbon-squirrel', td_carbon_api_base() . '/api/script', [], null, [
            'strategy'  => 'defer',
            'in_footer' => false,
        ]);
    }
}
add_action('wp_enqueue_scripts', 'td_enqueue_carbon_squirrel_script');

if (!function_exists('Carbon_Squirrel')) {
    add_action('wp_enqueue_scripts', 'td_enqueue_carbon_squirrel_script');
}

if (!function_exists('td_carbon_api_base')) {
    function td_carbon_api_base(): string
    {
        $base = 'https://app.carbonsquirrel.uk';
        return $base;
    }
}

if (!function_exists('td_carbon_reports_transient_key')) {
    function td_carbon_reports_transient_key(): string
    {
        $host = parse_url(home_url(), PHP_URL_HOST);
        return 'td_carbon_reports_' . md5(strtolower((string) $host));
    }
}

if (!function_exists('td_fetch_carbon_reports_fresh')) {
    function td_fetch_carbon_reports_fresh()
    {
        $domain = parse_url(home_url(), PHP_URL_HOST);
        $args = [
            'headers'   => ['Accept' => 'application/json'],
            'timeout'   => 10,
        ];

        $url = trailingslashit(td_carbon_api_base()) . 'api/reports?domain=' . urlencode((string) $domain);

        $resp = wp_remote_get($url, $args);
        if (is_wp_error($resp)) {
            return $resp;
        }

        $data = json_decode(wp_remote_retrieve_body($resp), true);
        if (!is_array($data) || empty($data['items'])) {
            return new WP_Error('td_no_reports', 'No reports found.');
        }

        return $data['items'];
    }
}

if (!function_exists('td_get_carbon_reports_cached')) {

    function td_get_carbon_reports_cached(int $ttl = 2 * WEEK_IN_SECONDS)
    {
        $key  = td_carbon_reports_transient_key();
        $data = get_transient($key);
        if ($data !== false) {
            return $data;
        }

        $fresh = td_fetch_carbon_reports_fresh();
        if (is_wp_error($fresh)) {
            return $fresh;
        }

        set_transient($key, $fresh, $ttl);
        return $fresh;
    }
}

if (!function_exists('td_delete_carbon_reports_cache')) {
    function td_delete_carbon_reports_cache(): void
    {
        delete_transient(td_carbon_reports_transient_key());
    }
}

add_action('admin_post_td_refresh_carbon_reports', function () {
    check_admin_referer('td_refresh_carbon_reports');
    td_delete_carbon_reports_cache();
    wp_safe_redirect(wp_get_referer() ?: admin_url());
    exit;
});
