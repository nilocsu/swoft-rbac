<?php


namespace App\Admin\Common\Aspect;

use App\Admin\Common\Annotation\Mapping\Logical;
use App\Admin\Common\Annotation\Parser\RequiresPermissionsRegister;
use App\Admin\Common\Service\CacheService;
use App\Admin\Common\Util\Auth;
use App\Admin\Exception\AuthorizationException;
use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\PointAnnotation;
use App\Admin\Common\Annotation\Mapping\RequiresPermissions;
use Swoft\Aop\Point\ProceedingJoinPoint;
use Swoft\Aop\Proxy;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Aspect()
 * @PointAnnotation(
 *     include={RequiresPermissions::class}
 * )
 */
class RequiresPermissionsAspect
{
    /**
     * @Inject()
     * @var CacheService
     */
    private $cacheService;

    /**
     * @Around()
     * @param ProceedingJoinPoint $proceedingJoinPoint
     * @return mixed
     * @throws AuthorizationException
     */
    public function around(ProceedingJoinPoint $proceedingJoinPoint)
    {

//        $args      = $proceedingJoinPoint->getArgs();
        $target    = $proceedingJoinPoint->getTarget();
        $method    = $proceedingJoinPoint->getMethod();
        $className = get_class($target);
        $className = Proxy::getOriginalClassName($className);


        $requiresPermissions = RequiresPermissionsRegister::getRequiresPermissions($className, $method);

        $permissionsList = $this->cacheService->getPermissions(Auth::admin()->getUsername());
        $access          = false;

        if ($requiresPermissions['logical'] === Logical:: OR) {
            foreach ($requiresPermissions['value'] as $permission) {
                if (in_array($permission, $permissionsList)) {
                    $access = true;
                    break;
                }
            }
        } elseif ($requiresPermissions['logical'] === Logical:: NOT) {
            $access = !!array_diff($requiresPermissions['value'], $permissionsList);
        } else {
            // 返回空数组则是包含权限，否则不包含
            $access = !array_diff($requiresPermissions['value'], $permissionsList);
        }
        if (!$access) {
            throw new AuthorizationException('access', 403);
        }

        return $proceedingJoinPoint->proceed();
    }
}