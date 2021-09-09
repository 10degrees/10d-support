<h3>WordPress core updates</h3>

<div class="table-holder">
  <table>
    <tbody>
      <th style="text-align: left;">
          Recent core updates (<?php echo $count ?>)

          <a target="_blank" href="https://www.10degrees.uk/">

            <?php td_wc_get_svg('10d-logo.svg'); ?>

          </a>

      </th>

        <?php
        $newestFirst = array_reverse($log);
        foreach ($newestFirst as $entry) {
            echo $entry;
        }
        ?>

      </tbody>
  </table>
</div>

<hr />
