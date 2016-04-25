<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\ResetsPasswords;

use App\Http\Requests;
use Auth;

class UserController extends Controller
{
    use ResetsPasswords;

    public function showChangePasswordForm()
    {
        return view('admin.user.changePassword');
    }

    public function changePassword(Request $request)
    {
        $this->validate($request, [
            'old_password'=>'required|min:6',
            'new_password'=>'required|confirmed|min:6',
            'new_password_confirmation'=>'required|min:6'
        ]);

        $auth = Auth();
        $user = $auth->user();

        //验证密码是否正确
        if(!app('hash')->check($request->get('old_password'),$user->getAuthPassword())){
            return $this->error('原密码不正确');
        }

        $user->password = bcrypt($request->get('new_password'));

        //保存修改密码
        $user->save();

        //保存到当前登录
        $auth->guard()->setUser($user);

        return $this->success('修改密码成功');
    }
}
