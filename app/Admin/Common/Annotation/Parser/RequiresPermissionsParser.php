<?php


namespace App\Admin\Common\Annotation\Parser;


use App\Admin\Common\Annotation\Mapping\RequiresPermissions;
use Prophecy\Exception\Doubler\ReturnByReferenceException;
use Swoft\Annotation\Annotation\Mapping\AnnotationParser;
use Swoft\Annotation\Annotation\Parser\Parser;

/**
 * @since 2.0
 *
 * @AnnotationParser(RequiresPermissions::class)
 */
class RequiresPermissionsParser extends  Parser
{

    /**
     * @param int $type
     * @param RequiresPermissions $annotationObject
     *
     * @return array
     * @throws ReturnByReferenceException
     */
    public function parse(int $type, $annotationObject): array
    {
        if ($type != self::TYPE_METHOD){
            return [];
        }
        RequiresPermissionsRegister::registerRequiresPermissions($this->className, $this->methodName, $annotationObject);
        return [];
    }
}