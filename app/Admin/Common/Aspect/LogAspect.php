<?php


namespace App\Admin\Common\Aspect;


use App\Admin\Common\Annotation\Parser\LogRegister;
use App\Admin\Common\Util\Auth;
use App\Admin\Common\Util\Ip2Region;
use App\Admin\Common\Util\Utils;
use App\Admin\Exception\AuthorizationException;
use App\Model\Entity\TLog;
use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\PointAnnotation;
use App\Admin\Common\Annotation\Mapping\Log;
use Swoft\Aop\Point\ProceedingJoinPoint;
use Swoft\Aop\Proxy;
use Swoft\Context\Context;

/**
 * @Aspect()
 * @PointAnnotation(
 *     include={Log::class}
 * )
 */
class LogAspect
{

    /**
     * @Around()
     * @param ProceedingJoinPoint $joinPoint
     * @return mixed
     * @throws AuthorizationException
     */
    public function around(ProceedingJoinPoint $joinPoint)
    {
        $t1 = Utils::milliseconds();
        // 执行方法
        $result = $joinPoint->proceed();
//        $args      = $joinPoint->getArgs();
        $target    = $joinPoint->getTarget();
        $method    = $joinPoint->getMethod();
        $className = get_class($target);
        $className = Proxy::getOriginalClassName($className);


        $value = LogRegister::getLogs($className, $method);

        $request = Context::get()->getRequest();
        $remoteAddress = $request->getServerParams()["remote_addr"];
        // 设置 IP 地址
        $ip2Region = new Ip2Region(\Swoft::getAlias('@resource') . '/data/ip2region.db');
        $ip = $ip2Region->btreeSearch($remoteAddress)['region'];
        // 执行时长(毫秒)
        $t2  = Utils::milliseconds();
        $time      =  $t2 - $t1;
        $log       = new TLog();
        $log->setUsername(Auth::admin()->getUsername());
        $log->setOperation($value['value']);
        $log->setIp($remoteAddress);
        $log->setLocation($ip);
        $log->setMethod($className . '->' . $method . '()');
        $log->setTime($time);
        $log->setParams(json_encode($request->getParsedBody()));
        $log->save();

        return $result;
    }
}