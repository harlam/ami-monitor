<?php

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;

require_once '../src/Config/bootstrap.php';

/**
 * @var \Pimple\Psr11\Container $container
 */
$container = require_once APP_ROOT . '/src/Config/container.php';

/**
 * @var CollectorRegistry $registry
 */
$registry = $container->get(CollectorRegistry::class);

echo (new RenderTextFormat())
    ->render($registry->getMetricFamilySamples());
