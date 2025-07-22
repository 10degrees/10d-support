<?php
require_once __DIR__ . '/../plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$UpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/10degrees/10d-support',
    TEND_PLUGIN_PATH . '10d-support-report.php',
    '10d-support-report'
);

$UpdateChecker->setBranch('master');
