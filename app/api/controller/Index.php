<?php
namespace app\api\controller;

use app\BaseController;
use think\Request;
use fox\utils\Json;

class Index extends BaseController
{
    private $code = 200;

    public function index(Request $request)
    {
        $data = 1;
        return app('json')->successful($data);
    }
}