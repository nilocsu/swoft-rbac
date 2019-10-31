<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class TMenu
 *
 * @since 2.0
 *
 * @Entity(table="t_menu")
 */
class TMenu extends Model
{
    /**
     * 菜单/按钮ID
     * @Id()
     * @Column()
     *
     * @var int
     */
    private $id;

    /**
     * 上级菜单ID
     *
     * @Column(name="parent_id", prop="parentId")
     *
     * @var int
     */
    private $parentId;

    /**
     * 菜单/按钮名称
     *
     * @Column(name="menu_name", prop="menuName")
     *
     * @var string
     */
    private $menuName;

    /**
     * 对应组件name
     *
     * @Column()
     *
     * @var string|null
     */
    private $name;

    /**
     * 对应路由path
     *
     * @Column()
     *
     * @var string|null
     */
    private $path;

    /**
     * 对应路由组件component
     *
     * @Column()
     *
     * @var string|null
     */
    private $component;

    /**
     * 权限标识
     *
     * @Column()
     *
     * @var string|null
     */
    private $perms;

    /**
     * 图标
     *
     * @Column()
     *
     * @var string|null
     */
    private $icon;

    /**
     * 类型 0菜单 1按钮
     *
     * @Column()
     *
     * @var string
     */
    private $type;

    /**
     * 排序
     *
     * @Column()
     *
     * @var float|null
     */
    private $sort;

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
     * @param string $menuName
     *
     * @return void
     */
    public function setMenuName(string $menuName): void
    {
        $this->menuName = $menuName;
    }

    /**
     * @param string|null $name
     *
     * @return void
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string|null $path
     *
     * @return void
     */
    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    /**
     * @param string|null $component
     *
     * @return void
     */
    public function setComponent(?string $component): void
    {
        $this->component = $component;
    }

    /**
     * @param string|null $perms
     *
     * @return void
     */
    public function setPerms(?string $perms): void
    {
        $this->perms = $perms;
    }

    /**
     * @param string|null $icon
     *
     * @return void
     */
    public function setIcon(?string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @param string $type
     *
     * @return void
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @param float|null $sort
     *
     * @return void
     */
    public function setSort(?float $sort): void
    {
        $this->sort = $sort;
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
    public function getMenuName(): ?string
    {
        return $this->menuName;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @return string|null
     */
    public function getPath(): ?string
    {
        return $this->path;
    }

    /**
     * @return string|null
     */
    public function getComponent(): ?string
    {
        return $this->component;
    }

    /**
     * @return string|null
     */
    public function getPerms(): ?string
    {
        return $this->perms;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @return string
     */
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @return float|null
     */
    public function getSort(): ?float
    {
        return $this->sort;
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
