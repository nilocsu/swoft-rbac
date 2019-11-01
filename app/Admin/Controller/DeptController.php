<?php


namespace App\Admin\Controller;

use App\Admin\Common\Annotation\Mapping\Log;
use App\Admin\Common\Annotation\Mapping\RequiresPermissions;
use App\Admin\Common\Util\Utils;
use App\Admin\Model\Logic\DeptLogic;
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
class DeptController
{
    /**
     * @Inject()
     * @var DeptLogic
     */
    private $deptLogic;

    /**
     * @RequestMapping(route="dept/tree")
     * @param Request $request
     * @return array
     */
    public function tree(Request $request)
    {
        return ResultData::success($this->deptLogic->findDeptList($request->input()));
    }

    /**
     * @RequestMapping(route="dept", method={RequestMethod::POST})
     * @RequiresPermissions(value={"dept:add"})
     * @Log("新增部门")
     * @param Request $request
     * @return array
     */
    public function addDept(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->deptLogic->createDept($request->post());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = "新增部门失败";
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     * @RequestMapping(route="dept/{id}",  method={RequestMethod::PUT}, params={})
     * @Validate(validator="IdsValidator")
     * @RequiresPermissions(value={"dept:update"})
     * @Log("删除部门")
     * @param int $id
     * @param Request $request
     * @return array
     */
    public function updateDept(int $id, Request $request){
        DB::beginTransaction();
        try {
            $this->deptLogic->updateDept($id, $request->post());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = "删除部门失败";
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     * @RequestMapping(route="dept",  method={RequestMethod::DELETE})
     * @Validate(validator="IdsValidator")
     * @RequiresPermissions(value={"dept:delete"})
     * @Log("删除部门")
     * @param Request $request
     * @return array
     */
    public function deleteMenus(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->deptLogic->deleteDept($request->post('ids'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = "删除部门失败";
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

}