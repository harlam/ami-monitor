<?php

use App\Handlers\RegisterCallHandler;
use PAMI\Client\Impl\ClientImpl;
use PAMI\Message\Event\DialBeginEvent;
use Pimple\Container;
use Pimple\Psr11\Container as Psr11Container;
use Prometheus\CollectorRegistry;
use Prometheus\Storage\InMemory;

$container = new Container();

/**
 * Asterisk AMI client
 * @param Container $container
 * @return ClientImpl
 */
$container[ClientImpl::class] = function (Container $container) {
    $client = new ClientImpl([
        'host' => getenv('AMI_HOST'),
        'port' => getenv('AMI_PORT'),
        'username' => getenv('AMI_USERNAME'),
        'secret' => getenv('AMI_PASSWORD'),
        'connect_timeout' => getenv('AMI_CONNECTION_TIMEOUT'),
        'read_timeout' => getenv('AMI_READ_TIMEOUT')
    ]);

    $client->registerEventListener($container[RegisterCallHandler::class], function ($event) {
        return $event instanceof DialBeginEvent;
    });

    return $client;
};

/**
 * Регистрация звонка во внешней системе
 * @return RegisterCallHandler
 */
$container[RegisterCallHandler::class] = function () {
    return new RegisterCallHandler(
        getenv('REGISTER_CALL_CALLBACK'),
        getenv('DESTINATION_EXTENSIONS_REGEXP')
    );
};

/**
 * @return CollectorRegistry
 */
$container[CollectorRegistry::class] = function () {
    return new CollectorRegistry(new InMemory());
};

return new Psr11Container($container);