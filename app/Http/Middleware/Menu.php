<?php

namespace App\Http\Middleware;

use App\Models\RoleMenu;

use Closure,Auth;

class Menu
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
        $role_menus = RoleMenu::where('role_id',Auth::user()->role_id)->get();
        $menus = [];
        foreach($role_menus as $k=>$role_menu){
            if(empty($role_menu->menu->parent_id)){
                $menus[$role_menu->menu->id]    = $role_menu->menu;
            } elseif(!array_key_exists($role_menu->menu->parent_id, $menus)) {
                $menus[$role_menu->menu->parent_id]['head']     = $role_menu->menu->parent->name;
                $menus[$role_menu->menu->parent_id]['icon']     = $role_menu->menu->parent->icon;
                $menus[$role_menu->menu->parent_id]['detail'][] = $role_menu->menu;
            } elseif(array_key_exists($role_menu->menu->parent_id, $menus)) {
                $menus[$role_menu->menu->parent_id]['detail'][] = $role_menu->menu;
            }
        }
        session()->put('menus',$menus);
        return $next($request);
    }
}
