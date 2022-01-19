<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class RouteNeedsRole.
 */
class RouteNeedsPermission
{
    /**
     * @param $request
     * @param Closure $next
     * @param $permission
     * @param bool $needsAll
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $permission, $needsAll = false)
    {
        /*
         * Permission array
         */
        if (strpos($permission, ';') !== false) {
            $permissions = explode(';', $permission);
            $access = $request->user()->hasPermissions($permissions, $needsAll);
        } else {
        /**
         * Single permission.
         */
            $access = $request->user()->hasPermission($permission);
        }

        if (! $access) {
            return redirect('/');
        }

        return $next($request);
    }
}
