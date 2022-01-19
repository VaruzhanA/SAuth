<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Class RouteNeedsRole.
 */
class RouteNeedsRole
{
    /**
     * @param $request
     * @param Closure $next
     * @param $role
     * @param bool $needsAll
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $role, $needsAll = false)
    {
        /*
         * Roles array
         */
        if (strpos($role, ';') !== false) {
            $roles = explode(';', $role);
            $access = $request->user()->hasRoles($roles, ($needsAll === 'true' ? true : false));
        } else {
            /**
             * Single role.
             */
            $access = $request->user()->hasRole($role);
        }
        if (! $access) {
            return redirect('/');
        }
        return $next($request);
    }
}
