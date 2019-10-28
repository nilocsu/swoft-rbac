<?php


namespace App\Admin\Validator;

use Swoft\Validator\Annotation\Mapping\Enum;
use Swoft\Validator\Annotation\Mapping\IsInt;
use Swoft\Validator\Annotation\Mapping\IsString;
use Swoft\Validator\Annotation\Mapping\Mobile;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * @Validator(name="AdminValidator")
 */
class AdminValidator
{
    /**
     * @IsString()
     * @NotEmpty(message="用户名不能为空")
     * @var string
     */
    private $username;

    /**
     * @IsString()
     * @NotEmpty(message="密码不能为空")
     * @var string
     */
    private $password;

    /**
     * @IsString()
     * @NotEmpty(message="昵称/姓名不能为空")
     * @var string
     */
    private $realName;

    /**
     * @IsInt()
     * @Enum(values={0,1}, message="status参数错误")
     * @var int
     */
    private $status = 1;

    /**
     * @IsString()
     * @var string
     */
    private $mobile = '';


    /**
     * @IsInt()
     * @Enum(values={0,1,2}, message="性别参数错误")
     * @var int
     */
    private $sex = 2;

    /**
     * @IsString()
     * @var string
     */
    private $description = '';
}