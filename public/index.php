<?php

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;

require_once '../vendor/autoload.php';

/**
 * @var \Pimple\Psr11\Container $container
 */
$container = require_once '../container.php';

/**
 * @var CollectorRegistry $registry
 */
$registry = $container->get(CollectorRegistry::class);

echo (new RenderTextFormat())
    ->render($registry->getMetricFamilySamples());
