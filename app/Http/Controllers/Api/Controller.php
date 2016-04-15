<?php

namespace App\Http\Controllers\Api;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Request,Response;
use App\Http\Controllers\Api\ReturnCodeController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 获取设置变量，并进行参数合法性检测
     * 参数格式:
     * array(
     *    'state' => array('k'=> 'is_sell', 'r' => array( 'min' => 0, 'max' => 3), 'need'=> 1),
     *  ...
     * )
     * 只检测数值，并且有'r'才检测
     */
    public static function getParam($cfg)
    {
        $data = array();

        foreach ($cfg as $k => $v) {
            $p = Request::get($k);
            if ($p === null) {
                if (is_array($v) && isset($v['need'])) {
                    self::apiReturn(ReturnCodeController::ERR_0105, "缺少参数[" . $k . "]!");
                }
                continue;
            }
            if (is_string($v)) {
                $data[$v] = $p;
                continue;
            }

            if (isset($v['r']) && ((isset($v['r']['min']) && $p < $v['r']['min']) || (isset($v['r']['max']) && $p > $v['r']['max']))) {
                self::apiReturn(ReturnCodeController::ERR_0106, "参数[" . $k . "]范围有误!");
            }
            $data[$v['k']] = $p;
        }

        return $data;
    }

    /**
     * api返回
     * @param $code
     * @param string $message
     * @param string $data
     */
    public static function apiReturn($code, $message = null, $data = null)
    {
        if (empty($message)) {
            $message = ReturnCodeController::getReturnDetail($code);
        }

        return Response::json(['Return' => $code, 'Detail' => $message, 'Data' => $data]);
    }
}
