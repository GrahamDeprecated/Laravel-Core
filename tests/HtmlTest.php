<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Core;

/**
 * This is the html test class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class HtmlTest extends AbstractTestCase
{
    public function testSetup()
    {
        $this->assertFalse($this->app->bound('html'));
    }
}
