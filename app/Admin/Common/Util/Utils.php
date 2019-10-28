<?php


namespace App\Admin\Common\Util;


use Swoft\Log\Helper\Log;

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
    public static function routeMenuToTree(
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
                $list[$key]['mate'] = [
                    'cache' => true,
                ];
                $refer[$data[$pk]]  = &$list[$key];
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