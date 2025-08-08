<div class="widget_section">
    <h3>Site Health</h3>
    <p> WordPress version:
        <?php
        $WP_version = get_bloginfo('version');
        $url = 'https://api.wordpress.org/core/version-check/1.7/';
        $response = wp_remote_get($url);
        if (is_array($response) && !is_wp_error($response)) {
            $json = $response['body'];
            $obj = json_decode($json);
            $upgrade = $obj->offers[0];

            if ($WP_version == $upgrade->version) { ?>
    <p>
        <svg class="tend-icon" fill="#32bd32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
            <path d="M27 4l-15 15-7-7-5 5 12 12 20-20z"></path>
        </svg>
        You are running the latest version of WordPress <?php echo '(' . $WP_version . ')'; ?>.
    </p>
<?php } else { ?>
    <p>
        <svg class="tend-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 96 96">
            <path d="M 13.4 88.492 L 1.508 76.6 c -2.011 -2.011 -2.011 -5.271 0 -7.282 L 69.318 1.508 c 2.011 -2.011 5.271 -2.011 7.282 0 L 88.492 13.4 c 2.011 2.011 2.011 5.271 0 7.282 L 20.682 88.492 C 18.671 90.503 15.411 90.503 13.4 88.492 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(236,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
            <path d="M 69.318 88.492 L 1.508 20.682 c -2.011 -2.011 -2.011 -5.271 0 -7.282 L 13.4 1.508 c 2.011 -2.011 5.271 -2.011 7.282 0 l 67.809 67.809 c 2.011 2.011 2.011 5.271 0 7.282 L 76.6 88.492 C 74.589 90.503 71.329 90.503 69.318 88.492 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(236,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
        </svg>
        You are not running the latest version of WordPress <?php echo '(' . $WP_version . ')'; ?>.
    </p>
<?php }
        } ?>
</p>

<p> SSL Certificate:
    <?php
    if (isset($_SERVER['HTTPS'])) {
        if ($_SERVER['HTTPS'] == "on") { ?>
<p>
    <svg class="tend-icon" fill="#32bd32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
        <path d="M18.5 14h-0.5v-6c0-3.308-2.692-6-6-6h-4c-3.308 0-6 2.692-6 6v6h-0.5c-0.825 0-1.5 0.675-1.5 1.5v15c0 0.825 0.675 1.5 1.5 1.5h17c0.825 0 1.5-0.675 1.5-1.5v-15c0-0.825-0.675-1.5-1.5-1.5zM6 8c0-1.103 0.897-2 2-2h4c1.103 0 2 0.897 2 2v6h-8v-6z"></path>
    </svg>
    Your site is secured with HTTPS.
</p>
<?php } else { ?>
    <p>
        <svg class="tend-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 96 96">
            <path d="M 13.4 88.492 L 1.508 76.6 c -2.011 -2.011 -2.011 -5.271 0 -7.282 L 69.318 1.508 c 2.011 -2.011 5.271 -2.011 7.282 0 L 88.492 13.4 c 2.011 2.011 2.011 5.271 0 7.282 L 20.682 88.492 C 18.671 90.503 15.411 90.503 13.4 88.492 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(236,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
            <path d="M 69.318 88.492 L 1.508 20.682 c -2.011 -2.011 -2.011 -5.271 0 -7.282 L 13.4 1.508 c 2.011 -2.011 5.271 -2.011 7.282 0 l 67.809 67.809 c 2.011 2.011 2.011 5.271 0 7.282 L 76.6 88.492 C 74.589 90.503 71.329 90.503 69.318 88.492 z" style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(236,0,0); fill-rule: nonzero; opacity: 1;" transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
        </svg>
        Your site is not secured with HTTPS!
    </p>
<?php }
    }
?>
</p>

<p>Carbon Squirrel Monitoring:
    <?php
    $carbon_squirrel_enabled = get_option('td_carbon_squirrel_enabled', false);

    if ($carbon_squirrel_enabled) { ?>
<p>
    <svg class="tend-icon" fill="#32bd32" version="1.1" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32">
        <path d="M27 4l-15 15-7-7-5 5 12 12 20-20z"></path>
    </svg>
    Carbon Squirrel monitoring is <strong>enabled</strong>!.
</p>
<?php echo td_wc_view('cs-reports'); ?>

<?php } else { ?>
    <p>
        <svg class="tend-icon" xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 96 96">
            <path d="M 13.4 88.492 L 1.508 76.6 c -2.011 -2.011 -2.011 -5.271 0 -7.282 L 69.318 1.508 c 2.011 -2.011 5.271 -2.011 7.282 0 L 88.492 13.4 c 2.011 2.011 2.011 5.271 0 7.282 L 20.682 88.492 C 18.671 90.503 15.411 90.503 13.4 88.492 z" style="fill: rgb(236,0,0);" />
            <path d="M 69.318 88.492 L 1.508 20.682 c -2.011 -2.011 -2.011 -5.271 0 -7.282 L 13.4 1.508 c 2.011 -2.011 5.271 -2.011 7.282 0 l 67.809 67.809 c 2.011 2.011 2.011 5.271 0 7.282 L 76.6 88.492 C 74.589 90.503 71.329 90.503 69.318 88.492 z" style="fill: rgb(236,0,0);" />
        </svg>
        Carbon Squirrel monitoring is <strong>disabled</strong>. Please turn on in the plugin <a href="/wp-admin/admin.php?page=td-support-maintenance">settings</a>.
    </p>
<?php } ?>
</p>


</div>