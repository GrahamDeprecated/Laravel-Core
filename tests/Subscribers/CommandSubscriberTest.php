<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Core\Subscribers;

use GrahamCampbell\Core\Subscribers\CommandSubscriber;
use GrahamCampbell\TestBench\AbstractTestCase;
use Mockery;

/**
 * This is the command command test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CommandSubscriberTest extends AbstractTestCase
{
    public function testResetMigrations()
    {
        $this->assertEmpty($this->callCommand('migrate:reset', 'onResetMigrations'));
        $this->assertEmpty($this->callCommand('migrate:reset', 'onResetMigrations', true));
    }

    public function testRunMigrations()
    {
        $this->assertEmpty($this->callCommand('migrate', 'onRunMigrations'));
        $this->assertEmpty($this->callCommand('migrate', 'onRunMigrations', true));
    }

    public function testRunSeeding()
    {
        $this->assertEmpty($this->callCommand('db:seed', 'onRunSeeding'));
        $this->assertEmpty($this->callCommand('db:seed', 'onRunSeeding', true));
    }

    protected function callCommand($name, $method, $force = false)
    {
        $subscriber = $this->getSubscriber($force);
        $command = $this->getCommand();

        if ($force) {
            $command->shouldReceive('call')->once()->with($name, ['--force' => true]);
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
