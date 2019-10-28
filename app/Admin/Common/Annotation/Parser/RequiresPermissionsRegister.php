<?php


namespace App\Admin\Common\Annotation\Parser;


use App\Admin\Common\Annotation\Mapping\RequiresPermissions;
use App\Admin\Exception\RequiresPermissionsException;

/**
 * @since 2.0
 */
class RequiresPermissionsRegister
{

    private static $requiresPermissions = [];

    /**
     * @param string $className
     * @param string $method
     * @param RequiresPermissions $requiresPermissions
     * @throws RequiresPermissionsException
     */
    public static function registerRequiresPermissions(
        string $className,
        string $method,
        RequiresPermissions $requiresPermissions
    ) {
        if (isset(self::$requiresPermissions[$className][$method])) {
            throw new RequiresPermissionsException(
                sprintf('`@RequiresPermissions` must be only one on method(%s->%s)!', $className, $method)
            );
        }
        self::$requiresPermissions[$className][$method] = [
            'value'   => $requiresPermissions->getValue(),
            'logical' => $requiresPermissions->getLogical(),
        ];
    }

    /**
     * @param string $className
     * @param string $method
     *
     * @return array
     */
    public static function getRequiresPermissions(string $className, string $method): array
    {
        return self::$requiresPermissions[$className][$method];
    }
}