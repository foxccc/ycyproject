<?php

namespace app\api\model\user;

use fox\basic\BaseModel;

class User extends BaseModel
{
    protected $pk = 'uid';

    protected $name = 'user';

    protected $insert = ['add_time', 'add_ip', 'last_time', 'last_ip'];

    protected function setAddTimeAttr($value)
    {
        return time();
    }

    protected function setAddIpAttr($value)
    {
        return app('request')->ip();
    }

    protected function setLastTimeAttr($value)
    {
        return time();
    }

    protected function setLastIpAttr($value)
    {
        return app('request')->ip();
    }
}