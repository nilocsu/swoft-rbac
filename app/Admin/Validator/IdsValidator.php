<?php


namespace App\Admin\Validator;


use Swoft\Validator\Annotation\Mapping\IsArray;
use Swoft\Validator\Annotation\Mapping\NotEmpty;
use Swoft\Validator\Annotation\Mapping\Validator;

/**
 * @Validator(name="IdsValidator")
 */
class IdsValidator
{
    /**
     * @NotEmpty(message="ids不能为空")
     * @IsArray(message="ids必须是数组")
     * @var array
     */
    protected $ids = [];
}