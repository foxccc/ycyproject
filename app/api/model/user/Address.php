<?php


namespace app\api\model\user;


use fox\basic\BaseModel;

class Address extends BaseModel
{
    protected $pk = 'user_addr_id';

    protected $name = 'user_addr';

    public static function getAddress($user_id)
    {
        return self::where('user_id', $user_id)->select()->toArray();
    }
}