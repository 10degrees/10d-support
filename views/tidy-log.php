<?php $current_user = wp_get_current_user();
if (strpos($current_user->user_email, '@10degrees.uk') !== false) { ?>
    <div class="widget_section">
        <h3>Tidy log</h3>
        <p>Removes all entries older than 2 months</p>
        <p class="submit">
            <a class="button button-primary" href="?clear-the-update-log-10d" class="clear-log">Tidy up log</a>
        </p>
        <?php if (isset($_GET['clear-the-update-log-10d'])) {
            echo "<p class='td-notification'>Logs tidied</p>";
        } ?>
    </div>
<?php } ?>