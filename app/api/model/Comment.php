<?php


namespace app\api\model;


use app\api\model\user\User;
use fox\basic\BaseModel;

class Comment extends BaseModel
{
    protected $pk = 'comment_id';

    protected $name = 'product_comment';

    public function user()
    {
        return $this->hasOne(User::class,'uid','user_id');
    }

    public static function getComments($product_id, $order_id)
    {
        $where = [
            'product_id' => $product_id,
            'order_id' => $order_id,
            'status' => 1,
        ];
        return self::with(['user' => function($query) {
            $query->field('uid, nickname');
        }])->where($where)->select()->toArray();
    }
}