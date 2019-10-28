<?php


namespace App\Admin\Util;


class ResultData
{

    const CODE_SUCCESS = 0;
    const CODE_ERROR   = 1;

    /**
     * 成功时返回接口
     * @param  $data
     * @param string $msg
     * @param int $code
     * @return array
     */
    public static function success($data = null, string $msg = 'success', int $code = self::CODE_SUCCESS): array
    {

        $result = [
            'code' => $code,
            'msg'  => $msg,
            'data' => $data ?? [],
        ];

        return $result;
    }

    /**
     * 失败时返回接口
     * @param string $msg
     * @param int $code
     * @return array
     */
    public static function failed(string $msg, int $code = self::CODE_ERROR): array
    {
        $return = [
            'code' => $code,
            'msg'  => $msg,
        ];

        return $return;
    }

}