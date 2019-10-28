<?php


namespace App\Admin\Controller;

use App\Admin\Common\Annotation\Mapping\Log;
use App\Admin\Common\Annotation\Mapping\RequiresPermissions;
use App\Admin\Common\Util\Utils;
use App\Admin\Model\Logic\MenuLogic;
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
class MenuController
{
    /**
     * @Inject()
     * @var MenuLogic
     */
    private $menuLogic;

    /**
     * @RequestMapping(route="menu")
     * @RequiresPermissions(value={"menu:view"})
     * @param Request $request
     * @return array
     */
    public function menuList(Request $request)
    {
        $type = $request->input('type', 1);
        // 列表形式显示
        if ($type === 0){
            return ResultData::success($this->menuLogic->findMenuList($request->input()));
        }else{
            // 树形式显示
            return ResultData::success(Utils::listToTree($this->menuLogic->findMenuList($request->input())->toArray()));
        }
    }


    /**
     * @RequestMapping(route="menu/tree")
     * @RequiresPermissions(value={"menu:view"})
     * @return array
     */
    public function menuListTree()
    {
        return ResultData::success($this->menuLogic->findAllMenus());
    }

    /**
     * @RequestMapping(route="menu", method={RequestMethod::POST})
     * @Validate(validator="SystemMenuValidator")
     * @RequiresPermissions(value={"menu:add"})
     * @Log("新增菜单/按钮")
     * @param Request $request
     * @return array
     */
    public function addMenu(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->menuLogic->createMenu($request->post());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = "添加菜单/按钮失败";
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     * @RequestMapping(route="menu",  method={RequestMethod::DELETE})
     * @Validate(validator="IdsValidator")
     * @RequiresPermissions(value={"menu:delete"})
     * @Log("删除菜单/按钮")
     * @param Request $request
     * @return array
     */
    public function deleteMenus(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->menuLogic->deleteMenus($request->post('ids'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = "删除菜单/按钮失败";
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }

    /**
     * @RequestMapping(route="menu/{id}", method={RequestMethod::GET}, params={"id":"\d+"})
     * @Validate(validator="SystemMenuValidator")
     * @RequiresPermissions(value={"menu:update"})
     * @param int $id
     * @return array
     */
    public function getMenu(int $id)
    {
        return ResultData::success($this->menuLogic->findById($id));
    }

    /**
     * @RequestMapping(route="menu/{id}", method={RequestMethod::PUT}, params={"id":"\d+"})
     * @RequiresPermissions(value={"menu:update"})
     * @Log("修改菜单/按钮")
     * @param int $id
     * @param Request $request
     * @return array
     */
    public function updateMenu(int $id, Request $request)
    {
        DB::beginTransaction();
        try {
            $this->menuLogic->updateMenu($id, $request->post());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = "修改菜单/按钮失败";
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }


    /**
     * @RequestMapping(route="menu/{id}/parentId", method={RequestMethod::GET}, params={"id":"\d+"})
     * @RequiresPermissions(value={"menu:update"})
     * @param int $id
     * @return array
     */
    public function getMenuParentIds(int $id)
    {
        if ($id == 0){
            $data = [0];
        }else{
            $data = $this->menuLogic->findMenuParentIds($id);
        }
        return ResultData::success($data);
    }

    /**
     * @RequestMapping(route="menu/excel", method={RequestMethod::POST})
     * @RequiresPermissions(value={"menu:export"})
     * @param Request $request
     * @return array
     */
    public function export(Request $request)
    {
        DB::beginTransaction();
        try {
            // todo 导出Excel
//            $this->menuLogic->findMenuList($request->input());
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = "修改菜单/按钮失败";
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }


}