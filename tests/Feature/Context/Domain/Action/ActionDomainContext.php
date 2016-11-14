<?php
namespace Tests\Feature\Context\Domain\Action;

use Action\Application\Command\RegisterAction;
use Action\Model\ActionWasRecorded;
use Tests\Feature\Context\Domain\DomainContext;

/**
 * Class ActionDomainContext
 * @package Tests\Feature\Context\Domain\Action
 */
class ActionDomainContext extends DomainContext
{
    /** @var string */
    private $actionName;
    /** @var string */
    private $actionValue;

    /**
     * @Given /^I have action name "([^"]*)"$/
     * @param string $actionName
     */
    public function iHaveActionName($actionName)
    {
        $this->actionName = $actionName;
    }

    /**
     * @Given /^I have action value "([^"]*)"$/
     * @param string $actionValue
     */
    public function iHaveActionValue($actionValue)
    {
        $this->actionValue = $actionValue;
    }

    /**
     * @When /^I'm registering a new action$/
     */
    public function iMRegisteringANewAction()
    {
        $this->handleCommand(new RegisterAction($this->actionName, $this->actionValue));
    }

    /**
     * @Then /^I should be notified that new action was recorded$/
     */
    public function iShouldBeNotifiedThatNewActionWasRecorded()
    {
        $this->expectsEvent(ActionWasRecorded::class);
    }
}
