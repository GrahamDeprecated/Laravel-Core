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

namespace GrahamCampbell\Core;

use Illuminate\Support\ServiceProvider;

/**
 * This is the core service provider class.
 *
 * @package    Laravel-Core
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Core
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('graham-campbell/core', 'graham-campbell/core', __DIR__);

        include __DIR__.'/filters.php';
        include __DIR__.'/listeners.php';

        $this->commands('command.appupdate');
        $this->commands('command.appinstall');
        $this->commands('command.appreset');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUpdateCommand();
        $this->registerInstallCommand();
        $this->registerResetCommand();
        $this->registerCommandSubscriber();
    }

    /**
     * Register the updated command class.
     *
     * @return void
     */
    protected function registerUpdateCommand()
    {
        $this->app->bindShared('command.appupdate', function ($app) {
            $events = $app['events'];

            return new Commands\AppUpdate($events);
        });
    }

    /**
     * Register the install command class.
     *
     * @return void
     */
    protected function registerInstallCommand()
    {
        $this->app->bindShared('command.appinstall', function ($app) {
            $events = $app['events'];

            return new Commands\AppInstall($events);
        });
    }

    /**
     * Register the reset command class.
     *
     * @return void
     */
    protected function registerResetCommand()
    {
        $this->app->bindShared('command.appreset', function ($app) {
            $events = $app['events'];

            return new Commands\AppReset($events);
        });
    }

    /**
     * Register the command subscriber class.
     *
     * @return void
     */
    protected function registerCommandSubscriber()
    {
        $this->app->bindShared('GrahamCampbell\Core\Subscribers\CommandSubscriber', function ($app) {
            $config = $app['config'];
            $crypt = $app['crypt'];

            return new Subscribers\CommandSubscriber($config, $crypt);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array(
            'command.appupdate',
            'command.appinstall',
            'command.appreset'
        );
    }
}
