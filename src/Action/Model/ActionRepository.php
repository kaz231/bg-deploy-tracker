<?php
namespace Action\Model;

/**
 * Interface ActionRepository
 * @package Action\Model
 */
interface ActionRepository
{
    /**
     * @param Action $action
     */
    public function add(Action $action);

    /**
     * @param ActionId $actionId
     * @return Action
     * @throws ActionDoesNotExists
     */
    public function get(ActionId $actionId);
}
