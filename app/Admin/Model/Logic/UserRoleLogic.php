<?php


namespace App\Admin\Model\Logic;

use App\Model\Entity\TUserRole;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 */
class UserRoleLogic
{

    /**
     * @param array $roleIds
     * @return int|mixed
     */
    public function deleteByRoleId(array $roleIds){
        return TUserRole::whereIn('role_id', $roleIds)->delete();
    }

    /**
     * @param array $userIds
     * @return int|mixed
     */
    public function deleteByUserId(array $userIds){
        return TUserRole::whereIn('user_id', $userIds)->delete();
    }

    /**
     * @param array $roleIds
     * @return array
     */
    public function findUserIdsByRoleIds(array $roleIds){
        return TUserRole::whereIn('role_id', $roleIds)->get()->pluck('user_id')->toArray();
    }
}