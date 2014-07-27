<?php

/**
 * This file is part of Laravel Core by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Tests\Core\Subscribers;

use Mockery;
use GrahamCampbell\Core\Subscribers\CommandSubscriber;
use GrahamCampbell\TestBench\AbstractTestCase;

/**
 * This is the command command test class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md> Apache 2.0
 */
class CommandSubscriberTest extends AbstractTestCase
{
    public function testResetMigrations()
    {
        $this->callCommand('migrate:reset', 'onResetMigrations');
        $this->callCommand('migrate:reset', 'onResetMigrations', true);
    }

    public function testRunMigrations()
    {
        $this->callCommand('migrate', 'onRunMigrations');
        $this->callCommand('migrate', 'onRunMigrations', true);
    }

    public function testRunSeeding()
    {
        $this->callCommand('db:seed', 'onRunSeeding');
        $this->callCommand('db:seed', 'onRunSeeding', true);
    }

    protected function callCommand($name, $method, $force = false)
    {
        $subscriber = $this->getSubscriber($force);
        $command = $this->getCommand();

        if ($force) {
            $command->shouldReceive('call')->once()->with($name, array('--force' => true));
        } else {
            $command->shouldReceive('call')->once()->with($name);
        }

        $subscriber->$method($command);
    }

    protected function getSubscriber($force)
    {
        $config = Mockery::mock('Illuminate\Config\Repository');
        $crypt = Mockery::mock('Illuminate\Encryption\Encrypter');

        return new CommandSubscriber($config, $crypt, $force);
    }

    protected function getCommand()
    {
        return Mockery::mock('Illuminate\Console\Command');
    }
}
