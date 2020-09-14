<?php


namespace app\api\controller;


use app\api\model\order\Cart;
use app\BaseController;
use app\Request;

class CartController extends BaseController
{
    public function index(Request $request)
    {
        $user_id = $request->param('user_id');
        return app('json')->successful(Cart::getCart($user_id));
    }
}