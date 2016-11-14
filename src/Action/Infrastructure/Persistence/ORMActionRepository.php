<?php
namespace Action\Infrastructure\Persistence;

use Action\Model\Action;
use Action\Model\ActionDoesNotExists;
use Action\Model\ActionId;
use Action\Model\ActionRepository;
use Doctrine\ORM\EntityRepository;

/**
 * Class ORMActionRepository
 * @package Action\Infrastructure\Persistence
 */
class ORMActionRepository extends EntityRepository implements ActionRepository
{
    /**
     * @inheritdoc
     */
    public function add(Action $action)
    {
        $this->getEntityManager()->persist($action);
    }

    /**
     * @param ActionId $actionId
     * @return Action
     */
    public function get(ActionId $actionId)
    {
        /** @var Action $action */
        $action = $this->findOneBy(['actionId' => $actionId->raw()]);

        if (null === $action) {
            throw ActionDoesNotExists::withActionId($actionId);
        }

        return $action;
    }
}
