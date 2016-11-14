<?php
namespace Action\Model;

use Carbon\Carbon;

/**
 * Class ActionWasRecorded
 * @package Action\Model
 */
class ActionWasRecorded
{
    /** @var ActionId */
    private $actionId;

    /** @var ActionName */
    private $name;

    /** @var ActionValue */
    private $value;

    /** @var Carbon */
    private $createdAt;

    /**
     * ActionWasRecorded constructor.
     * @param ActionId $actionId
     * @param ActionName $name
     * @param ActionValue $value
     * @param Carbon $createdAt
     */
    public function __construct(ActionId $actionId, ActionName $name, ActionValue $value, Carbon $createdAt)
    {
        $this->actionId = $actionId;
        $this->name = $name;
        $this->value = $value;
        $this->createdAt = $createdAt;
    }

    /**
     * @return ActionId
     */
    public function getActionId()
    {
        return $this->actionId;
    }

    /**
     * @return ActionName
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return ActionValue
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Carbon
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
