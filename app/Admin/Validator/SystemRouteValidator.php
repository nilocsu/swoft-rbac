<?php


namespace App\Admin\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * @Validator(name="SystemRouteValidator")
 */
class SystemRouteValidator
{
    /**
     * @IsInt()
     * @var int
     */
    protected $parentId = 0;

    /**
     * @IsString()
     * @NotEmpty(message="路径不能为空")
     * @var string
     */
    protected $path;

    /**
     * @IsString()
     * @NotEmpty(message="标题不能为空")
     * @var string
     */
    protected $title;

    /**
     * @IsString()
     * @var string
     */
    protected $permission = '';

    /**
     * @IsString()
     * @var string
     */
    protected $component = '';

    /**
     * @IsString()
     * @var string
     */
    protected $componentPath = '';

    /**
     * @IsInt()
     * @var int
     */
    protected $sort = 1;
    /**
     * @IsInt()
     * @var int
     */
    protected $cache = 1;
    /**
     * @IsInt()
     * @var int
     */
    protected $isLock = 1;
}