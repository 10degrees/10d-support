<?php
require_once __DIR__ . '/../plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$UpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/10degrees/10d-wordcare-report',
    __DIR__ . '/../10d-support-report.php',
    '10d-support-report'
);

$UpdateChecker->setBranch('master');

$UpdateChecker->getVcsApi()->setAuthentication('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');
