<?php

namespace SwooleTW\Http\Tests\Task;

use Illuminate\Support\Str;
use Mockery as m;
use SwooleTW\Http\Helpers\FW;
use SwooleTW\Http\Task\QueueFactory;
use SwooleTW\Http\Tests\TestCase;

/**
 * Class QueueFactoryTest
 *
 * TODO Temporary test - needed abstraction
 */
class QueueFactoryTest extends TestCase
{
    public function testItHasNeededStubByVersion()
    {
        $version = FW::version();

        $search = version_compare($version, '5.7', '>=') ? '5.7' : '5.6';
        $class = QueueFactory::getClass($version);

        $this->assertTrue(Str::contains($class, $search));
    }
}