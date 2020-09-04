<hr>

<h3>Update Report Recipient Email</h3>

<form action="" method="POST">

    <div class="input-text-wrap">
        <label>
            Email (one only)
            <input type="text" value="<?php echo esc_html($currentEmail); ?>" name="td_wordcare_report_recipient_email" autocomplete="off">
        </label>
    </div>

    <br>

    <p class="submit">
        <?php wp_nonce_field('td_update_report_recipient', 'td_update_report_recipient'); ?>
        <input type="submit" name="save" id="save-post" class="button button-primary" value="Update Recipient Email">
        <br class="clear">
    </p>

</form>

<br>
