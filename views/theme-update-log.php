<div class="widget_section">
    <h3>Theme updates</h3>

    <div class="table-holder">
        <table class="theme-update-table">
            <tbody>
                <th style="text-align: left;">Month</th>
                <th style="text-align: left;">Update (<?php echo $count; ?>)

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
</div>