<?php
namespace Action\Application\Command;

/**
 * Class RegisterAction
 * @package Action\Application\Command
 */
class RegisterAction
{
    /** @var string */
    public $actionName;

    /** @var string */
    public $actionValue;

    /**
     * RegisterAction constructor.
     * @param string $actionName
     * @param string $actionValue
     */
    public function __construct($actionName, $actionValue)
    {
        $this->actionName = $actionName;
        $this->actionValue = $actionValue;
    }
}
