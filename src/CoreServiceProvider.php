<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Core;

use GrahamCampbell\Core\Console\Commands\AppInstall;
use GrahamCampbell\Core\Console\Commands\AppReset;
use GrahamCampbell\Core\Console\Commands\AppUpdate;
use GrahamCampbell\Core\Subscribers\CommandSubscriber;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

/**
 * This is the core service provider class.
 *
 * @author Graham Campbell <graham@alt-three.com>
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
        $this->commands('command.appupdate', 'command.appinstall', 'command.appreset');

        $this->setupListeners($this->app);
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
        $subscriber = $app->make(CommandSubscriber::class);

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

            return new AppUpdate($events);
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

            return new AppInstall($events);
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

            return new AppReset($events);
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
        $app->singleton(CommandSubscriber::class, function () {
            return new CommandSubscriber();
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
