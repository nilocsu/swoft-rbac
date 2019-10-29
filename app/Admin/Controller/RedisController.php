<?php


namespace App\Admin\Controller;

use App\Admin\Common\Service\RedisService;
use App\Admin\Util\ResultData;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;

/**
 * @Controller("system/redis")
 */
class RedisController
{
    /**
     * @Inject()
     * @var RedisService
     */
    private $redisService;

    /**
     * @RequestMapping("info")
     */
    public function getRedisInfo()
    {
        return ResultData::success($this->redisService->getRedisInfo());
    }

    /**
     * @RequestMapping("keysSize")
     */
    public function getKeysSize()
    {
        $this->redisService->getRedisInfo();
        return ResultData::success($this->redisService->getKeysSize());
    }

    /**
     * @RequestMapping("memoryInfo")
     */
    public function getMemoryInfo()
    {
        return ResultData::success($this->redisService->getMemoryInfo());
    }
}