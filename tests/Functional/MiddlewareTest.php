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
 * This is the middleware test class.
 *
 * @author    Graham Campbell <graham@mineuk.com>
 * @copyright 2013-2014 Graham Campbell
 * @license   <https://github.com/GrahamCampbell/Laravel-Core/blob/master/LICENSE.md> Apache 2.0
 */
class MiddlewareTest extends AbstractTestCase
{
    /**
     * Run extra setup code.
     *
     * @return void
     */
    protected function start()
    {
        $this->app['router']->get('ajax-test-route', array('middleware' => 'GrahamCampbell\Core\Middleware\AjaxMiddleware', function () {
            return 'Hello World';
        }, ));
    }

    public function testWithAjax()
    {
        $response = $this->call('GET', 'ajax-test-route', array(), array(), array(), array('HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest'));

        $this->assertInstanceOf('Illuminate\Http\Response', $response);
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
     */
    public function testWithoutAjax()
    {
        $this->call('GET', 'ajax-test-route');
    }
}
