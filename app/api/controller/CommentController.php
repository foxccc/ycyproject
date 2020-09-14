<?php


namespace app\api\controller;


use app\api\model\Comment;
use app\BaseController;
use app\Request;

class CommentController extends BaseController
{
    public function index(Request $request)
    {
        $product_id = $request->param('product_id');
        $order_id = $request->param('order_id');
        return app('json')->successful(Comment::getComments($product_id, $order_id));
    }
}