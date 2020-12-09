<?php

namespace App;

use Exception;
use PAMI\Client\Exception\ClientException;
use PAMI\Client\Impl\ClientImpl;
use Psr\Container\ContainerInterface;

/**
 * Class Core
 * @package App
 */
class Core
{
    public static $container;

    public function __construct(ContainerInterface $container)
    {
        self::$container = $container;
    }

    public function run(): void
    {
        /** @var ClientImpl $client */
        $client = self::$container->get(ClientImpl::class);

        $client->open();

        $running = true;

        while ($running) {
            try {
                $client->process();
                usleep(1000);
            } catch (ClientException $clientException) {
                $client->close();
                sleep(5);
                $client->open();
            } catch (Exception $exception) {
                print_r("{$exception->getMessage()}, File: {$exception->getFile()}, Line: {$exception->getLine()}\n");
            }
        }

        $client->close();
    }
}