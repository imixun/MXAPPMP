<?php

namespace App\Http\Middleware;

use Closure,Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Controllers\Api\ReturnCodeController;

class Api
{
    /**
     * Api登录过滤
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $api_token = $request->get('token');
        if(empty($api_token)){
            return Controller::apiReturn(ReturnCodeController::ERR_0102);
        }

        //查找当前用户
        $user = \App\User::where(['api_token'=>$api_token])->first();
        if(!$user){
            return Controller::apiReturn(ReturnCodeController::ERR_0100);
        }

        //设置用户为当前登录用户
        Auth::setUser($user);

        return $next($request);
    }
}
