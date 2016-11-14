<?php
namespace tests\Integration\Action\Infrastructure;

use Action\Infrastructure\Persistence\ORMActionRepository;
use Action\Model\ActionId;
use Tests\Builder\Action\ActionBuilder;
use Tests\TestCase\TransactionalTestCase;

/**
 * Class ORMActionRepositoryTest
 * @package tests\Integration\Action\Infrastructure
 */
class ORMActionRepositoryTest extends TransactionalTestCase
{
    /** @var ORMActionRepository */
    private $repository;

    protected function setUp()
    {
        parent::setUp();

        $this->repository = $this->getContainer()->get('tracker.repository.action.orm');
    }

    public function testGettingOfActionByActionId()
    {
        $actionA = ActionBuilder::create()->build();
        $actionB = ActionBuilder::create()->build();

        $this->repository->add($actionA);
        $this->repository->add($actionB);

        $this->flushAndClear();

        $action = $this->repository->get($actionA->id());

        $this->assertEquals($actionA->id(), $action->id());
    }

    /**
     * @expectedException \Action\Model\ActionDoesNotExists
     */
    public function testThrowingOfExceptionWhenActionOfGivenActionIdDoesNotExist()
    {
        $this->repository->get(ActionId::generate());
    }
}
