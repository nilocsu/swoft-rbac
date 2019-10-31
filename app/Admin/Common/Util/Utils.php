<?php


namespace App\Admin\Common\Util;


use Swoft\Log\Helper\Log;
use Swoft\Context\Context;
use Swoft\Db\Eloquent\Builder;


class Utils
{
    /**
     * 格式化一下错误log日志打印格式
     * @param string $msg
     * @param $error
     */
    public static function log(string $msg, \Throwable $error)
    {
        $list = [
            'msg'  => $error->getMessage(),
            'line' => $error->getLine(),
            'file' => $error->getFile(),
        ];
        Log::error($msg, $list);
    }

    /**
     * @param Builder $builder
     * @param string $defaultSort
     * @param string $defaultOrder
     * @return array
     */
    public static function pageSort(Builder $builder, string $defaultSort = 'id', string $defaultOrder = 'asc')
    {
        $query    = Context::get()->getRequest()->input();
        $page     = 1;
        $pageSize = 20;
        if (isset($query['page'])) {
            $page = filter_var($query['page'], FILTER_VALIDATE_INT) ?? 1;
        }
        if (isset($query['pageSize'])) {
            $pageSize = filter_var($query['pageSize'], FILTER_VALIDATE_INT) ?? 20;
        }
        if ($pageSize > 400) {
            $pageSize = 400;
        }
        $offset   = ($page - 1) * $pageSize;
        if (empty($defaultSort)) $defaultSort = 'id';
        if (empty($defaultOrder)) $defaultOrder = 'asc';
        $builder->orderBy($defaultSort, $defaultOrder);
        return [
            'total' => $builder->count(),
            'page'  => $page,
            'data'  => $builder->offset($offset)->limit((int)$pageSize)->get(),
        ];
    }
    /**
     * 给出byte转换单位大小
     * @param $size
     * @return string
     */
    public static function getSize($size) {
        $units = array(' B', ' KB', ' MB', ' GB', ' TB');
        for ($i = 0; $size >= 1024 && $i < 4; $i++) $size /= 1024;
        return round($size, 2).$units[$i];
    }

    /**
     * 把返回的数据集转换成Tree
     * @param array $list
     * @param string $pk
     * @param string $pid
     * @param string $child
     * @param string $root
     * @return array
     */
    public static function listToTree(
        array $list,
        $pk = 'id',
        $pid = 'parentId',
        $child = 'children',
        $root = '0'
    ) {

        if (count($list) == 1) {
            return $list;
        }

        $tree = [];
        if (is_array($list)) {
            $refer = [];
            foreach ($list as $key => $data) {
                $refer[$data[$pk]] = &$list[$key];
            }
            foreach ($list as $key => $data) {
                $parentId = $data[$pid];
                if ($root == $parentId) {
                    $tree[] = &$list[$key];
                } else {
                    if (isset($refer[$parentId])) {
                        $parent           = &$refer[$parentId];
                        $parent[$child][] = &$list[$key];
                    }
                }
            }
        }
        return $tree;
    }


    /**
     * 获取ms时间戳
     * @return int
     */
    public static function milliseconds(){
        return intval(microtime(true)*1000);
    }
}