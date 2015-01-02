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
 * This is the filter test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class FilterEnabledTest extends AbstractTestCase
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
        $this->app['router']->get('ajax-test-route', ['before' => 'ajax', function () {
            return 'Hello World';
        }]);

        $this->assertInstanceOf('Illuminate\Http\Response', $this->call('GET', 'ajax-test-route', [], [], ['HTTP_X_REQUESTED_WITH' => 'XMLHttpRequest']));
    }

    /**
     * @expectedException \Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException
     */
    public function testWithOut()
    {
        $this->app['router']->get('ajax-test-route', ['before' => 'ajax', function () {
            return 'Hello World';
        }]);

        $this->call('GET', 'ajax-test-route');
    }
}
