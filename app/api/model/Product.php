<?php


namespace app\api\model;

use fox\basic\BaseModel;

class Product extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'pid';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'product_info';

    public function productPic()
    {
        return $this->hasMany(ProductPic::class,'product_id');
    }

    /**
     * 商品列表
     * @param $categoryId
     * @return array
     * @throws \think\db\exception\DataNotFoundException
     * @throws \think\db\exception\DbException
     * @throws \think\db\exception\ModelNotFoundException
     */
    public static function getProducts($categoryId)
    {
        return self::hasWhere('productPic',['pic_status'=>1])->where('category_id', $categoryId)->select()->toArray();
    }
}