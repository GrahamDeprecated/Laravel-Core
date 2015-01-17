<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Core\Console\Commands;

use GrahamCampbell\Core\Console\Commands\AppInstall;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;

/**
 * This is the app install test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class AppInstallTest extends AbstractTestCase
{
    public function testFire()
    {
        $command = $this->getCommand();

        $command->getEvents()->shouldReceive('fire')->once()->with('command.genappkey', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.runmigrations', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.runseeding', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.updatecache', $command);
        $command->getEvents()->shouldReceive('fire')->once()->with('command.extrastuff', $command);

        $this->assertEmpty($command->fire());
    }

    protected function getCommand()
    {
        $events = Mockery::mock('Illuminate\Contracts\Events\Dispatcher');

        return new AppInstall($events);
    }
}
