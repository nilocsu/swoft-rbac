<?php


namespace App\Admin\Controller;

use App\Admin\Common\Annotation\Mapping\Log;
use App\Admin\Common\Annotation\Mapping\RequiresPermissions;
use App\Admin\Common\Util\Auth;
use App\Admin\Common\Util\Utils;
use App\Admin\Exception\AuthorizationException;
use App\Admin\Model\Data\UserData;
use App\Admin\Model\Logic\AdministratorLogic;
use App\Admin\Model\Logic\DeptLogic;
use App\Admin\Model\Logic\RoleLogic;
use App\Admin\Util\ResultData;
use App\Model\Entity\TRole;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\DB;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Validator\Annotation\Mapping\Validate;
use Swoft\Validator\Exception\ValidatorException;

/**
 * @Controller(prefix="/system")
 */
class AdministratorController
{

    /**
     * @Inject()
     * @var AdministratorLogic
     */
    private $adminLogic;


    /**
     * @Inject()
     * @var UserData
     */
    private $userData;

    /**
     * @Inject()
     * @var RoleLogic
     */
    private $roleLogic;

    /**
     * @Inject()
     * @var DeptLogic
     */
    private $deptLogic;

    /**
     * @RequestMapping(route="admin", method={RequestMethod::GET})
     * @RequiresPermissions(value={"user:view"})
     * @param Request $request
     * @return array
     */
    public function getUserList(Request $request)
    {
        return ResultData::success($this->adminLogic->findUserList($request->input()));
    }

    /**
     * @RequestMapping(route="admin/{username}/menu")
     * @param string $username
     * @return array
     * @throws AuthorizationException
     */
    public function getUserRouters(string $username)
    {
        // 只能查查自己的路由表+授权
        // 管理员除外
        $user = Auth::admin();
        if ($user->getId() != 1 && $user->getUsername() !== $username) {
            throw new AuthorizationException('access', 403);
        }
        return ResultData::success(
            $this->userData->getUserRouters($user->getUsername())
        );
    }

    /**
     * @RequestMapping(route="admin/menu")
     * @return array
     * @throws AuthorizationException
     */
    public function getProfileMenus()
    {
        // 只能查查当前用户的路由表
        $user = Auth::admin();

        return ResultData::success([
            'menu'        => $this->userData->getUserRouters($user->getUsername()),
            'permissions' => $this->userData->getUserPermissions($user->getUsername()),
            'roles'       => $this->userData->getUserRoles($user->getUsername()),
            'dept'        => $this->deptLogic->findDeptName($user->getDeptId()),
        ]);
    }


    /**
     * @RequestMapping(route="admin/{id}/role", method={RequestMethod::GET}, params={"id"="\d+"})
     * @param int $id
     * @return array
     */
    public function getUserRole(int $id)
    {
        return ResultData::success(
            $this->adminLogic->findUserRoleIds($id)
        );
    }

    /**
     * @RequestMapping(route="admin/{id}/role", method={RequestMethod::PUT}, params={"id"="\d+"})
     * @RequiresPermissions(value={"role:update"})
     * @Log("更新用户角色")
     * @param int $id
     * @param Request $request
     * @return array
     */
    public function updateUserRole(int $id, Request $request)
    {
        DB::beginTransaction();
        try {
            $action = $request->post('action');
            $roleId = $request->post('roleId');
            $this->adminLogic->updateUserRole($id, (int)$roleId, (int)$action);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '更新用户角色失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     * @RequestMapping(route="admin/check", method={RequestMethod::GET})
     * @param Request $request
     * @return bool
     */
    public function checkName(Request $request)
    {
        $result = $this->adminLogic->findByName($request->input('username'));
        return $result == null;
    }

    /**
     * @RequestMapping(route="admin", method={RequestMethod::POST})
     * @RequiresPermissions(value={"user:add"})
     * @Log("新增用户")
     * @Validate(validator="AdminValidator")
     * @param Request $request
     * @return array
     */
    public function addUser(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->adminLogic->createUser($request->post());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '新增用户失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }


    /**
     * @RequestMapping(route="admin/{id}", method={RequestMethod::GET}, params={"id"="\d+"})
     * @RequiresPermissions(value={"user:view"})
     * @param int $id
     * @return array
     */
    public function getUser(int $id)
    {
        return ResultData::success(
            $this->adminLogic->findById($id));
    }

    /**
     * @RequestMapping(route="admin/{id}", method={RequestMethod::PUT}, params={"id"="\d+"})
     * @RequiresPermissions(value={"user:update"})
     * @Validate(validator="AdminValidator", unfields={"username", "password"})
     * @Log("更新用户")
     * @param int $id
     * @param Request $request
     * @return array
     */
    public function updateUser(int $id, Request $request)
    {
        DB::beginTransaction();
        try {
            $this->adminLogic->updateUser($id, $request->post());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '更新用户失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     * @RequestMapping(route="admin", method={RequestMethod::DELETE})
     * @RequiresPermissions(value={"user:delete"})
     * @Log("删除用户")
     * @param Request $request
     * @return array
     * @throws ValidatorException
     */
    public function deleteUsers(Request $request)
    {
        $ids = $request->post('ids');
        if (empty($ids) || !is_array($ids)) {
            throw new ValidatorException('ids 参数错误');
        }
        DB::beginTransaction();
        try {

            $this->adminLogic->deleteUser($request->post('ids'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '删除用户失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     *
     * @RequestMapping(route="admin/profile", method={RequestMethod::GET})
     * @return array
     */
    public function profile()
    {
        $username = Auth::admin()->getUsername();
        return ResultData::success($this->adminLogic->findByName($username));
    }

    /**
     * @RequestMapping(route="admin/profile", method={RequestMethod::PUT})
     * @Validate(validator="AdminValidator", unfields={"username", "status", "password"})
     * @param Request $request
     * @return array
     */
    public function updateProfile(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->adminLogic->updateProfile(Auth::admin()->getUsername(), $request->post());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '更新用户状态失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     * @RequestMapping(route="admin/avatar", method={RequestMethod::PUT})
     * @param Request $request
     * @return array
     * @throws ValidatorException
     */
    public function updateAvatar(Request $request)
    {
        $avatar = $request->post('avatar');
        if (empty($ids) || !is_array($ids)) {
            throw new ValidatorException('avatar 不能为空');
        }
        DB::beginTransaction();
        try {
            $this->adminLogic->updateAvatar(Auth::admin()->getUsername(), $avatar);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '用户更新头像失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     * @RequestMapping(route="admin/password", method={RequestMethod::PUT})
     * @param Request $request
     * @return array
     * @throws \Exception
     */
    public function updatePassword(Request $request)
    {
        $password        = $request->post('oldPassword');
        $newPassword     = $request->post('newPassword');
        $confirmPassword = $request->post('confirmPassword');
        if (empty($newPassword) || empty($confirmPassword)) {
            throw new \Exception('密码不能为空');
        }
        if (strcmp($confirmPassword, $newPassword) !== 0) {
            throw new \Exception('两次输入的密码不一致');
        }
        DB::beginTransaction();
        try {
            $this->adminLogic->updatePassword(Auth::admin()->getUsername(), $password, $newPassword);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '用户密码更新失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }
}