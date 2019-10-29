<?php


namespace App\Admin\Common\Aspect;


use App\Admin\Common\Annotation\Mapping\Logical;
use App\Admin\Common\Annotation\Parser\RequiresRoleRegister;
use App\Admin\Common\Service\CacheService;
use App\Admin\Common\Util\Auth;
use App\Admin\Exception\AuthorizationException;
use Swoft\Aop\Annotation\Mapping\Around;
use Swoft\Aop\Annotation\Mapping\Aspect;
use Swoft\Aop\Annotation\Mapping\PointAnnotation;
use App\Admin\Common\Annotation\Mapping\RequiresRoles;
use Swoft\Aop\Point\ProceedingJoinPoint;
use Swoft\Aop\Proxy;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Aspect()
 * @PointAnnotation(
 *     include={RequiresRoles::class}
 * )
 */
class RequiresRolesAspect
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

        $target    = $proceedingJoinPoint->getTarget();
        $method    = $proceedingJoinPoint->getMethod();
        $className = get_class($target);
        $className = Proxy::getOriginalClassName($className);

        $requiresRoles = RequiresRoleRegister::getRequiresRoles($className, $method);

        $rolesList = $this->cacheService->getRoles(Auth::admin()->getUsername(), 'perms');
        $access    = false;

        if ($requiresRoles['logical'] === Logical:: OR) {
            foreach ($requiresRoles['value'] as $role) {
                if (in_array($role, $rolesList)) {
                    $access = true;
                    break;
                }
            }
        } elseif ($requiresRoles['logical'] === Logical:: NOT) {
            $access = !!array_diff($requiresRoles['value'], $rolesList);
        } else {
            // 返回空数组则是包含权限，否则不包含
            $access = !array_diff($requiresRoles['value'], $rolesList);
        }
        if (!$access) {
            throw new AuthorizationException('Forbidden', 403);
        }

        return $proceedingJoinPoint->proceed();
    }
}