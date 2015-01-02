<?php

/*
 * This file is part of Laravel Core.
 *
 * (c) Graham Campbell <graham@mineuk.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace GrahamCampbell\Core\Http\Middleware;

use Closure;
use Illuminate\Contracts\Routing\Middleware;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * This is the ajax middleware class.
 *
 * @author Graham Campbell <graham@mineuk.com>
 */
class Ajax implements Middleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @throws \Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax()) {
            throw new AccessDeniedHttpException('Ajax Is Required');
        }

        return $next($request);
    }
}
