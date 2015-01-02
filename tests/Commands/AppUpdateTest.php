<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Core\Commands;

use GrahamCampbell\Core\Commands\AppUpdate;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;

/**
 * This is the app update test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class AppUpdateTest extends AbstractTestCase
{
    public function testFire()
    {
        $command = $this->getCommand();

        $command->getEvents()->shouldReceive('fire')->once()->with('command.runmigrations', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.updatecache', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.genassets', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.extrastuff', $command);

        $this->assertEmpty($command->fire());
    }

    protected function getCommand()
    {
        $events = Mockery::mock('Illuminate\Events\Dispatcher');

        return new AppUpdate($events);
    }
}
