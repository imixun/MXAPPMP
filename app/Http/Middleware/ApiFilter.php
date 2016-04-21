<?php

namespace App\Http\Middleware;

use Closure,Auth;

use App\Http\Controllers\Api\Controller;
use App\Http\Controllers\Api\ReturnCodeController;

class ApiFilter
{
    /**
     * Api过滤
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $api_key = $request->get('app_key');
        if(empty($api_key)){
            return Controller::apiReturn(ReturnCodeController::ERR_0105);
        }

        $nonce = $request->get('nonce');
        if(empty($nonce)){
            return Controller::apiReturn(ReturnCodeController::ERR_0106);
        }

        $signature= $request->get('signature');
        if(empty($signature)){
            return Controller::apiReturn(ReturnCodeController::ERR_0106);
        }

        //查找应用
        $app = \App\App::where('app_key',$api_key)->first();
        if(!$app){
            return Controller::apiReturn(ReturnCodeController::ERR_0230);
        }

        //验证签名
        if(md5($app->id . $app->secret . $nonce) != $signature){
            return Controller::apiReturn(ReturnCodeController::ERR_0101);
        }
        return $next($request);
    }
}
