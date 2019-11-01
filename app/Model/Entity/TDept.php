<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class TDept
 *
 * @since 2.0
 *
 * @Entity(table="t_dept")
 */
class TDept extends Model
{
    /**
     * 部门ID
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 上级部门ID
     *
     * @Column(name="parent_id", prop="parentId")
     *
     * @var int
     */
    private $parentId;

    /**
     * 部门名称
     *
     * @Column(name="dept_name", prop="deptName")
     *
     * @var string
     */
    private $deptName;

    /**
     * 排序
     *
     * @Column(name="order_num", prop="orderNum")
     *
     * @var float|null
     */
    private $orderNum;

    /**
     * 
     *
     * @Column(name="created_at", prop="createdAt")
     *
     * @var string|null
     */
    private $createdAt;

    /**
     * 
     *
     * @Column(name="updated_at", prop="updatedAt")
     *
     * @var string|null
     */
    private $updatedAt;


    /**
     * @param int $id
     *
     * @return void
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @param int $parentId
     *
     * @return void
     */
    public function setParentId(int $parentId): void
    {
        $this->parentId = $parentId;
    }

    /**
     * @param string $deptName
     *
     * @return void
     */
    public function setDeptName(string $deptName): void
    {
        $this->deptName = $deptName;
    }

    /**
     * @param float|null $orderNum
     *
     * @return void
     */
    public function setOrderNum(?float $orderNum): void
    {
        $this->orderNum = $orderNum;
    }

    /**
     * @param string|null $createdAt
     *
     * @return void
     */
    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @param string|null $updatedAt
     *
     * @return void
     */
    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    /**
     * @return string
     */
    public function getDeptName(): ?string
    {
        return $this->deptName;
    }

    /**
     * @return float|null
     */
    public function getOrderNum(): ?float
    {
        return $this->orderNum;
    }

    /**
     * @return string|null
     */
    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

}
