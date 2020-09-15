<?php


namespace app\api\controller;


use app\BaseController;
use app\Request;
use think\facade\Cache;
use fox\services\UploadService;
use fox\services\UtilService;

class PublicController extends BaseController
{
    public function upload_image(Request $request)
    {
        $filename = $request->file('filename');
        if (!$filename) return app('json')->fail('参数有误');
        if (Cache::has('start_uploads_' . $request->uid()) && Cache::get('start_uploads_' . $request->uid()) >= 100) return app('json')->fail('非法操作');
        $res = UploadService::instance()->setUploadPath('store/comment')->image($filename);
        if (!is_array($res)) return app('json')->fail($res);
        // 添加文件附件记录
        if (Cache::has('start_uploads_' . $request->uid()))
            $start_uploads = (int)Cache::get('start_uploads_' . $request->uid());
        else
            $start_uploads = 0;
        $start_uploads++;
        Cache::set('start_uploads_' . $request->uid(), $start_uploads, 86400);
        $res['dir'] = UtilService::pathToUrl($res['dir']);
        if (strpos($res['dir'], 'http') === false) $res['dir'] = $request->domain() . $res['dir'];
        return app('json')->successful('图片上传成功!', ['name' => $res['name'], 'url' => $res['dir']]);
    }
}