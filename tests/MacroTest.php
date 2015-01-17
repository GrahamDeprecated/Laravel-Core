<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Core;

use Carbon\Carbon;

/**
 * This is the macro test class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class MacroTest extends AbstractTestCase
{
    /**
     * Get the required service providers.
     *
     * @param \Illuminate\Contracts\Foundation\Application $app
     *
     * @return string[]
     */
    protected function getRequiredServiceProviders($app)
    {
        return [
            'Illuminate\Html\HtmlServiceProvider',
        ];
    }

    public function testSetup()
    {
        $this->assertTrue($this->app->bound('html'));
    }

    /**
     * @depends testSetup
     */
    public function testBasic()
    {
        $result = $this->app['html']->ago(Carbon::create(2014, 1, 2, 3, 4, 5));

        $this->assertSame('<abbr class="timeago" title="2014-01-02T03:04:05+0000">2014-01-02 03:04:05</abbr>', $result);
    }

    /**
     * @depends testBasic
     */
    public function testId()
    {
        $result = $this->app['html']->ago(Carbon::create(2014, 1, 2, 3, 4, 5), 'foo');

        $this->assertSame('<abbr id="foo" class="timeago" title="2014-01-02T03:04:05+0000">2014-01-02 03:04:05</abbr>', $result);
    }
}
