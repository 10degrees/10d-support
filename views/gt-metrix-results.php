<div class="widget_section">
    <h3>Monthly Performance Report</h3>
    <ul>
        <li>
            Date of last test: <?php echo date("d F Y", $testResults['timeStamp']); ?>
        </li>
        <li>
            PageSpeed score: <?php echo $testResults['pagespeedScore']; ?>%
        </li>
        <li>
            <?php $loadTime = ($testResults['fullyLoadedTime'] / 1000);  ?>
        </li>
        <li>
            Fully loaded time: <?php echo round($loadTime, 1); ?> seconds
        </li>
    </ul>

    <p class="submit">
        <a class="button button-primary" target="_blank" href="<?php echo $testResults['reportUrl']; ?>">View full report</a>
    </p>
</div>