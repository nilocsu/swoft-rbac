<?php


namespace App\Admin\Common\Controller;

use App\Admin\Common\Util\Utils;
use App\Admin\Util\ResultData;
use Swoft\Db\DB;
use Swoft\Http\Message\Request;
use Swoft\Http\Message\Response;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Log\Helper\CLog;
use Swoft\Log\Helper\Log;

/**
 * @Controller("system")
 */
class InformationController
{
    /**
     * @RequestMapping("information", method={RequestMethod::GET})
     */
    public function information()
    {
        $mysqlVersion = DB::select('select version()');

        return [
            'mysqlVersion'       => substr($mysqlVersion[0]['version()'], 0, 6),
            'upSize'             => env('PACKAGE_MAX_LENGTH'),
            'max_execution_time' => ($max = ini_get('max_execution_time') == 0) ? "不限制" : $max,
            'free_space'         => Utils::getSize(disk_free_space('/')),
            'env'                => [
                'os'            => \PHP_OS,
                'phpVersion'    => \PHP_VERSION,
                'swooleVersion' => \SWOOLE_VERSION,
                'swoftVersion'  => \Swoft::VERSION,
            ],
        ];
    }

    /**
     * 日记文件
     * @RequestMapping("logs")
     */
    public function logs()
    {
        return ResultData::success($this->getFiles("@runtime/logs/"));
    }


    /**
     * 查看文件
     * @RequestMapping("runtimeFile")
     * @param  Request $request
     * @return array
     */
    public function runtimeFile(Request $request)
    {
        $path = $request->get("path");
        $path = $this->getPath($path);
        return ResultData::success($this->getLastLines($path, 300));
    }

    /**
     * 下载日记文件
     * @RequestMapping("runtimeDown")
     * @param  Request $request
     * @param  Response $response
     * @return Response
     */
    public function runtimeDown(Request $request, Response $response)
    {
        $path     = $request->get("path");
        $path     = $this->getPath($path);
        $fileName = pathinfo($path, PATHINFO_BASENAME);
        $response->getCoResponse()->header('Content-Disposition', "attachment; filename={$fileName}");
        return $response->file($path, "application/octet-stream");
    }

    /**
     * 过滤不安全的路径
     * @param $path
     * @return string
     */
    private function getPath($path)
    {
        $path = str_replace('..', '', $path);
        if ($path{0} != "@") {
            Log::error("不能使用非 @ 开头路径");
            CLog::error("不能使用非 @ 开头路径");
            return "";
        }
        return alias($path);
    }

    /**
     * 获取目录下文件列表
     * @param $path
     * @return array
     */
    private function getFiles($path)
    {
        $root = alias($path);
        $list = scandir($root);
        $arr  = [];
        foreach ($list as $key => $item) {
            if (in_array($item, ['', '.', '..']) || is_dir($root . $item)) {
                continue;
            }
            $arr[] = [
                'path' => $path . $item,
                'size' => filesize($root . $item),
            ];
        }
        return $arr;
    }


    /**
     * 读取文件尾数行数
     * @param $file
     * @param  int $line
     * @return string
     */
    private function getLastLines($file, $line = 1)
    {
        if (!$fp = fopen($file, 'r')) {
            Log::error("不能打开文件{$file}");
            CLog::error("不能打开文件{$file}");
            return "不能打开文件{$file}";
        }
        $pos  = -2;
        $eof  = "";
        $str  = "";
        $head = false;
        while ($line > 0) {
            while ($eof != "\n") {
                if (!fseek($fp, $pos, SEEK_END)) {
                    $eof = fgetc($fp);
                    $pos--;
                } else {
                    fseek($fp, 0, SEEK_SET);
                    $head = true;
                    break;
                }
            }
            $str .= fgets($fp);
            if ($head) {
                break;
            }
            $eof = "";
            $line--;
        }
        return $str;
    }
}