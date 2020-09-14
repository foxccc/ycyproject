<?php


namespace app\api\controller;

use app\api\model\Product as ProductModel;
use app\BaseController;
use app\Request;
use think\Db;

class ProductController extends BaseController
{
    public function index(Request $request)
    {
        $categoryId = $request->param('cartId');
        return app('json')->successful(ProductModel::getProducts($categoryId));
    }

    public function productInfo(Request $request)
    {
        $pid = $request->param('pid');
        return app('json')->successful(ProductModel::getProductInfo($pid));
    }
}