<?php


namespace app\api\model;

use fox\basic\BaseModel;

class Carousel extends BaseModel
{
    /**
     * 数据表主键
     * @var string
     */
    protected $pk = 'id';

    /**
     * 模型名称
     * @var string
     */
    protected $name = 'carousel';

    public static function getCarouselList()
    {
        return self::where('type','index')->select()->toArray();
    }
}