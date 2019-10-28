<?php


namespace App\Admin\Model\Logic;

use App\Model\Entity\TRoleMenu;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 */
class RoleMenuLogic
{
    public function deleteByRoleId(array $roleIds){
        return TRoleMenu::whereIn('role_id', $roleIds)->delete();
    }

    public function deleteByMenuId(array $menuIds){
        return TRoleMenu::whereIn('menu_id', $menuIds)->delete();
    }

    public function getByRoleId(int $roleId){
        return TRoleMenu::where('role_id', $roleId)->get();
    }

}