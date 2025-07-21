<?php
require_once plugin_dir_path(__FILE__) . 'plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$myUpdateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/10degrees/10d-wordcare-report',
    __FILE__,
    '10d-support-report'
);

$updateChecker->setBranch('master');

$updateChecker->getVcsApi()->setAuthentication('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');
