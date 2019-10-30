<?php


namespace App\Admin\Controller;

use App\Admin\Common\Annotation\Mapping\RequiresPermissions;
use App\Admin\Common\Util\Utils;
use App\Admin\Model\Logic\RoleLogic;
use App\Admin\Util\ResultData;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\DB;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * @Controller(prefix="system")
 */
class RoleController
{

    /**
     * @Inject()
     * @var RoleLogic
     */
    private $roleLogic;


    /**
     * @RequestMapping(route="role", method={RequestMethod::GET})
     * @RequiresPermissions(value={"role:view"})
     * @param Request $request
     * @return array
     */
    public function roleList(Request $request)
    {

        return ResultData::success(
            $this->roleLogic->findRoles($request->input())
        );
    }

    /**
     * @RequestMapping(route="role/check")
     * @param Request $request
     * @return bool
     */
    public function checkRoleName(Request $request)
    {
        $result = $this->roleLogic->findByName($request->input('name'));
        return $result == null;
    }

    /**
     * @RequestMapping(route="role", method={RequestMethod::POST})
     * @RequiresPermissions(value={"role:add"})
     * @param Request $request
     * @return array
     */
    public function addRole(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->roleLogic->createRole($request->post());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '新增角色失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }
    /**
     * @RequestMapping(route="role", method={RequestMethod::DELETE})
     * @Validate(validator="IdsValidator")
     * @RequiresPermissions(value={"role:delete"})
     * @param Request $request
     * @return array
     */
    public function deleteRole(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->roleLogic->deleteRoles($request->post('ids'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '删除角色失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }
    /**
     * @RequestMapping(route="role/{roleId}", method={RequestMethod::GET}, params={"roleId": "\d+"})
     * @RequiresPermissions(value={"role:view"})
     * @param int $roleId
     * @return array
     */
    public function showRole(int $roleId)
    {
        return ResultData::success(
            $this->roleLogic->getRole($roleId)
        );
    }
    /**
     * @RequestMapping(route="role/{roleId}", method={RequestMethod::PUT})
     * @RequiresPermissions(value={"role:delete"})
     * @param int $roleId
     * @param Request $request
     * @return array
     */
    public function updateRole(int $roleId, Request $request)
    {
        DB::beginTransaction();
        try {
            $this->roleLogic->updateRole($roleId, $request->post());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '修改角色失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     * @RequestMapping(route="role/{roleId}/menu", method={RequestMethod::GET}, params={"roleId": "\d+"})
     * @param int $roleId
     * @return array
     */
    public function getRoleMenus(int $roleId)
    {
        return ResultData::success($this->roleLogic->findRoleMenuIds($roleId));
    }

    /**
     * @RequestMapping(route="role/{roleId}/menu", method={RequestMethod::PUT}, params={"roleId": "\d+"})
     * @param int $roleId
     * @param Request $request
     * @return array
     */
    public function updateRoleMenus(int $roleId, Request $request)
    {
        DB::beginTransaction();
        try {
            $this->roleLogic->updateRoleMenu($roleId, $request->post('menuIds'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '更新角色权限失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }


    /**
     * @RequestMapping(route="role/{roleId}/user", method={RequestMethod::GET}, params={"roleId": "\d+"})
     * @param int $roleId
     * @return array
     */
    public function getRoleUsers(int $roleId)
    {
        return ResultData::success($this->roleLogic->findRoleUserIds($roleId));
    }

    /**
     * @RequestMapping(route="role/{roleId}/menu", method={RequestMethod::PUT}, params={"roleId": "\d+"})
     * @param int $roleId
     * @param Request $request
     * @return array
     */
    public function updateRoleUsers(int $roleId, Request $request)
    {
        DB::beginTransaction();
        try {
            $this->roleLogic->updateRoleMenu($roleId, $request->post('menuIds'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = '更新角色权限失败';
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

}