<?php


namespace App\Admin\Model\Logic;

use App\Admin\Common\Service\CacheService;
use App\Admin\Common\Util\Utils;
use App\Admin\Exception\AdminException;
use App\Admin\Model\Data\UserData;
use App\Admin\Util\ResultData;
use App\Model\Entity\TUser;
use App\Model\Entity\TUserRole;
use Carbon\Carbon;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;

/**
 * @Bean()
 */
class AdministratorLogic
{
    /**
     * @Inject()
     * @var CacheService
     */
    private $cacheService;

    /**
     * @Inject()
     * @var UserData
     */
    private $userData;

    /**
     * @param string $username
     * @return null|object|\Swoft\Db\Eloquent\Model|static
     */
    public function findByName(string $username)
    {
        return TUser::where('username', $username)->first();
    }

    /**
     * @param int $id
     * @return null|object|\Swoft\Db\Eloquent\Model|static
     */
    public function findById(int $id)
    {
        return TUser::where('id', $id)->first();
    }

    /**
     * @param array $data
     * @return array
     */
    public function findUserList(array $data)
    {
        $query = TUser::query();
        if (!empty($data['filter'])) {
            $filter = (array)json_decode($data['filter']);
            if (!empty($filter['name'])) {
                $query->where('real_name', 'like', $filter['name'] . '%');
            }
            if (!empty($filter['email'])) {
                $query->where('email', 'like', $filter['email'] . '%');
            }
        }
        if (!empty($data['sortBy']) && $data['sortBy'] === 'realName') $data['sortBy'] = 'real_name';
        return Utils::pageSort($query, $data['sortBy'], $data['descending'] ? 'desc' : 'asc');
    }

    public function updateLoginTime(string $username)
    {
        TUser::where('username', $username)->update(['last_login_time' => Carbon::now()->toDateTimeString()]);

        // 重新将用户信息加载到 redis中
        $this->cacheService->saveUser($username);
    }

    public function createUser(array $data)
    {
        if ($this->findByName($data['username'])) {
            throw new AdminException('账号已存在', ResultData::CODE_ERROR);
        };
        $user = new TUser();
        $user->setUsername($data['username']);
        $user->setRealName($data['realName']);
        $user->setPassword(md5(md5($data['password'])));
        $user->setDeptId($data['deptId'] ?? 0);
        $user->setEmail($data['email']);
        $user->setMobile($data['mobile']);
        $user->setStatus($data['status']);
        $user->save();

        if (!empty($data['roles'])) {
            // 保存用户角色
            $this->setUserRoles($user->getId(), $data['roles']);
            // 将用户相关信息保存到 Redis中
            $this->userData->loadUserRedisCache($user);
        }
    }

    public function updateUser(int $userId, array $data)
    {
        /* @var TUser $user */
        $user = TUser::where('id', $userId)->first();
        $user->setRealName($data['realName']);
        $user->setEmail($data['email']);
        $user->setMobile($data['mobile']);
        $user->setSex($data['sex']);
        $user->setStatus($data['status']);
        $user->setDescription($data['description']);
        $user->update();
    }

    /**
     *  获取用户关联角色ids
     * @param int $userId
     * @return array
     */
    public function findUserRoleIds(int $userId)
    {
        return TUserRole::where('user_id', $userId)->get(['role_id'])->pluck('role_id')->toArray();
    }


    /**
     * 单个用户更新角色关系
     * @param int $userId
     * @param int $roleId
     * @param int $action
     * @throws AdminException
     */
    public function updateUserRole(int $userId, int $roleId, int $action)
    {
        $userRole = TUserRole::where('role_id', $roleId)->where('user_id', $userId)->first();

        /* @var TUser $user */
        $user = TUser::where('id', $userId)->firstOrFail();
        /// 更新用户角色关系
        if ($action == 1) {
            if (!empty($userRole)) {
                throw new AdminException('角色已存在,', 500);
            }
            $this->setUserRoles($userId, [$roleId]);
        } else { // 删除角色关系
            if (empty($userRole)) {
                throw new AdminException('角色不存在存在', 404);
            }
            TUserRole::where('role_id', $roleId)->where('user_id', $userId)->delete();
        }
        // 重新将用户角色信息，用户权限信息 加载到 redis中
        $this->cacheService->saveRoles($user->getUsername());
        $this->cacheService->savePermissions($user->getUsername());
    }

    public function deleteUser(array $userIds)
    {
        // 先删除相应的缓存
        $this->userData->deleteUserRedisCache($userIds);

        TUser::whereIn('id', $userIds)->delete();
        TUserRole::whereIn('user_id', $userIds);
    }

    public function updateProfile(string $username, array $data)
    {
        /* @var TUser $user */
        $user = TUser::where('username', $username)->firstOrFail();
        $user->setRealName($data['realName']);
        $user->setEmail($data['email']);
        $user->setMobile($data['mobile']);
        $user->setDescription($data['description']);
        $user->setSex($data['sex']);
        $user->update();
        // 重新缓存用户信息
        $this->cacheService->saveUser($username);
    }

    public function updateAvatar(string $username, string $avatar)
    {
        /* @var TUser $user */
        $user = TUser::where('username', $username)->first();
        $user->setAvatar($avatar);
        $user->update();
        // 重新缓存用户信息
        $this->cacheService->saveUser($username);
    }

    public function updatePassword(string $username, string $oldPassword, string $newPassword)
    {
        /* @var TUser $user */
        $user = TUser::where('username', $username)->firstOrFail();
        if (strcmp($user->getPassword(), md5(md5($oldPassword))) !== 0) {
            throw new \Exception('原密码不正确"');
        }
        $user->setPassword(md5(md5($newPassword)));
        $user->update();
    }

    public function setUserRoles(int $userId, array $roles)
    {
        $batch = [];
        foreach ($roles as $id) {
            $batch[] = [
                'role_id' => $id,
                'user_id' => $userId,
            ];
        }
        TUserRole::insert($batch);
    }
}