<?php

namespace app\api\controller;

use app\api\model\user\User;
use think\Request;
use app\BaseController;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        $user = User::where('account', $request->param('account'))->find();
        if ($user) {
            if ($user->password !== md5($request->param('password'))) return app('json')->fail('账号或密码错误');
        }else{
            return app('json')->fail('账号或密码错误');
        }
        if ($user['status'] == 0) {
            return app('json')->fail('已被禁止，请联系管理员');
        }
    }
}