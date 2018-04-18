<h3>WordPress Core Updates</h3>

<table>
  <tbody>
    <th style="text-align: left;">
        Recent Core Updates (<?php echo $count ?>)
        
        <a target="_blank" href="https://www.10degrees.uk/">
          
          <?php td_get_svg('10d-logo.svg'); ?>

        </a>

    </th>

    <?php $newestFirst = array_reverse($log);

    foreach($newestFirst as $entry) {

        echo $entry;

    } ?>

    </tbody>
</table>

<hr />