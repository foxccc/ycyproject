<?php


namespace app\api\controller;


use app\api\model\user\User;
use app\Request;

class UserController
{
    public function index(Request $request)
    {
        $uid = $request->param('uid');
        return app('json')->successful(User::getUserInfo($uid));
    }
}