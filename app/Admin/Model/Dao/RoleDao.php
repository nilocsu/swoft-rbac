<?php


namespace App\Admin\Model\Dao;

use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\DB;

/**
 * @Bean()
 */
class RoleDao
{
    /**
     * @param string $username
     * @return array
     */
    public function findUserRole(string $username)
    {
        $sql  = <<<sql
        select r.id, r.perms, r.name
        from t_role r
                 left join t_user_role ur on (r.id = ur.role_id)
                 left join t_user u on (u.id = ur.user_id)
        where u.username = ?
sql;
        return DB::select($sql, [$username]);
    }


    /**
     * @param string $username
     * @return array
     */
    public function findUserRoleIds(string $username)
    {
        $sql  = <<<sql
        select r.id
        from t_role r
                 left join t_user_role ur on (r.id = ur.role_id)
                 left join t_user u on (u.id = ur.user_id)
        where u.username = ?
sql;
        return DB::select($sql, [$username]);
    }
}