<?php


namespace App\Admin\Model\Dao;

use App\Model\Entity\TMenu;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\DB;

/**
 * @Bean()
 */
class MenuDao
{
    /**
     * @param string $username
     * @return array
     */
    public function findUserPermissions(string $username)
    {
        $sql  = <<<sql
select distinct m.perms
        from t_role r
                 left join t_user_role ur on (r.id = ur.role_id)
                 left join t_user u on (u.id = ur.user_id)
                 left join t_role_menu rm on (rm.role_id = r.id)
                 left join t_menu m on (m.id = rm.menu_id)
        where u.username = ?
          and m.perms is not null
          and m.perms <> ''
sql;
        $list = DB::select($sql, [$username]);
        return array_column($list, 'perms');
    }

    /**
     * @param string $username
     * @return array
     */
    public function findUserMenus(string $username)
    {
        $sql  = <<<sql
select m.*
        from t_menu m
        where m.type <> 1
          and m.id in
              (select distinct rm.menu_id
               from t_role_menu rm
                        left join t_role r on (rm.role_id = r.id)
                        left join t_user_role ur on (ur.role_id = r.id)
                        left join t_user u on (u.id = ur.user_id)
               where u.username = ?)
        order by m.sort
sql;
        $data = DB::select($sql, [$username]);
        if (empty($data)) {
            return [];
        }
        $list = [];
        foreach ($data as $v) {
            $list[] = TMenu::new($v)->toArray();
        }
        return $list;
    }

    /**
     * @param int $menuId
     * @return array
     */
    public function findUserIdsByMenuId(int $menuId)
    {
        $sql  = <<<sql
SELECT
    user_id
FROM
    t_user_role
WHERE
    role_id IN ( SELECT rm.role_id FROM t_role_menu rm WHERE rm.menu_id = ? )
sql;
        $list = DB::select($sql, [$menuId]);
        return array_column($list, 'user_id');
    }

    public function findParentIds(int $menuId)
    {
        $sql  = <<<sql
SELECT T2.id
FROM ( 
    SELECT 
        @r AS _id, 
        (SELECT @r := parent_id FROM t_menu WHERE id = _id) AS parent_id, 
        @l := @l + 1 AS lvl 
    FROM 
        (SELECT @r := ?, @l := 0) vars, 
        t_menu h 
    WHERE @r <> 0) T1 
JOIN t_menu T2 
ON T1._id = T2.id 
ORDER BY T1.lvl DESC;
sql;
        $list = DB::select($sql, [$menuId]);
        return array_column($list, 'id');
    }

}