<?php


namespace app\api\model\user;


use fox\basic\BaseModel;

class UserToken extends BaseModel
{
    protected $pk = 'id';

    protected $name = 'user_token';

    protected $type = [
        'create_time' => 'datetime',
        'login_ip' => 'string'
    ];
}