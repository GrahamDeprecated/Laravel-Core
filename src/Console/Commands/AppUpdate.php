<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@alt-three.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * This is the app update command class.
 *
 * @author Graham Campbell <graham@alt-three.com>
 */
class AppUpdate extends Command
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'app:update';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Updates the application';

    /**
     * The events instance.
     *
     * @var \Illuminate\Contracts\Events\Dispatcher
     */
    protected $events;

    /**
     * Create a new instance.
     *
     * @param \Illuminate\Contracts\Events\Dispatcher $events
     *
     * @return void
     */
    public function __construct(Dispatcher $events)
    {
        $this->events = $events;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $this->events->fire('command.publishvendors', $this);
        $this->events->fire('command.runmigrations', $this);
        $this->events->fire('command.updatecache', $this);
        $this->events->fire('command.extrastuff', $this);
    }

    /**
     * Get the events instance.
     *
     * @return \Illuminate\Contracts\Events\Dispatcher
     */
    public function getEvents()
    {
        return $this->events;
    }
}
