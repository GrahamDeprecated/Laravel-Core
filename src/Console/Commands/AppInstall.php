<?php

/*
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

namespace GrahamCampbell\Core\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Contracts\Events\Dispatcher;

/**
 * This is the app install command class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md> Apache 2.0
 */
class AppInstall extends Command
{
    /**
     * The command name.
     *
     * @var string
     */
    protected $name = 'app:install';

    /**
     * The command description.
     *
     * @var string
     */
    protected $description = 'Installs The Application';

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
     * Run the commend.
     *
     * @return void
     */
    public function fire()
    {
        $this->events->fire('command.genappkey', $this);
        $this->events->fire('command.runmigrations', $this);
        $this->events->fire('command.runseeding', $this);
        $this->events->fire('command.updatecache', $this);
        $this->events->fire('command.genassets', $this);
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
