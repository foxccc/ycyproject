<?php


namespace fox\subscribes;

/**
 * 产品事件
 * Class ProductSubscribe
 * @package fox\subscribes
 */
class ProductSubscribe
{
    public function handle()
    {

    }

    /**
     * 用户操作产品收藏事件  用户收藏产品
     * @param $event
     */
    public function onStoreProductUserOperationConfirmAfter($event)
    {
        list($productId, $uid) = $event;
        echo '收藏成功';
        //$productId 产品编号
        //$uid 用户编号
    }

    /**
     * 用户操作产品取消事件  用户取消收藏产品
     * @param $event
     */
    public function onStoreProductUserOperationCancelAfter($event)
    {
        list($productId, $uid) = $event;
        echo '取消收藏';
    }
}