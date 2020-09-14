<?php


namespace app\api\model;


use fox\basic\BaseModel;

class Category extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'category_id';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'category';

    public static function getCategory()
    {
        return self::field('name')->select()->toArray();
    }
}