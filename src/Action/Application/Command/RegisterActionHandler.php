<?php
namespace Action\Application\Command;

use Action\Model\Action;
use Action\Model\ActionName;
use Action\Model\ActionRepository;
use Action\Model\ActionValue;

/**
 * Class RegisterActionHandler
 * @package Action\Application\Command
 */
class RegisterActionHandler
{
    /** @var ActionRepository */
    private $actions;

    /**
     * RegisterActionHandler constructor.
     * @param ActionRepository $actions
     */
    public function __construct(ActionRepository $actions)
    {
        $this->actions = $actions;
    }

    /**
     * @param RegisterAction $command
     */
    public function handle(RegisterAction $command)
    {
        $action = Action::register(
            ActionName::of($command->actionName),
            ActionValue::of($command->actionValue)
        );

        $this->actions->add($action);
    }
}
