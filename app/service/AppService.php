<?php
declare (strict_types = 1);

namespace app\service;

use think\Service;
use fox\utils\Json;

class AppService  extends Service
{

    //添加服务，可以使用app('json')
    public $bind =[
        'json' => Json::class,
    ];

    /**
     * 注册服务
     *
     * @return mixed
     */
    public function register()
    {
    	//
    }


    /**
     * 执行服务
     *
     * @return mixed
     */
    public function boot()
    {
        //
    }
}
