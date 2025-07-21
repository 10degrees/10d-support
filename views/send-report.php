<?php $current_user = wp_get_current_user();
if (strpos($current_user->user_email, '@10degrees.uk') !== false) { ?>
    <div class="widget_section">
        <h3>Send client report</h3>
        <p>Send the report to the client</p>
        <p class="submit">
            <a class="button button-primary" href="?iewrgfiy2498yr42igr24igiojfoeifbfei88s" class="clear-log">Send report</a>
        </p>
        <?php if (isset($_GET['iewrgfiy2498yr42igr24igiojfoeifbfei88s'])) {
            echo "<p class='td-notification'>Report sent to client</p>";
        } ?>
    </div>
<?php } ?>