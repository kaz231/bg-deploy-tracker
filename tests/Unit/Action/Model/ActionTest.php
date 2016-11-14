<?php
namespace tests\Unit\Action\Model;

use Action\Model\Action;
use Action\Model\ActionName;
use Action\Model\ActionValue;
use Carbon\Carbon;

/**
 * Class ActionTest
 * @package tests\Unit\Action\Model
 */
class ActionTest extends \PHPUnit_Framework_TestCase
{
    public function testRegisteringOfAction()
    {
        $createdAt = Carbon::createFromFormat('Y-m-d H:i:s', '2016-01-01 10:00:00');

        Carbon::setTestNow($createdAt);
        $action = Action::register(
            ActionName::of('download'),
            ActionValue::of('file.xml')
        );
        Carbon::setTestNow();

        $this->assertEquals($createdAt, $action->createdAt());
        $this->assertEquals('download', (string) $action->name());
        $this->assertEquals('file.xml', (string) $action->value());
        $this->assertNotNull($action->id());
    }
}
