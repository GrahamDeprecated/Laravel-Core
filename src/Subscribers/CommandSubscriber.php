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

namespace GrahamCampbell\Core\Subscribers;

use Illuminate\Console\Command;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Crypt;

/**
 * This is the command subscriber class.
 *
 * @package    Laravel-Core
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Core
 */
class CommandSubscriber
{
    /**
     * Register the listeners for the subscriber.
     *
     * @param  \Illuminate\Events\Dispatcher  $events
     * @return array
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen('command.genappkey', 'GrahamCampbell\Core\Subscribers\CommandSubscriber@onGenAppKey', 5);
        $events->listen('command.resetmigrations', 'GrahamCampbell\Core\Subscribers\CommandSubscriber@onResetMigrations', 5);
        $events->listen('command.runmigrations', 'GrahamCampbell\Core\Subscribers\CommandSubscriber@onRunMigrations', 5);
        $events->listen('command.runseeding', 'GrahamCampbell\Core\Subscribers\CommandSubscriber@onRunSeeding', 5);
        $events->listen('command.updatecache', 'GrahamCampbell\Core\Subscribers\CommandSubscriber@onUpdateCache', 5);
        $events->listen('command.genassets', 'GrahamCampbell\Core\Subscribers\CommandSubscriber@onGenAssets', 5);
    }

    /**
     * Handle a command.genappkey event.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public function onGenAppKey(Command $command)
    {
        $command->call('key:generate');
        Crypt::setKey(Config::get('app.key'));
    }

    /**
     * Handle a command.resetmigrations event.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public function onResetMigrations(Command $command)
    {
        $command->call('migrate:reset');
    }

    /**
     * Handle a command.runmigrations event.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public function onRunMigrations(Command $command)
    {
        $command->call('migrate');
    }

    /**
     * Handle a command.runseeding event.
     *
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public function onRunSeeding(Command $command)
    {
        $command->call('db:seed');
    }

    /**
     * Handle a command.updatecache event.
     *
     * @param  \Illuminate\Console\Command  $command
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
     * @param  \Illuminate\Console\Command  $command
     * @return void
     */
    public function onGenAssets(Command $command)
    {
        if (class_exists('Barryvdh\Debugbar\Console\PublishCommand')) {
            $command->line('Publishing assets...');
            $command->call('debugbar:publish');
            $command->info('Assets published!');
        }

        if (class_exists('Lightgear\Asset\Commands\Generate')) {
            $command->line('Building assets...');
            $command->call('asset:generate');
            $command->info('Assets built!');
        }
    }
}
