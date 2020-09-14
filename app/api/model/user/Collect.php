<?php


namespace app\api\model\user;


use fox\traits\ModelTrait;
use fox\basic\BaseModel;

class Collect extends BaseModel
{
    use ModelTrait;

    protected $pk = 'collect_id';

    protected $name = 'user_collect';

    public static function getUserIdCollect($user_id)
    {
        $count = self::where('user_id',$user_id)->count();
        return $count;
    }

    /**
     * 添加收藏
     * @param $productId
     * @param $uid
     * @return bool
     */
    public static function productRelation($productId,$uid)
    {
        if(!$productId) return self::setErrorInfo('产品不存在!');
        $data = ['user_id'=>$uid,'product_id'=>$productId];
        if(self::be($data)) return true;
        $data['add_time'] = time();
        self::create($data);
        event('StoreProductUserOperationConfirmAfter',[$productId, $uid]);
        return true;
    }

    /**
     * 批量收藏
     * @param $productIds
     * @param $uid
     * @return bool
     */
    public static function productRelationAll($productIds,$uid)
    {
        $res = true;
        if (is_array($productIds)) {
            self::beginTrans();
            foreach ($productIds as $productId) {
                $res = $res && self::productRelation($productId, $uid);
            }
            if ($res) {
                foreach ($productIds as $productId) {
                    event('StoreProductUserOperationConfirmAfter',[$productId, $uid]);
                }
            }
            self::checkTrans($res);
            return $res;
        }
        return $res;
    }

    /**
     * 删除收藏
     * @param $productId
     * @param $uid
     * @return bool
     */
    public static function unProductRelation($productId, $uid)
    {
        if(!$productId) return self::setErrorInfo('产品不存在!');
        self::where('user_id', $uid)->where('product_id', $productId)->delete();
        event('StoreProductUserOperationCancelAfter', [$productId, $uid]);
        return true;
    }

    /**
     * 获取某个用户收藏产品
     * @param $uid
     * @param $page
     * @param $limit
     * @return array
     */
    public static function getUserCollectProduct($uid, $page, $limit)
    {
        if (!$limit) return [];
        if ($page) {
            $list = self::where('C.user_id', $uid)
                ->field('*')
                ->alias('C')
                ->order('C.add_time DESC')
                ->join('product_info P', 'C.product_id = P.pid')
                ->page($page, $limit)
                ->select();
        } else {
            $list = self::where('C.uid', $uid)
                ->field('*')
                ->alias('C')
                ->order('C.add_time DESC')
                ->join('product_info P', 'C.product_id = P.pid')
                ->select();
        }
        if (!$list) return [];
        $list = $list->toArray();
//        foreach ($list as $k => $product){
//            if($product['pid']){
//                $list[$k]['is_fail'] = $product['is_del'] && $product['is_show'];
//            }else{
//                unset($list[$k]);
//            }
//        }
        return $list;
    }
}