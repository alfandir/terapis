<?php

namespace App\Http\Middleware;

use App\Model\Action;
use App\Model\MenuRole;
use Closure;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class RbacCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $slug, $action_id = 1)
    {
        $check = $this->rbacCheck($slug, $action_id);
        if ($check == false)
            abort(403, 'Access Forbidden');

        $actions = Action::all();
        $permissions = [];
        foreach ($actions as $action) {
            $permissions[$action->name] = $this->rbacCheck($slug, $action->id);
        }
        View::share('permissions', $permissions);
        return $next($request);
    }

    function rbacCheck($slug, $action_id)
    {
        $role_id = session('role_id');
        $check = MenuRole::where([
            'role_id' => $role_id,
            'action_id' => $action_id,
            'is_active' => 1,
        ])->whereHas('menu', function ($query) use ($slug) {
            $query->where('slug_name', $slug);
        })->first();

        if (empty($check)) {
            return false;
        }

        return true;
    }
}
