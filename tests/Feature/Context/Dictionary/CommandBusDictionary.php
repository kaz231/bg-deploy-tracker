<?php
namespace Tests\Feature\Context\Dictionary;

use AppBundle\Message\Bus\Middleware\CatchesExceptionMiddleware;
use AppBundle\Message\Bus\Middleware\CollectsEventMiddleware;
use Carbon\Carbon;
use SimpleBus\Message\Bus\MessageBus;

/**
 * Trait CommandBusDictionary
 * @package Tests\Feature\Context\Dictionary
 */
trait CommandBusDictionary
{
    /**
     * @param object $command
     */
    protected function handleCommand($command)
    {
        $this->commandBus()->handle($command);
    }

    /**
     * @param object $command
     * @param \DateTime $at
     */
    protected function handleCommandAt($command, \DateTime $at)
    {
        Carbon::setTestNow($at);
        $this->handleCommand($command);
        Carbon::setTestNow();
    }

    /**
     * @param $eventClass
     */
    protected function expectsEvent($eventClass)
    {
        $expectedEvents = $this->lastRecordedEventsOf($eventClass);
        if (count($expectedEvents) > 0) {
            return;
        }
        \PHPUnit_Framework_Assert::fail(sprintf('Event "%s" has not been recorded', $eventClass));
    }

    protected function expectsNoEvents()
    {
        \PHPUnit_Framework_Assert::assertCount(0, $this->recordedEvents(), 'Expected no recorded events');
    }

    /**
     * @param $eventClass
     */
    protected function expectsNoEventsOf($eventClass)
    {
        \PHPUnit_Framework_Assert::assertNull(
            $this->lastRecordedEventsOf($eventClass),
            sprintf('Expected no recorded events of "%s"', $eventClass)
        );
    }

    /**
     * @param $exceptionClass
     */
    protected function expectsException($exceptionClass)
    {
        \PHPUnit_Framework_Assert::assertInstanceOf(
            $exceptionClass,
            $this->caughtException(),
            sprintf('Exception "%s" has not been thrown', $exceptionClass)
        );
    }
    /**
     * @return \Exception
     */
    protected function caughtException()
    {
        return $this->catchesExceptionMiddleware()->releaseException();
    }

    protected function enableCatchingExceptions()
    {
        $this->catchesExceptionMiddleware()->enableCatching();
    }

    protected function disableCatchingExceptions()
    {
        $this->catchesExceptionMiddleware()->disableCatching();
    }

    /**
     * @return mixed
     */
    protected function recordedEvents()
    {
        return $this->collectsEventMiddleware()->events();
    }
    /**
     * @param string $eventClass
     *
     * @return mixed
     */
    protected function lastRecordedEventsOf($eventClass)
    {
        $expectedEvents = array_filter($this->recordedEvents(), function ($event) use ($eventClass) {
            return $event instanceof $eventClass;
        });
        $lastEvent = end($expectedEvents);
        return ($lastEvent) ?: null;
    }

    /**
     * @return MessageBus
     */
    private function commandBus()
    {
        return $this->getContainer()->get('command_bus');
    }

    /**
     * @return CollectsEventMiddleware
     */
    private function collectsEventMiddleware()
    {
        return $this->getContainer()->get('tracker.message_bus.collects_events');
    }

    /**
     * @return CatchesExceptionMiddleware
     */
    private function catchesExceptionMiddleware()
    {
        return $this->getContainer()->get('tracker.message_bus.catches_exceptions');
    }
}
