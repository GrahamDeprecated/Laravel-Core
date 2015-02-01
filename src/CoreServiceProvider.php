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
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

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
        $this->setupConfig();

        if ($this->app->config->get('core.commands')) {
            $this->commands('command.appupdate', 'command.appinstall', 'command.appreset');
        }

        if ($this->app->bound('html')) {
            $this->setupMacros($this->app);
        }

        if ($this->app->config->get('core.commands')) {
            $this->setupListeners($this->app);
        }
    }

    /**
     * Setup the config.
     *
     * @return void
     */
    protected function setupConfig()
    {
        $source = realpath(__DIR__.'/../config/core.php');

        $this->publishes([$source => config_path('core.php')]);

        $this->mergeConfigFrom($source, 'core');
    }

    /**
     * Setup the html macros.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function setupMacros(Application $app)
    {
        $app->html->macro('ago', function (Carbon $carbon, $id = null) {
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
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function setupListeners(Application $app)
    {
        $subscriber = $app->make('GrahamCampbell\Core\Subscribers\CommandSubscriber');

        $app->events->subscribe($subscriber);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerUpdateCommand($this->app);
        $this->registerInstallCommand($this->app);
        $this->registerResetCommand($this->app);
        $this->registerCommandSubscriber($this->app);
    }

    /**
     * Register the updated command class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerUpdateCommand(Application $app)
    {
        $app->singleton('command.appupdate', function ($app) {
            $events = $app['events'];

            return new Console\Commands\AppUpdate($events);
        });
    }

    /**
     * Register the install command class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerInstallCommand(Application $app)
    {
        $app->singleton('command.appinstall', function ($app) {
            $events = $app['events'];

            return new Console\Commands\AppInstall($events);
        });
    }

    /**
     * Register the reset command class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerResetCommand(Application $app)
    {
        $app->singleton('command.appreset', function ($app) {
            $events = $app['events'];

            return new Console\Commands\AppReset($events);
        });
    }

    /**
     * Register the command subscriber class.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return void
     */
    protected function registerCommandSubscriber(Application $app)
    {
        $app->singleton('GrahamCampbell\Core\Subscribers\CommandSubscriber', function () {
            return new Subscribers\CommandSubscriber();
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
