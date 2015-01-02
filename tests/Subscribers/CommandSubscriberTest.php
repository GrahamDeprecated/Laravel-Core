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
