<?php

namespace App\Handlers;

use Exception;
use PAMI\Listener\IEventListener;
use PAMI\Message\Event\DialBeginEvent;
use PAMI\Message\Event\EventMessage;

/**
 * Регистрация звонка во внешней системе
 * @package App\Handlers
 */
class RegisterCallHandler implements IEventListener
{
    private $callback;
    private $regexp;

    /**
     * RegisterCallHandler constructor.
     * @param string $callback
     * @param string $regexp
     */
    public function __construct(string $callback, string $regexp)
    {
        $this->callback = $callback;
        $this->regexp = $regexp;
    }

    /**
     * Event handler.
     *
     * @param \PAMI\Message\Event\EventMessage $message The received event.
     * @return void
     * @throws Exception
     */
    public function handle(EventMessage $message)
    {
        /** @var DialBeginEvent $message */
        if (preg_match($this->regexp, $message->getDestCallerIDNum()) < 1) {
            return;
        }

        $options = [
            'http' => [
                'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                'method' => 'POST',
                'content' => http_build_query([
                    'uid' => $message->getUniqueid(),
                    'a_number' => $message->getCallerIDNum(),
                    'b_number' => $message->getConnectedLineNum(),
                    'destination_cid' => $message->getDestCallerIDNum(),
                ])
            ]
        ];

        $context = stream_context_create($options);

        $result = file_get_contents($this->callback, false, $context);

        if ($result === false) {
            throw new Exception("Call uid = '{$message->getUniqueid()}' registration error");
        }
    }
}