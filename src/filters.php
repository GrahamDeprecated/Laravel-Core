<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;

Route::filter('ajax', function ($route, $request) {
    if (!$request->ajax()) {
        throw new MethodNotAllowedHttpException([], 'Ajax Is Required');
    }
});
