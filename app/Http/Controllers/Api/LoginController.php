<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth,Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index(){

        $config = array(
            'user_name' => array('k' => 'user_name', 'need' => 1),
            'password' => array('k' => 'password', 'need' => 1)
        );
        $params = $this->getParam($config);

        $user_name = $params['user_name'];
        $password = $params['password'];

        $result = Auth::once(['user_name'=>$user_name,'password'=>$password]);
        if(!$result){
            return $this->apiReturn(ReturnCodeController::ERR_0200);
        }

        $user = Auth::user();

        //拼装app_token，防止重复
        $user->api_token = $user->id . uniqid() . Str::random(30);

        if(!$user->save()){
            return $this->apiReturn(ReturnCodeController::ERR_0200);
        }

        $result = [];

        $result['token'] = $user->api_token;

        return $this->apiReturn(ReturnCodeController::SUCCESS, '', $result);
    }
}
