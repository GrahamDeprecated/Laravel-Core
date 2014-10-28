<?php

/**
 * This file is part of Laravel Core by Graham Campbell.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at http://bit.ly/UWsjkb.
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace GrahamCampbell\Tests\Core\Subscribers;

use GrahamCampbell\Core\Subscribers\CommandSubscriber;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;

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
        $this->assertEmpty($this->callCommand('migrate:reset', 'onResetMigrations'));
    }

    public function testRunMigrations()
    {
        $this->assertEmpty($this->callCommand('migrate', 'onRunMigrations'));
    }

    public function testRunSeeding()
    {
        $this->assertEmpty($this->callCommand('db:seed', 'onRunSeeding'));
    }

    protected function callCommand($name, $method)
    {
        $subscriber = $this->getSubscriber();
        $command = $this->getCommand();

        $command->shouldReceive('call')->once()->with($name, ['--force' => true]);

        $subscriber->$method($command);
    }

    protected function getSubscriber()
    {
        $config = Mockery::mock('Illuminate\Contracts\Config\Repository');
        $crypt = Mockery::mock('Illuminate\Contracts\Encryption\Encrypter');

        return new CommandSubscriber($config, $crypt);
    }

    protected function getCommand()
    {
        return Mockery::mock('Illuminate\Console\Command');
    }
}
