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
use Illuminate\Support\ServiceProvider;

/**
 * This is the core service provider class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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

        $this->app['html']->macro('ago', function (Carbon $carbon, $id = null) {
            if ($id) {
                return '<abbr id="'.$id.'" class="timeago" title="'
                    .$carbon->toISO8601String().'">'.$carbon->toDateTimeString().'</abbr>';
            } else {
                return '<abbr class="timeago" title="'
                    .$carbon->toISO8601String().'">'.$carbon->toDateTimeString().'</abbr>';
            }
        });

        include __DIR__.'/filters.php';
        include __DIR__.'/listeners.php';
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
            $force = trait_exists('Illuminate\Support\Traits\MacroableTrait');
            $assets = class_exists('Lightgear\Asset\Commands\Generate');

            return new Subscribers\CommandSubscriber($config, $crypt, $force, $assets);
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
