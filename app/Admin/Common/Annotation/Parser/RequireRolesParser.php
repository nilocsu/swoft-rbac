<?php


namespace App\Admin\Common\Annotation\Parser;


use App\Admin\Common\Annotation\Mapping\RequiresRoles;
use Prophecy\Exception\Doubler\ReturnByReferenceException;
use Swoft\Annotation\Annotation\Mapping\AnnotationParser;
use Swoft\Annotation\Annotation\Parser\Parser;

/**
 * @since 2.0
 *
 * @AnnotationParser(RequiresRoles::class)
 */
class RequireRolesParser extends  Parser
{

    /**
     * @param int $type
     * @param RequiresRoles $annotationObject
     *
     * @return array
     * @throws ReturnByReferenceException
     */
    public function parse(int $type, $annotationObject): array
    {
        if ($type != self::TYPE_METHOD){
            return [];
        }
        RequiresRoleRegister::registerRequiresRoles($this->className, $this->methodName, $annotationObject);
        return [];
    }
}