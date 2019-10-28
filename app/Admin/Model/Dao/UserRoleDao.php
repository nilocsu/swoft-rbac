<?php


namespace App\Admin\Model\Dao;

use App\Model\Entity\TUserRole;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 */
class UserRoleDao
{
    public function deleteByUserId(int $id)
    {
        TUserRole::where('user_id', $id)->delete();
    }

    public function deleteByRoleId(int $id)
    {
        TUserRole::where('role_id', $id)->delete();
    }
}