<?php


namespace App\Admin\Common\Annotation\Parser;


use App\Admin\Common\Annotation\Mapping\RequiresRoles;
use App\Admin\Common\Exception\RequiresRolesException;

/**
 * @since 2.0
 */
class RequiresRoleRegister
{

    private static $requiresRoles = [];

    /**
     * @param string $className
     * @param string $method
     * @param RequiresRoles $requiresRoles
     * @throws RequiresRolesException
     */
    public static function registerRequiresRoles(
        string $className,
        string $method,
        RequiresRoles $requiresRoles
    ) {
        if (isset(self::$requiresRoles[$className][$method])) {
            throw new RequiresRolesException(
                sprintf('`@RequiresRoles` must be only one on method(%s->%s)!', $className, $method)
            );
        }
        self::$requiresRoles[$className][$method] = [
            'value'   => $requiresRoles->getValue(),
            'logical' => $requiresRoles->getLogical(),
        ];
    }

    /**
     * @param string $className
     * @param string $method
     *
     * @return array
     */
    public static function getRequiresRoles(string $className, string $method): array
    {
        return self::$requiresRoles[$className][$method];
    }
}