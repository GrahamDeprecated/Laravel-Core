<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Core\Console\Commands;

use GrahamCampbell\Core\Console\Commands\AppUpdate;
use GrahamCampbell\TestBench\AbstractTestCase;
use Illuminate\Contracts\Events\Dispatcher;
use Mockery;

/**
 * This is the app update test class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class AppUpdateTest extends AbstractTestCase
{
    public function testFire()
    {
        $command = $this->getCommand();

        $command->getEvents()->shouldReceive('fire')->once()->with('command.updating', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.publishvendors', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.runmigrations', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.updatecache', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.extrastuff', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.updated', $command);

        $this->assertEmpty($command->handle());
    }

    protected function getCommand()
    {
        $events = Mockery::mock(Dispatcher::class);

        return new AppUpdate($events);
    }
}
