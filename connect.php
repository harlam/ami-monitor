#!/usr/bin/php
<?php

use App\Core;

require_once __DIR__ . '/src/Config/bootstrap.php';

/**
 * @var \Pimple\Psr11\Container $container
 */
$container = require_once APP_ROOT . '/src/Config/container.php';

$app = new Core($container);

$app->run();

print_r("Connection closed\n");
exit(1);