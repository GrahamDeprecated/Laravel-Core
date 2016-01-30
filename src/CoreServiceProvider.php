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
use Illuminate\Contracts\Container\Container;
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

        $this->setupListeners();
    }

    /**
     * Setup the listeners.
     *
     * @return void
     */
    protected function setupListeners()
    {
        $subscriber = $this->app->make(CommandSubscriber::class);

        $this->app->events->subscribe($subscriber);
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
        $this->app->singleton('command.appupdate', function (Container $app) {
            $events = $app['events'];

            return new AppUpdate($events);
        });
    }

    /**
     * Register the install command class.
     *
     * @return void
     */
    protected function registerInstallCommand()
    {
        $this->app->singleton('command.appinstall', function (Container $app) {
            $events = $app['events'];

            return new AppInstall($events);
        });
    }

    /**
     * Register the reset command class.
     *
     * @return void
     */
    protected function registerResetCommand()
    {
        $this->app->singleton('command.appreset', function (Container $app) {
            $events = $app['events'];

            return new AppReset($events);
        });
    }

    /**
     * Register the command subscriber class.
     *
     * @return void
     */
    protected function registerCommandSubscriber()
    {
        $this->app->singleton(CommandSubscriber::class, function () {
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
