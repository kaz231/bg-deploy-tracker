<?php
namespace TrackerBundle\Message\Bus\Event;

use SimpleBus\Message\Recorder\ContainsRecordedMessages;

/**
 * Class DomainEventsCollection
 * @package TrackerBundle\Message\Bus\Event
 */
final class DomainEventsCollection implements ContainsRecordedMessages
{
    /** @var self */
    private static $instance;

    /** @var object[] */
    private $events = [];

    /** @var bool */
    private $recording = false;

    private function __construct()
    {
    }

    /**
     * @return static
     */
    public static function instance()
    {
        if (null === self::$instance) {
            self::$instance = new static();
        }
        return self::$instance;
    }

    /**
     * @param object $event
     */
    public function record($event)
    {
        if (!$this->recording) {
            return;
        }
        $this->events[] = $event;
    }

    public function enableRecording()
    {
        $this->recording = true;
    }

    public function disableRecording()
    {
        $this->recording = false;
    }

    /**
     * {@inheritdoc}
     */
    public function recordedMessages()
    {
        return $this->events;
    }

    /**
     * {@inheritdoc}
     */
    public function eraseMessages()
    {
        $this->events = [];
    }
}
