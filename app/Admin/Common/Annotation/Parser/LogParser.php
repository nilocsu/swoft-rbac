<?php


namespace App\Admin\Common\Annotation\Parser;

use App\Admin\Common\Annotation\Mapping\Log;
use Prophecy\Exception\Doubler\ReturnByReferenceException;
use Swoft\Annotation\Annotation\Mapping\AnnotationParser;
use Swoft\Annotation\Annotation\Parser\Parser;

/**
 * @since 2.0
 *
 * @AnnotationParser(Log::class)
 */
class LogParser extends  Parser
{

    /**
     * @param int $type
     * @param Log $annotationObject
     *
     * @return array
     * @throws ReturnByReferenceException
     */
    public function parse(int $type, $annotationObject): array
    {
        if ($type != self::TYPE_METHOD){
            return [];
        }
        LogRegister::registerLogs($this->className, $this->methodName, $annotationObject);
        return [];
    }
}