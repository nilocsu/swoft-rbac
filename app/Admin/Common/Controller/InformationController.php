<?php


namespace App\Admin\Common\Controller;

use App\Admin\Common\Util\Utils;
use Swoft\Db\DB;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Stdlib\Helper\Sys;

/**
 * @Controller("system")
 */
class InformationController
{
    public static $stats =
        [
            'start_time' => '服务器启动时间',
            'connection_num' => '当前连接的数量',
            'accept_count' => '接受连接数',
            'close_count' => '当前关闭的连接数量',
            'tasking_num' => '当前正在排队的任务数',
            'request_count' => 'Server收到的请求次数',
            'worker_request_count' => '当前Worker进程收到的请求次数',
            'worker_dispatch_count' => 'master进程向当前Worker进程投递任务的计数',
            'coroutine_num' => '当前协程数量',
            'worker_num' => '当前进程启动数量',
        ];

    /**
     * @RequestMapping("information", method={RequestMethod::GET})
     */
    public function information()
    {
        $mysqlVersion = DB::select('select version()');
        return [
            'mysqlVersion' => substr($mysqlVersion[0]['version()'], 0, 6),
            'upSize' => Utils::getSize(env('PACKAGE_MAX_LENGTH')),
            'max_execution_time' => ($max = ini_get('max_execution_time') == 0) ? "不限制" : $max,
            'free_space' => Utils::getSize(disk_free_space('/')),
            'env' => [
                'os' => \PHP_OS,
                'phpVersion' => \PHP_VERSION,
                'swooleVersion' => \SWOOLE_VERSION,
                'swoftVersion' => \Swoft::VERSION,
            ],
            'swoole' => \server()->getSetting(),
        ];
    }

    /**
     * Get swoole server stats
     * @RequestMapping(route="stats", method=RequestMethod::GET)
     * @return array
     */
    public function stats(): array
    {
        if (!\server()) {
            return ['msg' => 'server is not running'];
        }
        $stat = \server()->getSwooleStats();
        $data = [];
        foreach ($stat as $k => $v) {
            if (isset(self::$stats[$k])) {
                if ($k == 'start_time') {
                    $v = date("Y-m-d H:i", $v);
                }
                $data[] = [
                    'value' => $v,
                    'key' => $k,
                    'description' => self::$stats[$k],
                ];

            }
        }
        return $data;
    }

    /**
     * get swoole info
     * @RequestMapping(route="processes", method=RequestMethod::GET)
     * @return array
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function process(): array
    {
        [$code, $return, $error] = Sys::run('ps aux | grep swoft');
        if ($code) {
            return ['code' => 404, 'msg' => $error];
        }
        return [
            'raw' => $return,
        ];
    }

    /**
     * @param string $str
     * @return array
     */
    private function formatSwooleInfo(string $str): array
    {
        $data = [];
        $lines = explode("\n", \trim($str));
        foreach ($lines as $line) {
            [$name, $value] = explode(' => ', $line);
            $data[] = [
                'name' => $name,
                'value' => $value,
            ];
        }
        return $data;
    }

    /**
     * Get swoole info
     * @RequestMapping(route="swoole-info", method=RequestMethod::GET)
     * @return array
     * @throws \InvalidArgumentException
     * @throws \RuntimeException
     */
    public function swoole(): array
    {
        [$code, $return, $error] = Sys::run('php --ri swoole');
        if ($code) {
            return ['code' => 404, 'msg' => $error];
        }
        // format
        $str = str_replace("\r\n", "\n", \trim($return));
        [, $enableStr, $directiveStr] = \explode("\n\n", $str);
        $directive = $this->formatSwooleInfo($directiveStr);
        array_shift($directive);
        return [
            'raw' => $return,
            'enable' => $this->formatSwooleInfo($enableStr),
            'directive' => $directive,
        ];
    }

    /**
     * Get php extensions list
     *
     * @RequestMapping(route="php-exts", method=RequestMethod::GET)
     * @return array
     */
    public function phpExt(): array
    {
        return get_loaded_extensions();
    }

}
