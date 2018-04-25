<h3>Plugin Updates</h3>

<div class="table-holder">
  <table>
      <tbody>
          <th style="text-align: left;">Month</th>
          <th style="text-align: left;">Update (<?php echo $count; ?>)

              <a target="_blank" href="https://www.10degrees.uk/">

                  <?php td_get_svg('10d-logo.svg'); ?>

              </a>
          </th>

          <?php

          $newestFirst = array_reverse($log);

          foreach($newestFirst as $entry) {

              echo $entry;

          }

          ?>

      </tbody>
  </table>
</div>

<p>
    <a href="javascript:void();" class="button button-primary tend-download-report-button">
        Export Report
    </a>
</p>

<hr />
