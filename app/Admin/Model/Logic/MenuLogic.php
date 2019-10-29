<?php


namespace App\Admin\Model\Logic;

use App\Admin\Common\Util\Utils;
use App\Admin\Model\Dao\MenuDao;
use App\Admin\Model\Data\UserData;
use App\Model\Entity\TMenu;
use App\Model\Entity\TRoleMenu;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\Eloquent\Builder;

/**
 * @Bean()
 */
class MenuLogic
{

    /**
     * @Inject()
     * @var MenuDao
     */
    private $menuDao;

    /**
     * @Inject()
     * @var UserData
     */
    private $userData;

    /**
     * @param string $username
     * @return array
     */
    public function findUserPermissions(string $username)
    {
        return $this->menuDao->findUserPermissions($username);
    }

    /**
     * @param string $username
     * @return array
     */
    public function findUserMenus(string $username)
    {
        return $this->menuDao->findUserMenus($username);
    }

    public function findById(int $id)
    {
        return TMenu::where('id', $id)->firstOrFail();
    }

    /**
     * @param int $menuId
     * @return array
     */
    public function findUserIdsByMenuId(int $menuId)
    {
        return $this->menuDao->findUserIdsByMenuId($menuId);
    }

    /**
     * 通过子id获取父id集合
     * @param int $menuId
     * @return array
     */
    public function findMenuParentIds(int $menuId)
    {
        return $this->menuDao->findParentIds($menuId);
    }

    public function findAllMenus()
    {
        return Utils::listToTree(TMenu::where('type', '<>', '1')->orderBy('sort')->get([
            'id',
            'parent_id',
            'menu_name',
        ])->toArray());
    }

    /**
     * @return array
     */
    public function findMenus()
    {
        $query = TMenu::query();
        $count = $query->count();
        $list  = $query->get();
        return [
            'total' => $count,
            'data'  => Utils::listToTree($list->toArray()),
        ];
    }

    /**
     * @param array $data
     * @return \Swoft\Db\Eloquent\Collection
     */
    public function findMenuList(array $data)
    {
        $query = TMenu::query();
        $this->findMenuCondition($query, $data);
        return $query->get();
    }

    /**
     * @param array $data
     */
    public function createMenu(array $data)
    {
        $menu = new TMenu();
        $menu->setMenuName($data['menuName']);
        $menu->setPath($data['path'] ?? '');
        $menu->setParentId($data['parentId']);
        $menu->setComponent($data['component'] ?? '');
        $menu->setPerms($data['perms'] ?? '');
        $menu->setIcon($data['icon'] ?? '');
        $menu->setType($data['type'] ?? '1');
        $menu->setSort($data['sort'] ?? 1);
        $this->setMenu($menu);
        $menu->save();
    }

    public function updateMenu(int $id, array $data)
    {
        /* @var TMenu $menu */
        $menu = TMenu::where('id', $id)->firstOrFail();
        $perms = $data['perms'] == $menu->getPerms() ? true : false;
        $menu->setMenuName($data['menuName']);
        $menu->setPath($data['path'] ?? '');
        $menu->setParentId($data['parentId']);
        $menu->setComponent($data['component'] ?? '');
        $menu->setPerms($data['perms'] ?? '');
        $menu->setIcon($data['icon'] ?? '');
        $menu->setType($data['type'] ?? '1');
        $menu->setSort($data['sort'] ?? 1);
        $this->setMenu($menu);
        $menu->update();

        // 如果权限标识符改变了，需要更改缓存
        if (!$perms){
            // 查找与这些菜单/按钮关联的用户
            $userIds = $this->menuDao->findUserIdsByMenuId($id);
            if (!empty($userIds))
            {
                // 重新将这些用户的角色和权限缓存到 Redis中
                $this->userData->loadUserPermissionRoleRedisCache($userIds);
            }
        }
    }

    public function deleteMenus(array $menuIds)
    {
        TMenu::whereIn('id', $menuIds)->delete();
        foreach ($menuIds as $menuId) {
            $userIds = $this->menuDao->findUserIdsByMenuId($menuId);
            TRoleMenu::where('menu_id', $menuId)->delete();
            $this->userData->loadUserPermissionRoleRedisCache($userIds);
        }
    }

    private function setMenu(TMenu $menu)
    {
        if ($menu->getParentId() == null) {
            $menu->setParentId(0);
        }
        if ($menu->getType() === '1') {
            $menu->setPath(null);
            $menu->setIcon(null);
            $menu->setComponent(null);
        }
    }

    /**
     * @param Builder $builder
     * @param $query
     */
    private function findMenuCondition(Builder $builder, $query)
    {
        if (!empty($query['menuName'])) {
            $builder->where('menu_name', 'like', $query['menuName'] . '%');
        }
        if (!empty($query['type'])) {
            $builder->where('type', $query['type']);
        }
        if (!empty($query['createTimeFrom']) && !empty($query['createTimeTo'])) {
            $builder->whereBetween('created_at', [$query['createTimeFrom'], $query['createTimeTo']]);
        }
    }

}