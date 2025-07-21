<?php
$is_enabled = get_option('td_carbon_squirrel_enabled') === '1';
$show_message = false;
$status_message = '';
?>
<div class="widget_section">
    <h3>Carbon Squirrel</h3>
    <p>Outputs the script in the site head to track page carbon usage</p>
    <form method="post">
        <?php wp_nonce_field('td_carbon_squirrel_toggle', 'td_carbon_squirrel_nonce'); ?>
        <label>
            <input type="checkbox" name="td_carbon_squirrel_enabled" value="1" <?php checked($is_enabled); ?>>
            Enable Carbon Squirrel
        </label>

        <p class="submit">
            <input type="submit" name="td_carbon_squirrel_save" class="button button-primary" value="Save">
        </p>
    </form>

    <?php
    // Show status message if the form was just submitted
    if (
        isset($_POST['td_carbon_squirrel_save']) &&
        isset($_POST['td_carbon_squirrel_nonce']) &&
        wp_verify_nonce($_POST['td_carbon_squirrel_nonce'], 'td_carbon_squirrel_toggle')
    ) {
        $is_now_enabled = isset($_POST['td_carbon_squirrel_enabled']) && $_POST['td_carbon_squirrel_enabled'] === '1';
        $status_message = $is_now_enabled ? 'Carbon Squirrel enabled' : 'Carbon Squirrel disabled';

        echo "<p class='td-notification'>{$status_message}</p>";
    }
    ?>
</div>