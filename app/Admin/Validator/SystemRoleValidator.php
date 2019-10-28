<?php


namespace App\Admin\Validator;

use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * @Validator(name="SystemRoleValidator")
 */
class SystemRoleValidator
{
    /**
     * @IsString()
     * @NotEmpty(message="名称不能为空")
     * @var string
     */
    protected $name;

    /**
     * @IsString()
     * @var string
     */
    protected $description = '';

    /**
     * @IsString()
     * @var string
     */
    protected $perms = '';
}