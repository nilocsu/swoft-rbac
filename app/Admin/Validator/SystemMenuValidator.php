<?php


namespace App\Admin\Validator;

use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * @Validator(name="SystemMenuValidator")
 */
class SystemMenuValidator
{
    /**
     * @IsInt()
     * @var int
     */
    protected $parentId = 0;

    /**
     * @IsString()
     * @NotEmpty(message="菜单/按钮不能为空")
     * @var string
     */
    protected $menuName;

    /**
     * @IsString()
     * @var string
     */
    protected $icon = '';

    /**
     * @IsInt()
     * @var int
     */
    protected $sort = 0;

    /**
     * @IsInt()
     * @var int
     */
    protected $type = 1;

    /**
     * @IsString()
     * @var string
     */
    protected $perms = '';

    /**
     * @IsString()
     * @var string
     */
    protected $path = '';
}