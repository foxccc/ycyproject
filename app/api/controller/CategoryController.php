<?php


namespace app\api\controller;


use app\api\model\Category;
use app\BaseController;

class CategoryController extends BaseController
{
    public function index()
    {
        return app('json')->successful(Category::getCategory());
    }
}