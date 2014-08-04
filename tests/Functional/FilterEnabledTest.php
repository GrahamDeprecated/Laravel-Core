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

namespace GrahamCampbell\Tests\Core\Functional;

use GrahamCampbell\Tests\Core\AbstractTestCase;

/**
 * This is the filter test class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md> Apache 2.0
 */
class FilterTest extends AbstractTestCase
{
    /**
     * Specify if routing filters are enabled.
     *
     * @return bool
     */
    protected function enableFilters()
    {
        return true;
    }

    public function testWithAjax()
    {
        $this->app['router']->get('ajax-test-route', array('before' => 'ajax', function () {
            return 'Hello World';
        }));

        $this->call('GET', 'ajax-test-route', array(), array(), array('HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest'));
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     */
    public function testWithOut()
    {
        $this->app['router']->get('ajax-test-route', array('before' => 'ajax', function () {
            return 'Hello World';
        }));

        $this->call('GET', 'ajax-test-route');
    }
}
