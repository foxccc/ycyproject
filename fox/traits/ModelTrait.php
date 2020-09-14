<?php
namespace fox\traits;

use think\Model;

trait ModelTrait
{
    public static function get($where)
    {
        if (!is_array($where)) {
            return self::find($where);
        } else {
            return self::where($where)->find();
        }
    }

    public static function all($function)
    {
        $query = self::newQuery();
        $function($query);
        return $query->select();
    }

    /**
     * 查询一条数据是否存在
     * @param $map
     * @param string $field
     * @return bool 是否存在
     */
    public static function be($map, $field = '')
    {
        $model = (new self);
        if (!is_array($map) && empty($field)) $field = $model->getPk();
        $map = !is_array($map) ? [$field => $map] : $map;
        return 0 < $model->where($map)->count();
    }

    /**
     * 删除一条数据
     * @param $id
     * @return bool $type 返回成功失败
     */
    public static function del($id)
    {
        return false !== self::destroy($id);
    }

    /**
     * 分页
     * @param null $model 模型
     * @param null $eachFn 处理结果函数
     * @param array $params 分页参数
     * @param int $limit 分页数
     * @return array
     */
    public static function page($model = null, $eachFn = null, $params = [], $limit = 20)
    {
        if (is_numeric($eachFn) && is_numeric($model)) {
            return parent::page($model, $eachFn);
        }

        if (is_numeric($eachFn)) {
            $limit = $eachFn;
            $eachFn = null;
        } else if (is_array($eachFn)) {
            $params = $eachFn;
            $eachFn = null;
        }

        if (is_callable($model)) {
            $eachFn = $model;
            $model = null;
        } elseif (is_numeric($model)) {
            $limit = $model;
            $model = null;
        } elseif (is_array($model)) {
            $params = $model;
            $model = null;
        }

        if (is_numeric($params)) {
            $limit = $params;
            $params = [];
        }

        $paginate = $model === null ? self::paginate($limit, false, ['query' => $params]) : $model->paginate($limit, false, ['query' => $params]);
        $list = is_callable($eachFn) ? $paginate->each($eachFn) : $paginate;
        $page = $list->render();
        $total = $list->total();
        return compact('list', 'page', 'total');
    }
}