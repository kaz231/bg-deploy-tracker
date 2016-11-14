<?php
namespace Tests\Feature\Context\Domain;

use Tests\Feature\Context\Dictionary\CommandBusDictionary;
use Tests\Feature\Context\FeatureContext;

/**
 * Class DomainContext
 * @package Tests\Feature\Context\Domain
 */
class DomainContext extends FeatureContext
{
    use CommandBusDictionary;

    /**
     * @BeforeScenario
     * @catch-exception
     */
    public function enableCatchesExceptionMiddleware()
    {
        $this->enableCatchingExceptions();
    }

    /**
     * @AfterScenario
     * @catch-exception
     */
    public function throwExceptionIfHaveNotReleased()
    {
        $this->disableCatchingExceptions();
        if (null === $exception = $this->caughtException()) {
            return;
        }

        throw $exception;
    }
}
