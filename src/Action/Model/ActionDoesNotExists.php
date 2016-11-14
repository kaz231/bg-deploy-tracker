<?php
namespace Action\Model;

/**
 * Class ActionDoesNotExists
 * @package Action\Model
 */
class ActionDoesNotExists extends \DomainException
{
    /**
     * @param ActionId $actionId
     * @return ActionDoesNotExists
     */
    public static function withActionId(ActionId $actionId)
    {
        return new self(sprintf('Action with actionId "%s" does not exist.', $actionId));
    }
}
