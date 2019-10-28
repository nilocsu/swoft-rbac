<?php declare(strict_types=1);


namespace App\Model\Entity;

use Swoft\Db\Annotation\Mapping\Column;
use Swoft\Db\Annotation\Mapping\Entity;
use Swoft\Db\Annotation\Mapping\Id;
use Swoft\Db\Eloquent\Model;


/**
 * 
 * Class TRoleMenu
 *
 * @since 2.0
 *
 * @Entity(table="t_role_menu")
 */
class TRoleMenu extends Model
{
    /**
     * 
     *
     * @Column(name="role_id", prop="roleId")
     *
     * @var int
     */
    private $roleId;

    /**
     * 
     *
     * @Column(name="menu_id", prop="menuId")
     *
     * @var int
     */
    private $menuId;


    /**
     * @param int $roleId
     *
     * @return void
     */
    public function setRoleId(int $roleId): void
    {
        $this->roleId = $roleId;
    }

    /**
     * @param int $menuId
     *
     * @return void
     */
    public function setMenuId(int $menuId): void
    {
        $this->menuId = $menuId;
    }

    /**
     * @return int
     */
    public function getRoleId(): ?int
    {
        return $this->roleId;
    }

    /**
     * @return int
     */
    public function getMenuId(): ?int
    {
        return $this->menuId;
    }

}
