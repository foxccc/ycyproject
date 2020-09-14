<?php


namespace app\api\model\order;


use app\api\model\Product;
use fox\basic\BaseModel;

class Cart extends BaseModel
{
    protected $pk = 'cart_id';

    protected $name = 'order_cart';

    public function product()
    {
        return $this->hasOne(Product::class,'pid','product_id');
    }

    public static function getCart($user_id)
    {
        return self::with('product')->where('user_id', $user_id)->select()->toArray();
    }
}