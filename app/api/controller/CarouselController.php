<?php
namespace app\api\controller;

use app\api\model\Carousel as CarouselModel;
use app\BaseController;

class CarouselController extends BaseController
{
    public function index()
    {
        return app('json')->successful(CarouselModel::getCarouselList());
    }
}