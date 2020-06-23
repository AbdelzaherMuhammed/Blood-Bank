<?php

namespace App\Http\Middleware;

use App\models\Permission;
use Closure;

class AutoCheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $routeName = $request->route()->getName(); //user.create
        //search for routeName in column routes
        $permission = Permission::whereRaw("FIND_IN_SET ('$routeName' , routes)")->first();

        if ($permission)
        {
            if (!$request->user()->can($permission->name))
            {
                abort(403);
            }

        }

        return $next($request);
    }
}
