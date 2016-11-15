<?php
namespace TrackerBundle\Message\Bus\Event;

/**
 * Trait RecordsDomainEvents
 * @package TrackerBundle\Message\Bus\Event
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
