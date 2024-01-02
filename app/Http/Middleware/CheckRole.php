<?php

namespace App\Http\Middleware;

use App\Models\RoleMenu;

use Closure,Auth,Request;

class CheckRole
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
        $role_menu = RoleMenu::whereHas('menu' , function ($query) {
                            $query->where('url',Request::segment(0));
                        })
                        ->where('role_id',Auth::user()->id)
                        ->first();

        if(empty($role_menu) && !empty(Request::segment(0))){
            Auth::logout();
            return redirect('login');
        }
        return $next($request);
    }
}
