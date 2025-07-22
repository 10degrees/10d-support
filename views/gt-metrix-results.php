<div class="widget_section">
    <h3>Monthly Performance Report</h3>
    <ul>
        <li>
            Date of last test: <?php echo date("d F Y", $testResults['timeStamp']); ?>
        </li>

        <?php
        $score = $testResults['pagespeedScore'];
        if ($score >= 80) {
            $scoreClass = 'td-score--green';
        } elseif ($score >= 51) {
            $scoreClass = 'td-score--amber';
        } else {
            $scoreClass = 'td-score--red';
        }
        ?>
        <li>
            PageSpeed score: <span class="<?php echo esc_attr($scoreClass); ?>"><?php echo $score; ?>%</span>
        </li>

        <?php
        $loadTime = $testResults['fullyLoadedTime'] / 1000;
        if ($loadTime <= 2) {
            $loadClass = 'td-score--green';
        } elseif ($loadTime <= 4) {
            $loadClass = 'td-score--amber';
        } else {
            $loadClass = 'td-score--red';
        }
        ?>
        <li>
            Fully loaded time: <span class="<?php echo esc_attr($loadClass); ?>"><?php echo round($loadTime, 1); ?> seconds</span>
        </li>
    </ul>

    <p class="submit">
        <a class="button button-primary" target="_blank" href="<?php echo esc_url($testResults['reportUrl']); ?>">View full report</a>
    </p>
</div>