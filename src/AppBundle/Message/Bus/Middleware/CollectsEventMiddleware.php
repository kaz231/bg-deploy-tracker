<?php
namespace AppBundle\Message\Bus\Middleware;

use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

/**
 * Class CollectsEventMiddleware
 * @package AppBundle\Message\Bus\Middleware
 */
class CollectsEventMiddleware implements MessageBusMiddleware
{
    /** @var object[] */
    private $events = [];

    /**
     * {@inheritdoc}
     */
    public function handle($event, callable $next)
    {
        $this->collect($event);
        $next($event);
    }

    /**
     * @return object[]
     */
    public function events()
    {
        return $this->events;
    }

    /**
     * @param object $event
     */
    private function collect($event)
    {
        $this->events[] = $event;
    }
}
