<?php
namespace AppBundle\Message\Bus\Middleware;

use AppBundle\Message\Bus\Event\DomainEventsCollection;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

/**
 * Class DomainEventsMiddleware
 * @package AppBundle\Message\Bus\Middleware
 */
class DomainEventsMiddleware implements MessageBusMiddleware
{
    /** @var DomainEventsCollection */
    private $domainEventsCollection;

    /**
     * DomainEventsMiddleware constructor.
     * @param DomainEventsCollection $domainEventsCollection
     */
    public function __construct(
        DomainEventsCollection $domainEventsCollection
    ) {
        $this->domainEventsCollection = $domainEventsCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function handle($message, callable $next)
    {
        $this->domainEventsCollection->enableRecording();

        try {
            $next($message);
        } catch (\Exception $e) {
            $this->domainEventsCollection->disableRecording();
            throw $e;
        }

        $this->domainEventsCollection->disableRecording();
    }
}
