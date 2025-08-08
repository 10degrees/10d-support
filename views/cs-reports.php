<?php
$reports = td_get_carbon_reports_cached();
$refresh_url = wp_nonce_url(admin_url('admin-post.php?action=td_refresh_carbon_reports'), 'td_refresh_carbon_reports');

if (is_wp_error($reports)): ?>
    <p style="color:#b32d2e;">
        <?php echo esc_html($reports->get_error_message()); ?>
        <a href="<?php echo esc_url($refresh_url); ?>">Refresh now</a>
    </p>
<?php return;
endif;

if (empty($reports)): ?>
    <p>No reports found. <a href="<?php echo esc_url($refresh_url); ?>">Refresh now</a></p>
<?php return;
endif; ?>

<p>Available Carbon Squirrel Reports:</p>
<ul id="td-reports-list">
    <?php foreach ($reports as $item):
        $name = isset($item['name']) ? $item['name'] : '';
        $link = isset($item['download']) ? $item['download'] : ''; ?>
        <li>
            <a target="_blank" rel="noopener" href="<?php echo esc_url($link); ?>">
                <?php echo esc_html($name); ?>
            </a>
        </li>
    <?php endforeach; ?>
</ul>
<p><a href="<?php echo esc_url($refresh_url); ?>">Refresh now</a></p>