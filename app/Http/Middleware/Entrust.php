<?php

namespace App\Http\Middleware;

use Closure;

class Entrust
{
    /**
     * 权限过滤
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
//        $routes = \Route::getRoutes()->getRoutes();
//        //dd($routes);
//        $user = auth()->user();
//        if(!($user && $user->hasRole("Admin"))){
//            return redirect('/');
//        }
        return $next($request);
    }
}
