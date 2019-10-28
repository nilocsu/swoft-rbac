<?php


namespace App\Admin\Model\Logic;


use App\Admin\Model\Dao\RoleDao;
use App\Admin\Model\Data\UserData;
use App\Model\Entity\TRole;
use App\Model\Entity\TRoleMenu;
use App\Model\Entity\TUserRole;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;

/**
 * @Bean()
 */
class RoleLogic
{
    /**
     * @Inject()
     * @var RoleMenuLogic
     */
    private $roleMenuLogic;

    /**
     * @Inject()
     * @var UserRoleLogic
     */
    private $userRoleLogic;

    /**
     * @Inject()
     * @var RoleDao
     */
    private $roleDao;

    /**
     * @Inject()
     * @var UserData
     */
    private $userData;

    /**
     * @param array $data
     * @return array
     */
    public function findRoles(array $data)
    {
        $query = TRole::query();
        if (isset($data['createTimeFrom']) && isset($data['createTimeTo'])) {
            $query->whereBetween('created_at', [$data['createTimeFrom'], $data['createTimeTo']]);
        }
        $roles = [];
        if (isset($data['filter'])) {
            $filter = (array)json_decode($data['filter']);
            if (isset($filter['name'])) {
                $query->where('name', 'like', $filter['name'] . '%');
            }
            if (isset($filter['perms'])) {
                $query->where('perms', 'like', $filter['perms'] . '%');
            }
            if (isset($filter['username'])) {
                $roles = $this->userData->getUserRoles($filter['username']);
            }
        }

        $page     = max($data['page'] ?? 1, 1);
        $pageSize = max($data['pageSize'] ?? 20, 0) ?? 20;
        $offset   = ($page - 1) * $pageSize;

        return [
            'total'   => $query->count(),
            'page'    => $page,
            'data'    => $query->offset($offset)->limit((int)$pageSize)->get(),
            'hasRole' => $roles,
        ];
    }

    public function getRole(int $roleId)
    {
        return TRole::where('id', $roleId)->firstOrFail();
    }

    /**
     * @param string $username
     * @return array
     */
    public function findUserRole(string $username)
    {
        return $this->roleDao->findUserRole($username);
    }

    /**
     * @param string $roleName
     * @return TRole
     */
    public function findByName(string $roleName)
    {
        /* @var TRole $role */
        $role = TRole::where('name', $roleName)->first();
        return $role;
    }

    /**
     * @param array $data
     */
    public function createRole(array $data)
    {
        $role = new TRole();
        $role->setName($data['name']);
        $role->setRemark($data['remark']);
        $role->setPerms($data['perms']);
        $role->save();
    }

    /**
     * @param array $roleIds
     */
    public function deleteRoles(array $roleIds)
    {

        // 查找这些角色关联了那些用户
        $userIds = $this->userRoleLogic->findUserIdsByRoleIds($roleIds);

        $this->roleMenuLogic->deleteByRoleId($roleIds);
        $this->userRoleLogic->deleteByRoleId($roleIds);

        TRole::whereIn('id', $roleIds)->delete();

        // 重新将这些用户的角色和权限缓存到 Redis中
        $this->userData->loadUserPermissionRoleRedisCache($userIds);
    }

    public function updateRole($roleId, array $data)
    {
        /* @var TRole $role */
        $role    = TRole::where('id', $roleId)->firstOrFail();
        $roleIds = [$roleId];

        $role->setName($data['name']);
        $role->setRemark($data['remark']);
        $role->setPerms($data['perms']);
        $role->update();
        // 查找这些角色关联了那些用户
        $userIds = $this->userRoleLogic->findUserIdsByRoleIds($roleIds);
        // 重新将这些用户的角色和权限缓存到 Redis中
        $this->userData->loadUserPermissionRoleRedisCache($userIds);

    }

    /**
     *  获取角色关联用户ids
     * @param int $roleId
     * @return array
     */
    public function findRoleUserIds(int $roleId)
    {
        return TUserRole::where('role_id', $roleId)->get(['user_id'])->pluck('user_id')->toArray();
    }

    /**
     * 获取角色关联菜单ids
     * @param int $roleId
     * @return array
     */
    public function findRoleMenuIds(int $roleId)
    {
        return TRoleMenu::where('role_id', $roleId)->get(['menu_id'])->pluck('menu_id')->toArray();
    }

    /**
     * 更新角色跟菜单的关联
     * @param $roleId
     * @param $menuIds
     */
    public function updateRoleMenu($roleId, $menuIds)
    {
        /* @var TRole $role */
        TRole::where('id', $roleId)->firstOrFail();

        // 查找这些角色关联了那些用户
        $userIds = $this->userRoleLogic->findUserIdsByRoleIds([$roleId]);
        // 删除role_menu存在的关系
        TRoleMenu::where('role_id', $roleId)->delete();
        if (count($menuIds)>0) {
            $batch = [];
            foreach ($menuIds as $id) {
                $batch[] = [
                    'role_id' => $roleId,
                    'menu_id' => $id,
                ];
            }
            // 保存role-menu的关系
            TRoleMenu::insert($batch);
        }

        // 重新将这些用户的角色和权限缓存到 Redis中
        $this->userData->loadUserPermissionRoleRedisCache($userIds);
    }
}