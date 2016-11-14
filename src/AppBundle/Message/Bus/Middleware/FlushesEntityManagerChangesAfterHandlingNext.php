<?php
namespace AppBundle\Message\Bus\Middleware;

use Doctrine\ORM\EntityManager;
use SimpleBus\Message\Bus\Middleware\MessageBusMiddleware;

/**
 * Class FlushesEntityManagerChangesAfterHandlingNext
 * @package AppBundle\Message\Bus\Middleware
 */
class FlushesEntityManagerChangesAfterHandlingNext implements MessageBusMiddleware
{
    /** @var EntityManager */
    private $entityManager;

    /**
     * FlushesEntityManagerChangesAfterHandlingNext constructor.
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritdoc
     */
    public function handle($message, callable $next)
    {
        $next($message);

        $this->entityManager->flush();
    }
}
