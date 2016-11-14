<?php
namespace AppBundle;

use AppBundle\DependencyInjection\TrackerExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class TrackerBundle extends Bundle
{
    /**
     * @inheritdoc
     */
    public function getContainerExtension()
    {
        return new TrackerExtension();
    }
}
