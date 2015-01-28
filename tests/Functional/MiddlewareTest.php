<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Core\Functional;

use GrahamCampbell\Tests\Core\AbstractTestCase;

/**
 * This is the middleware test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
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
        $this->app->router->get('ajax-test-route', ['middleware' => 'GrahamCampbell\Core\Http\Middleware\Ajax', function () {
            return 'Hello World';
        }]);
    }

    public function testWithAjax()
    {
        $response = $this->call('GET', 'ajax-test-route', [], [], [], ['HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest']);

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
