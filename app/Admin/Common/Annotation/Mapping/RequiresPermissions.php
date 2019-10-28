<?php


namespace App\Admin\Common\Annotation\Mapping;

use Doctrine\Common\Annotations\Annotation\Attribute;
use Doctrine\Common\Annotations\Annotation\Attributes;
use Doctrine\Common\Annotations\Annotation\Target;

/**
 * @since 2.0
 *
 * @Annotation
 *
 * @Target("METHOD")
 * @Attributes({
 *     @Attribute("value", type="array")
 * })
 */
class RequiresPermissions
{
    /**
     * @var array
     */
    private $value = [];

    /**
     * @var string
     */
    private $logical = Logical::OR;

    public function __construct(array $values)
    {
        if (isset($values['value'])){
            $this->value = $values['value'];
        }
        if (isset($values['logical'])){
            $this->logical = $values['logical'];
        }
    }

    /**
     * @return string
     */
    public function getLogical(): string
    {
        return $this->logical;
    }

    /**
     * @param string $logical
     */
    public function setLogical(string $logical)
    {
        $this->logical = $logical;
    }

    /**
     * @return array
     */
    public function getValue(): array
    {
        return $this->value;
    }

    /**
     * @param array $value
     */
    public function setValue(array $value)
    {
        $this->value = $value;
    }


}