<?php


namespace App\Admin\Controller;

use App\Admin\Common\Annotation\Mapping\Log;
use App\Admin\Common\Annotation\Mapping\RequiresPermissions;
use App\Admin\Common\Util\Utils;
use App\Admin\Model\Logic\LoginLogic;
use App\Admin\Util\ResultData;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\DB;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;

/**
 * @Controller("system")
 */
class LoginLogController
{

    /**
     * @Inject()
     * @var LoginLogic
     */
    private $loginLogic;

    /**
     * @RequestMapping(route="login/log", method={RequestMethod::GET})
     * @RequiresPermissions(value={"loginlog:view"})
     * @param Request $request
     * @return array
     */
    public function loginLogList(Request $request)
    {
        return ResultData::success($this->loginLogic->findList($request->input()));
    }


    /**
     * @RequestMapping(route="login/log", method={RequestMethod::DELETE})
     * @Validate(validator="IdsValidator")
     * @RequiresPermissions(value={"loginlog:delete"})
     * @Log("删除登录日志")
     * @param Request $request
     * @return array
     */
    public function loginLogDelete(Request $request)
    {
        DB::beginTransaction();
        try{
            $this->loginLogic->delete($request->post('ids'));
            DB::commit();
        }catch (\Throwable $e){
            DB::rollBack();
            $msg = "删除登录日志失败";
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }
        return ResultData::success();
    }
}