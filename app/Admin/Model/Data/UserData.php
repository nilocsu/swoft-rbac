<?php


namespace App\Admin\Model\Data;

use App\Admin\Common\Service\CacheService;
use App\Admin\Common\Util\Utils;
use App\Admin\Model\Dao\MenuDao;
use App\Model\Entity\TUser;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 */
class UserData
{


    /**
     * @Inject()
     * @var MenuDao
     */
    private $menuDao;

    /**
     * 通过用户名获取用户基本信息
     * @param string $username
     * @return \App\Model\Entity\TUser|bool|mixed|\Swoft\Db\Eloquent\Model|static
     */
    public function getUser(string $username)
    {
        $cache = \Swoft::getBean(CacheService::class);
        return $cache->getUser($username);
    }

    public function getUserRoles(string $username)
    {
        $cache = \Swoft::getBean(CacheService::class);
        return $cache->getRoles($username);
    }

    /**
     * 通过用户名获取用户权限集合
     * @param string $username
     * @return mixed
     */
    public function getUserPermissions(string $username)
    {
        $cache = \Swoft::getBean(CacheService::class);
        return $cache->getPermissions($username);
    }

    /**
     * 通过用户名构建 Vue路由
     * @param string $username
     * @return array
     */
    public function getUserRouters(string $username)
    {
        $menu = $this->menuDao->findUserMenus($username);
        return Utils::listToTree($menu);
    }

    /**
     * 将用户相关信息添加到 Redis缓存中
     * @param TUser $user
     */
    public function loadUserRedisCache(TUser $user)
    {
        $cache = \Swoft::getBean(CacheService::class);
        // 缓存用户
        $cache->saveUser($user->getUsername());
        // 缓存用户角色
        $cache->saveRoles($user->getUsername());
        // 缓存用户权限
        $cache->savePermissions($user->getUsername());
    }

    /**
     * 将用户角色和权限添加到 Redis缓存中
     * @param array $userIds
     */
    public function loadUserPermissionRoleRedisCache(array $userIds)
    {
        $cache = \Swoft::getBean(CacheService::class);
        foreach ($userIds as $id) {
            /* @var TUser $user */
            $user = TUser::find($id);
            if ($user != null) {
                // 缓存用户角色
                $cache->saveRoles($user->getUsername());
                // 缓存用户权限
                $cache->savePermissions($user->getUsername());
            }
        }
    }

    /**
     * 通过用户 id集合批量删除用户 Redis缓存
     * @param array $userIds
     */
    public function deleteUserRedisCache(array $userIds)
    {
        $cache = \Swoft::getBean(CacheService::class);
        foreach ($userIds as $id) {
            /* @var TUser $user */
            $user = TUser::where('id', $id)->first();
            if ($user != null) {
                $cache->deleteUser($user->getUsername());
                $cache->deleteRoles($user->getUsername());
                $cache->deletePermissions($user->getUsername());
            }
        }

    }
}