<?php
namespace Tests\Builder\Action;

use Action\Model\Action;
use Action\Model\ActionId;
use Action\Model\ActionName;
use Action\Model\ActionValue;
use Carbon\Carbon;

/**
 * Class ActionBuilder
 * @package tests\Builder\Action
 */
class ActionBuilder
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
     * ActionBuilder constructor.
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
     * @return ActionBuilder
     */
    public static function create()
    {
        return new self(
            ActionId::generate(),
            ActionName::of('download'),
            ActionValue::of('file.xml'),
            Carbon::now()
        );
    }

    /**
     * @param ActionId $actionId
     * @return ActionBuilder
     */
    public function withActionId(ActionId $actionId)
    {
        return new self(
            $actionId,
            $this->name,
            $this->value,
            $this->createdAt
        );
    }

    /**
     * @param ActionName $name
     * @return ActionBuilder
     */
    public function withName(ActionName $name)
    {
        return new self(
            $this->actionId,
            $name,
            $this->value,
            $this->createdAt
        );
    }

    /**
     * @param ActionValue $value
     * @return ActionBuilder
     */
    public function withValue(ActionValue $value)
    {
        return new self(
            $this->actionId,
            $this->name,
            $value,
            $this->createdAt
        );
    }

    /**
     * @param Carbon $createdAt
     * @return ActionBuilder
     */
    public function withCreatedAt(Carbon $createdAt)
    {
        return new self(
            $this->actionId,
            $this->name,
            $this->value,
            $createdAt
        );
    }

    /**
     * @return Action
     */
    public function build()
    {
        if ($this->createdAt) {
            Carbon::setTestNow($this->createdAt);
        }

        $action = Action::register(
            $this->name,
            $this->value
        );

        Carbon::setTestNow();

        if ($this->actionId) {
            $reflection = new \ReflectionObject($action);
            $property = $reflection->getProperty('actionId');
            $property->setAccessible(true);
            $property->setValue($action, $this->actionId->raw());
        }

        return $action;
    }
}
