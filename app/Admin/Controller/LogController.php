<?php


namespace App\Admin\Controller;

use App\Admin\Common\Annotation\Mapping\Log;
use App\Admin\Common\Annotation\Mapping\RequiresPermissions;
use App\Admin\Common\Util\Utils;
use App\Admin\Model\Logic\LogLogic;
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
class LogController
{

    /**
     * @Inject()
     * @var LogLogic
     */
    private $logLogic;

    /**
     * @RequestMapping(route="log", method={RequestMethod::GET})
     * @param Request $request
     * @return array
     */
    public function logList(Request $request)
    {
        return ResultData::success($this->logLogic->findLogs($request->input()));
    }

    /**
     * @RequestMapping(route="log", method={RequestMethod::DELETE})
     * @Validate(validator="IdsValidator")
     * @RequiresPermissions(value={"log:delete"})
     * @Log("删除系统日志")
     * @param Request $request
     * @return array
     */
    public function delete(Request $request)
    {
        DB::beginTransaction();
        try {
            $this->logLogic->deleteLogs($request->post('ids'));
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            $msg = "删除日志失败";
            Utils::log($msg, $e);
            return ResultData::failed($msg);
        }

        return ResultData::success();
    }
}