<ul>
    <li>
        Date of last test: <?php echo date("d F Y", $testResults['timeStamp']); ?>
    </li>
    <li>
        PageSpeed Score: <?php echo $testResults['pagespeedScore']; ?>%
    </li>
    <li>
        <?php $loadTime = ($testResults['fullyLoadedTime'] / 1000);  ?>
    </li>
    <li>
        Fully Loaded Time: <?php echo round($loadTime , 1); ?> seconds
    </li>
</ul>

<p>
    <a class="button button-primary" target="_blank" href="<?php echo $testResults['reportUrl']; ?>">View Full Report</a>
</p>
