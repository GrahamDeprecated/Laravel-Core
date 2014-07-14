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

namespace GrahamCampbell\Tests\Core;

use Carbon\Carbon;

/**
 * This is the macro test class.
 *
 * @package    Laravel-Core
 * @author     Graham Campbell
 * @copyright  Copyright 2013-2014 Graham Campbell
 * @license    https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md
 * @link       https://github.com/GrahamCampbell/Laravel-Core
 */
class MacroTest extends AbstractTestCase
{
    public function testBasic()
    {
        $result = $this->app['html']->ago(Carbon::create(2014, 1, 2, 3, 4, 5));

        $this->assertEquals('<abbr class="timeago" title="2014-01-02T03:04:05+0000">2014-01-02 03:04:05</abbr>', $result);
    }

    public function testId()
    {
        $result = $this->app['html']->ago(Carbon::create(2014, 1, 2, 3, 4, 5), 'foo');

        $this->assertEquals('<abbr id="foo" class="timeago" title="2014-01-02T03:04:05+0000">2014-01-02 03:04:05</abbr>', $result);
    }
}
