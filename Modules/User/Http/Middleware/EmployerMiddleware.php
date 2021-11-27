<?php

namespace Modules\User\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\User\Entities\User;
use Modules\User\Enums\Permissions;
use Modules\User\Enums\Roles;

class EmployerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if ($user = User::current()) {
            if ($user->hasRole(Roles::ADMIN) || $user->hasRole(Roles::EMPLOYER) || $user->hasPermissionTo(Permissions::ACCESS_EMPLOYER_PANEL)) {
                return $next($request);
            }
        }
        return res()->error('Unauthorized.');
    }
}
