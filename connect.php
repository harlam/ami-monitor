#!/usr/bin/php
<?php

use PAMI\Client\Impl\ClientImpl;

require_once 'vendor/autoload.php';

/**
 * @var \Pimple\Psr11\Container $container
 */
$container = require_once 'container.php';

/**
 * @var ClientImpl $client
 */
$client = $container->get(ClientImpl::class);

$client->open();

$running = true;

while($running) {
    $client->process();
    usleep(1000);
}

$client->close();
print_r("Connection closed\n");