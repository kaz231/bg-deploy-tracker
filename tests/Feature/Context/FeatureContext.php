<?php
namespace Tests\Feature\Context;

use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Symfony2Extension\Context\KernelAwareContext;
use Behat\Symfony2Extension\Context\KernelDictionary;

/**
 * Class FeatureContext
 * @package Tests\Feature\Context
 */
class FeatureContext extends RawMinkContext implements KernelAwareContext
{
    use KernelDictionary;
}
