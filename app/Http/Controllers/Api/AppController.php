<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;

class AppController extends Controller
{
    public function getUpdateInfo(){

        $config = array(
            'app_key' => array('k' => 'app_key', 'need' => 1),
            'app_type' => array('k' => 'app_type', 'need' => 1),
            'version_index' => array('k' => 'version_index', 'need' => 1)
        );

        $params = $this->getParam($config);
        if(!is_array($params)){
            return $params;
        }

        $app_key = $params['app_key'];
        $app_type = $params['app_type'];
        $version_index = $params['version_index'];

        $result = [];

        $app = \App\App::where('app_key', $app_key)->first();
        if(!$app){
            //获取当前版本失败
            return $this->apiReturn(ReturnCodeController::ERR_0230);
        }

        //获取当前版本
        $current_version = $app->versions()->where('app_id', $app->id)
            ->where('app_type',$app_type)
            ->where('index',$version_index)
            ->first();
        if(!$current_version){
            //获取当前版本失败
            return $this->apiReturn(ReturnCodeController::ERR_0260);
        }

        //获取当前版本补丁
        $current_patch = $current_version->patch;
        if($current_patch){
            $result['current_version_patch'] = [
                'url' => $current_patch->url,
                'md5_rsa' => $current_patch->md5_rsa
            ];
        }

        //获取最新版本
        $last_version = $app->versions()->where('app_id', $app->id)
            ->where('app_type',$app_type)
            ->orderBy('index','desc')
            ->first();
        if($last_version){
            $result['last_version'] = [
                'index' => "$last_version->index",
                'code' => $last_version->code,
                'url' => $last_version->url
            ];

            //获取最新版本补丁
            $last_version_patch = $last_version->patch;
            if($last_version_patch){
                $result['last_version_patch'] = [
                    'url' => $last_version_patch->url,
                    'md5_rsa' => $last_version_patch->md5_rsa
                ];
            }
        }

        return $this->apiReturn(ReturnCodeController::SUCCESS, '', $result);
    }
}
