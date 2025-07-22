<?php $NewTestRequired = null;
$testResults = get_option('td_GT_metrix_test');
if ($testResults) {
    $timeOfTest = $testResults['timeStamp'];

    if ($timeOfTest < (time() - (7 * 24 * 60 * 60))) {
        $NewTestRequired = true;
    }
}

if ($testResults && ($NewTestRequired == false)) {
    echo td_wc_view('gt-metrix-results', array('testResults' => $testResults));
} else { ?>
    <div class="widget_section">
        <h3>Monthly Performance Report</h3>
        <div id="js-generate-report">Loading new performance report... (This may take a couple of minutes).</div>
    </div>
<?php } ?>