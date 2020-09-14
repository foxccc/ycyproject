<?php


namespace app\api\controller;


use app\api\model\user\Collect;
use app\Request;

class CollectController
{
    public function collectUser(Request $request)
    {
        $page = $request->param('page');
        $limit = $request->param('limit');
        $uid = 1;
        if(!(int)$limit) return  app('json')->successful([]);
        $productRelationList = Collect::getUserCollectProduct($uid, (int)$page, (int)$limit); //header的uid
        return app('json')->successful($productRelationList);
    }

    public function collectAdd(Request $request)
    {
        $id = $request->param('product_id');
//        $uid = $request->uid();
        $uid = 1;
        if(!$id || !is_numeric($id)) return app('json')->fail('参数错误');
        $res = Collect::productRelation($id, $uid); //header的uid
        if(!$res) return app('json')->fail(Collect::getErrorInfo());
        else return app('json')->successful();
    }

    public function collectAll(Request $request)
    {
        $productIdS = $request->param('products_id');
        $uid = 1;
        if(!count($productIdS)) return app('json')->fail('参数错误');
        $res = Collect::productRelationAll($productIdS, $uid);
        if(!$res) return app('json')->fail(Collect::getErrorInfo());
        else return app('json')->successful('收藏成功');
    }

    public function collectDel(Request $request)
    {
        $id = $request->param('product_id');
        $uid = 1;
        if(!$id || !is_numeric($id)) return app('json')->fail('参数错误');
        $res = Collect::unProductRelation($id, $uid);
        if(!$res) return app('json')->fail(Collect::getErrorInfo());
        else return app('json')->successful();
    }
}