<?php // Output the form on the front end
   function tend_load_floaty_tab() {

if ( RGForms::is_gravity_page() ) {
  // don't try to load on gforms pages due to noconflict mode being awkward
} else {

     ?>
<div class="tend_nlc_chat">
  <div class="tend_nlc_chat_icon">

    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="36" height="32" viewBox="0 0 36 32">
      <path d="M15 0v0c8.284 0 15 5.435 15 12.139s-6.716 12.139-15 12.139c-0.796 0-1.576-0.051-2.339-0.147-3.222 3.209-6.943 3.785-10.661 3.869v-0.785c2.008-0.98 3.625-2.765 3.625-4.804 0-0.285-0.022-0.564-0.063-0.837-3.392-2.225-5.562-5.625-5.562-9.434 0-6.704 6.716-12.139 15-12.139zM31.125 27.209c0 1.748 1.135 3.278 2.875 4.118v0.673c-3.223-0.072-6.181-0.566-8.973-3.316-0.661 0.083-1.337 0.126-2.027 0.126-2.983 0-5.732-0.805-7.925-2.157 4.521-0.016 8.789-1.464 12.026-4.084 1.631-1.32 2.919-2.87 3.825-4.605 0.961-1.84 1.449-3.799 1.449-5.825 0-0.326-0.014-0.651-0.039-0.974 2.268 1.873 3.664 4.426 3.664 7.24 0 3.265-1.88 6.179-4.82 8.086-0.036 0.234-0.055 0.474-0.055 0.718z"></path>
    </svg>
  </div>
  <div class="tend_nlc_chat_content">
    <div class="tend_nlc_chat_banner">
      <h2>
        Contact <?php td_get_svg('10d-logo.svg'); ?>
      </h2>
      <div class="tend_nlc_chat_close">
        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32">
          <path d="M16 0c-8.837 0-16 7.163-16 16s7.163 16 16 16 16-7.163 16-16-7.163-16-16-16zM16 29c-7.18 0-13-5.82-13-13s5.82-13 13-13 13 5.82 13 13-5.82 13-13 13z"></path>
          <path d="M21 8l-5 5-5-5-3 3 5 5-5 5 3 3 5-5 5 5 3-3-5-5 5-5z"></path>
        </svg>
      </div>
    </div>
    <div class="tend_nlc_chat_content_inner">
      <p class="tend_nlc_chat_content_inner_message">
        Unlimited support is available to our WordCare clients. Please contact us now and let us know how we can help.
      </p>
      <hr />


        <p><strong>Telephone: </strong>
          <a class="tend_nlc_chat_content_call" href="tel:01183913910">
            0118 391 3910
          </a>


        <p><strong>Email: </strong>
          <a href="mailto:support@10degrees.uk">
            support@10degrees.uk
          </a>
        </p>

        <hr />




          <?php
            if(isset($_POST['ticket_submit'])) {

              $current_user = wp_get_current_user();
              $to = 'support@10degrees.uk';
              $from = esc_html( $current_user->user_email );
              $subject = $_POST['ticket_subject'];
              $body = $_POST['ticket_content'];
              $headers = array('Content-Type: text/html; charset=UTF-8' , 'From: '. $from  );

          wp_mail( $to, $subject, $body, $headers );

          echo '<small>Thank you, your ticket has been sent to our support team. We will respond to your ticket shortly and to your email address (' . $from . ').</small>';

          ?>
          <script>
          jQuery(document).ready(function($) {

            $('.tend_nlc_chat_icon').hide();

            $('.tend_nlc_chat_content').slideToggle("slow", function () {});

            $(".tend_nlc_chat").addClass('open');

          });
            </script>
          <?php

          } else { ?>


          <form name="post" action="" method="post" id="td-nlc">

        		<div class="input-text-wrap">
        			<label for="ticket-subject">
        				Support Ticket Title</label><br />
        			<input type="text" name="ticket_subject" id="ticket-subject" autocomplete="off">
        		</div>

        		<div class="textarea-wrap">
        			<textarea name="ticket_content" id="ticket-content" class="mceEditor" rows="6" cols="15" autocomplete="off" placeholder="Dear Support Team..."></textarea>
        		</div>

        		<p class="submit">
        			<input type="hidden" name="ticket_submit" value="submitted">
              <input type="submit" class="button button-primary" value="Submit Support Ticket">
              <br class="clear">
        		</p>

        	</form>

        <?php } ?>

    </div>
  </div>
</div>

<?php

} //endif 

}

add_action( 'admin_footer', 'tend_load_floaty_tab' , 200);
