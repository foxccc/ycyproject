<?php


namespace app\api\controller;


use app\api\model\user\Address;
use app\BaseController;
use app\Request;

class AddressController extends BaseController
{
    public function index(Request $request)
    {
        $user_id = $request->param('user_id');
        return app('json')->successful(Address::getAddress($user_id));
    }
}