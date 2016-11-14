<?php
namespace AppBundle\Message\Bus\Event;

/**
 * Trait RecordsDomainEvents
 * @package AppBundle\Message\Bus\Event
 */
trait RecordsDomainEvents
{
    /**
     * @param object $event
     */
    public function record($event)
    {
        DomainEventsCollection::instance()->record($event);
    }
}
