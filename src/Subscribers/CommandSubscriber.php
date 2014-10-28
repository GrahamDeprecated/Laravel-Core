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

namespace GrahamCampbell\Core\Subscribers;

use Illuminate\Console\Command;
use Illuminate\Contracts\Config\Repository;
use Illuminate\Contracts\Encryption\Encrypter;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * This is the command subscriber class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md> Apache 2.0
 */
class CommandSubscriber
{
    /**
     * The config instance.
     *
     * @var \Illuminate\Contracts\Config\Repository
     */
    protected $config;

    /**
     * The encryption instance.
     *
     * @var \Illuminate\Contracts\Encryption\Encrypter
     */
    protected $crypt;

    /**
     * The assets flag.
     *
     * @var bool
     */
    protected $assets;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Contracts\Config\Repository    $config
     * @param \Illuminate\Contracts\Encryption\Encrypter $crypt
     * @param bool                                       $assets
     *
     * @return void
     */
    public function __construct(Repository $config, Encrypter $crypt, $assets = false)
    {
        $this->config = $config;
        $this->crypt = $crypt;
        $this->assets = $assets;
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(
            'command.genappkey',
            'GrahamCampbell\Core\Subscribers\CommandSubscriber@onGenAppKey',
            5
        );
        $events->listen(
            'command.resetmigrations',
            'GrahamCampbell\Core\Subscribers\CommandSubscriber@onResetMigrations',
            5
        );
        $events->listen(
            'command.runmigrations',
            'GrahamCampbell\Core\Subscribers\CommandSubscriber@onRunMigrations',
            5
        );
        $events->listen(
            'command.runseeding',
            'GrahamCampbell\Core\Subscribers\CommandSubscriber@onRunSeeding',
            5
        );
        $events->listen(
            'command.updatecache',
            'GrahamCampbell\Core\Subscribers\CommandSubscriber@onUpdateCache',
            5
        );
        $events->listen(
            'command.genassets',
            'GrahamCampbell\Core\Subscribers\CommandSubscriber@onGenAssets',
            5
        );
    }

    /**
     * Handle a command.genappkey event.
     *
     * @param \Illuminate\Console\Command $command
     *
     * @return void
     */
    public function onGenAppKey(Command $command)
    {
        $command->call('key:generate');
        $this->crypt->setKey($this->config->get('app.key'));
    }

    /**
     * Handle a command.resetmigrations event.
     *
     * @param \Illuminate\Console\Command $command
     *
     * @return void
     */
    public function onResetMigrations(Command $command)
    {
        $command->call('migrate:reset', ['--force' => true]);
    }

    /**
     * Handle a command.runmigrations event.
     *
     * @param \Illuminate\Console\Command $command
     *
     * @return void
     */
    public function onRunMigrations(Command $command)
    {
        $command->call('migrate', ['--force' => true]);
    }

    /**
     * Handle a command.runseeding event.
     *
     * @param \Illuminate\Console\Command $command
     *
     * @return void
     */
    public function onRunSeeding(Command $command)
    {
        $command->call('db:seed', ['--force' => true]);
    }

    /**
     * Handle a command.updatecache event.
     *
     * @param \Illuminate\Console\Command $command
     *
     * @return void
     */
    public function onUpdateCache(Command $command)
    {
        $command->line('Clearing cache...');
        $command->call('cache:clear');
        $command->info('Cache cleared!');
    }

    /**
     * Handle a command.genassets event.
     *
     * @param \Illuminate\Console\Command $command
     *
     * @return void
     */
    public function onGenAssets(Command $command)
    {
        if ($this->assets) {
            $command->line('Building assets...');
            $command->call('asset:generate');
            $command->info('Assets built!');
        }
    }
}
