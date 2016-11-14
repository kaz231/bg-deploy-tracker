<?php
namespace Tests\TestCase;

use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class TransactionalTestCase
 * @package tests\TestCase
 */
abstract class TransactionalTestCase extends WebTestCase
{
    /** @var EntityManager */
    protected $entityManager;

    /** @var ContainerInterface */
    protected $container;

    protected function setUp()
    {
        parent::setUp();

        $this->container = self::createClient()->getContainer();
        $this->entityManager = $this->container->get('doctrine.orm.entity_manager');
        $this->entityManager->beginTransaction();
    }

    protected function tearDown()
    {
        $this->entityManager->rollback();
        parent::tearDown();
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    protected function flush()
    {
        $this->entityManager->flush();
    }

    protected function flushAndClear()
    {
        $this->entityManager->flush();
        $this->entityManager->clear();
    }

    /**
     * @param $object
     */
    protected function persist($object)
    {
        $this->entityManager->persist($object);
    }
}
