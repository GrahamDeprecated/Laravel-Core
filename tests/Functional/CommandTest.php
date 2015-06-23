<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@cachethq.io>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Tests\Core\Functional;

use GrahamCampbell\Tests\Core\AbstractTestCase;
use Illuminate\Contracts\Console\Kernel;

/**
 * This is the command test class.
 *
 * @author Graham Campbell <graham@cachethq.io>
 */
class CommandTest extends AbstractTestCase
{
    /**
     * @beforeClass
     */
    public static function setUpDatabaseSeeder()
    {
        if (!class_exists('DatabaseSeeder')) {
            eval('class DatabaseSeeder extends Illuminate\Database\Seeder { public function run() {} }');
        }
    }

    public function testInstall()
    {
        $this->assertSame(0, $this->app->make(Kernel::class)->call('app:install'));
    }

    public function testReset()
    {
        $this->assertSame(0, $this->app->make(Kernel::class)->call('migrate', ['--force' => true]));
        $this->assertSame(0, $this->app->make(Kernel::class)->call('app:reset'));
    }

    public function testUpdate()
    {
        $this->assertSame(0, $this->getKernel()->call('app:update'));
    }

    public function testResetAfterInstall()
    {
        $this->assertSame(0, $this->app->make(Kernel::class)->call('app:install'));
        $this->assertSame(0, $this->app->make(Kernel::class)->call('app:reset'));
    }
}
