<?php
/**
 * Created by PhpStorm.
 * User: jx
 * Date: 15/3/14
 * Time: 下午4:05
 */

namespace App\Http\Controllers\Api;


class ReturnCodeController {

    //操作成功
    const SUCCESS = '0';

    //错误编码

    //数据库操作错误
    const ERR_0001 = '-1';//插入错误
    const ERR_0002 = '-2';//删除错误
    const ERR_0003 = '-3';//查询错误
    const ERR_0004 = '-4';//更新错误

    //特殊错误
    const ERR_0100 = '-100';//用户状态异常，需重新登录

    //公共部分
    const ERR_0101 = '-101';//验证错误
    const ERR_0102 = '-102';//您没有该操作权限
    const ERR_0103 = '-103';//参数范围有误
    const ERR_0104 = '-104';//缺少参数
    const ERR_0105 = '-105';//缺失app_key
    const ERR_0106 = '-106';//缺失nonce
    const ERR_0107 = '-107';//缺失signature

    //用户部分
    const ERR_0200 = '-200';//账号或密码错误

    //应用部分
    const ERR_0230 = '-230';//应用不存在

    //版本部分
    const ERR_0260 = '-260';//模板不存在


    private static $ERR_STRING_ARR = array(
        ReturnCodeController::SUCCESS => '',

        //数据库操作错误
        ReturnCodeController::ERR_0001 => 'insert error！',
        ReturnCodeController::ERR_0002 => 'delete error！',
        ReturnCodeController::ERR_0003 => 'select error！',
        ReturnCodeController::ERR_0004 => 'update error！',

        //特殊错误
        ReturnCodeController::ERR_0100 => '您的账号状态发生变化，需要重新登录',

        //公共部分
        ReturnCodeController::ERR_0101 => 'signature is wrong！',
        ReturnCodeController::ERR_0102 => 'access denied！',
        ReturnCodeController::ERR_0103 => '参数范围有误！',
        ReturnCodeController::ERR_0104 => '缺少参数！',
        ReturnCodeController::ERR_0105 => '缺失app_key！',
        ReturnCodeController::ERR_0106 => '缺失nonce！',
        ReturnCodeController::ERR_0107 => '缺失signature！',

        //用户部分
        ReturnCodeController::ERR_0200 => '账号或密码错误',

        //应用部分
        ReturnCodeController::ERR_0230 => '应用不存在',

        //版本部分
        ReturnCodeController::ERR_0260 => '版本不存在',


    );

    static function getReturnDetail($returnCode){
        return ReturnCodeController::$ERR_STRING_ARR[$returnCode];
    }

}