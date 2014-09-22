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

namespace GrahamCampbell\Core;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

/**
 * This is the core service provider class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md> Apache 2.0
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

        if ($this->app['config']['graham-campbell/core::commands']) {
            $this->commands('command.appupdate', 'command.appinstall', 'command.appreset');
        }

        if ($this->app->bound('html')) {
            $this->setupMacros();

        }

        $this->setupFilters();
        $this->setupListeners();
    }

    /**
     * Setup the html macros.
     *
     * @return void
     */
    protected function setupMacros()
    {
        $this->app['html']->macro('ago', function (Carbon $carbon, $id = null) {
            if ($id) {
                return '<abbr id="'.$id.'" class="timeago" title="'
                    .$carbon->toISO8601String().'">'.$carbon->toDateTimeString().'</abbr>';
            } else {
                return '<abbr class="timeago" title="'
                    .$carbon->toISO8601String().'">'.$carbon->toDateTimeString().'</abbr>';
            }
        });
    }

    /**
     * Setup the filters.
     *
     * @return void
     */
    protected function setupFilters()
    {
        $router = $this->app['router'];

        $router->filter('ajax', function ($route, $request) {
            if (!$request->ajax()) {
                throw new MethodNotAllowedHttpException(array(), 'Ajax Is Required');
            }
        });
    }

    /**
     * Setup the listeners.
     *
     * @return void
     */
    protected function setupListeners()
    {
        if ($this->app['config']['graham-campbell/core::commands']) {
            $subscriber = $this->app->make('GrahamCampbell\Core\Subscribers\CommandSubscriber');
            $this->app['events']->subscribe($subscriber);
        }
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
            $crypt = $app['encrypter'];
            $assets = class_exists('Lightgear\Asset\Commands\Generate');

            return new Subscribers\CommandSubscriber($config, $crypt, $assets);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
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
