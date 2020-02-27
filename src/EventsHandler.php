<?php

namespace App;

use PAMI\Listener\IEventListener;
use PAMI\Message\Event\AgentConnectEvent;
use PAMI\Message\Event\AgentloginEvent;
use PAMI\Message\Event\AgentlogoffEvent;
use PAMI\Message\Event\AgentsEvent;
use PAMI\Message\Event\DialBeginEvent;
use PAMI\Message\Event\DialEvent;
use PAMI\Message\Event\EventMessage;
use PAMI\Message\Event\ExtensionStatusEvent;
use PAMI\Message\Event\PeerStatusEvent;
use PAMI\Message\Event\RegistryEvent;

class EventsHandler implements IEventListener
{
    /**
     * Event handler.
     *
     * @param EventMessage $event The received event.
     *
     * @return void
     */
    public function handle(EventMessage $event)
    {
        if ($event instanceof ExtensionStatusEvent) {
            /** @var ExtensionStatusEvent $event */
            var_dump("EXTENSION EVENT");
            var_dump($event->getExtension() . ' : ' . $event->getStatus());
        }

        if ($event instanceof DialBeginEvent) {
            /** @var DialBeginEvent $event */
            var_dump("DIAL EVENT");
            var_dump($event);
        }
    }
}