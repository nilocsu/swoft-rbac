<?php


namespace App\Admin\Common\Service;

use App\Admin\Common\Constant\FebConstant;
use App\Admin\Model\Dao\MenuDao;
use App\Admin\Model\Dao\RoleDao;
use App\Model\Entity\TUser;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Redis\Redis;

/**
 * @Bean()
 */
class CacheService
{
    /**
     * @Inject()
     * @var RoleDao
     */
    private $roleLogic;


    /**
     * @Inject()
     * @var MenuDao
     */
    private $menuDao;

    /**
     * @param string $username
     * @return TUser|bool|mixed|\Swoft\Db\Eloquent\Model|static
     */
    public function getUser(string $username)
    {
        $user = Redis::get(FebConstant::USER_CACHE_PREFIX . $username);
        if (empty($user)) {
            $user = TUser::where('username', $username)->firstOrFail();
            Redis::set(FebConstant::USER_CACHE_PREFIX . $username, serialize($user->attributesToArray()));
            /* @var TUser $user */
            return $user;
        }
        return TUser::new(unserialize($user));
    }

    /**
     * @param string $username
     * @return string[]|bool|mixed|\Swoft\Db\Eloquent\Model|static
     */
    public function getRoles(string $username)
    {
        $roles = Redis::get(FebConstant::USER_ROLE_CACHE_PREFIX . $username);
        if (empty($roles)) {
            $roles = $this->roleLogic->findUserRole($username);
            Redis::set(FebConstant::USER_ROLE_CACHE_PREFIX . $username, serialize($roles));
            return $roles;
        }
        return unserialize($roles);
    }


    /**
     * @param string $username
     * @return string[]|bool|mixed
     */
    public function getPermissions(string $username)
    {
        $roles = Redis::get(FebConstant::USER_PERMISSION_CACHE_PREFIX . $username);
        if (empty($roles)) {
            $roles = $this->menuDao->findUserPermissions($username);
            Redis::set(FebConstant::USER_PERMISSION_CACHE_PREFIX . $username, serialize($roles));
            return $roles;
        }
        return unserialize($roles);
    }

    public function getUserRouters(string $username)
    {
        return $this->menuDao->findUserMenus($username);
    }

    public function saveUser(string $username){
        $user = TUser::where('username', $username)->firstOrFail();
        $this->deleteUser($username);
        Redis::set(FebConstant::USER_CACHE_PREFIX . $username, serialize($user->attributesToArray()));
    }

    public function saveRoles(string $username)
    {
        $roleList = $this->roleLogic->findUserRole($username);
        $this->deleteRoles($username);
        Redis::set(FebConstant::USER_ROLE_CACHE_PREFIX . $username, serialize($roleList));
    }

    public function savePermissions(string $username){
        $roleList = $this->menuDao->findUserPermissions($username);
        $this->deletePermissions($username);
        Redis::set(FebConstant::USER_PERMISSION_CACHE_PREFIX . $username, serialize($roleList));

    }

    public function deleteUser(string $username)
    {
        $username = strtolower($username);
        Redis::del(FebConstant::USER_CACHE_PREFIX . $username);
    }

    public function deleteRoles(string $username)
    {
        $username = strtolower($username);
        Redis::del(FebConstant::USER_ROLE_CACHE_PREFIX . $username);
    }

    public function deletePermissions(string $username)
    {
        $username = strtolower($username);
        Redis::del(FebConstant::USER_PERMISSION_CACHE_PREFIX . $username);
    }
}