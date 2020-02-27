<?php

use App\EventsHandler;
use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Prometheus\CollectorRegistry;
use Prometheus\Storage\InMemory;

$container = new Container();

/**
 * @return EventsHandler Обработчик event'a
 */
$container[EventsHandler::class] = function () {
    return new EventsHandler();
};

/**
 * @return CollectorRegistry
 */
$container[CollectorRegistry::class] = function () {
    return new CollectorRegistry(new InMemory());
};

return new Psr11Container($container);