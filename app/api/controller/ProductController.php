<?php


namespace app\api\controller;

use app\api\model\Product as ProductModel;
use app\BaseController;
use app\Request;

class ProductController extends BaseController
{
    public function index(Request $request)
    {
        $categoryId = $request->param('cartId');
        return app('json')->successful(ProductModel::getProducts($categoryId));
    }
}