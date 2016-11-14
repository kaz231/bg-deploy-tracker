<?php
namespace Tests\Feature\Context;

use Doctrine\Common\DataFixtures\Purger\ORMPurger;

/**
 * Class DatabaseContext
 * @package Tests\Feature\Context
 */
class DatabaseContext extends FeatureContext
{
    /**
     * @AfterScenario
     */
    public function purgeDatabase()
    {
        $purger = new ORMPurger($this->getContainer()->get('doctrine.orm.entity_manager'));
        $purger->purge();
    }
}
