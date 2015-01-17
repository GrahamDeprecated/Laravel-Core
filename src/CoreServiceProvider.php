<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Core;

use Carbon\Carbon;
use Orchestra\Support\Providers\ServiceProvider;

/**
 * This is the core service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class CoreServiceProvider extends ServiceProvider
{
    /**
     * Boot the service provider.
     *
     * @return void
     */
    public function boot()
    {
        $this->addConfigComponent('graham-campbell/core', 'graham-campbell/core', realpath(__DIR__.'/../config'));

        if ($this->app['config']['graham-campbell/core::commands']) {
            $this->commands('command.appupdate', 'command.appinstall', 'command.appreset');
        }

        if ($this->app->bound('html')) {
            $this->setupMacros();
        }

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
        $this->app->singleton('command.appupdate', function ($app) {
            $events = $app['events'];

            return new Console\Commands\AppUpdate($events);
        });
    }

    /**
     * Register the install command class.
     *
     * @return void
     */
    protected function registerInstallCommand()
    {
        $this->app->singleton('command.appinstall', function ($app) {
            $events = $app['events'];

            return new Console\Commands\AppInstall($events);
        });
    }

    /**
     * Register the reset command class.
     *
     * @return void
     */
    protected function registerResetCommand()
    {
        $this->app->singleton('command.appreset', function ($app) {
            $events = $app['events'];

            return new Console\Commands\AppReset($events);
        });
    }

    /**
     * Register the command subscriber class.
     *
     * @return void
     */
    protected function registerCommandSubscriber()
    {
        $this->app->singleton('GrahamCampbell\Core\Subscribers\CommandSubscriber', function ($app) {
            $config = $app['config'];
            $crypt = $app['encrypter'];

            return new Subscribers\CommandSubscriber($config, $crypt);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [
            'command.appupdate',
            'command.appinstall',
            'command.appreset',
        ];
    }
}
