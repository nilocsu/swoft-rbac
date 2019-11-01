<?php


namespace App\Admin\Controller;


use App\Admin\Common\Service\JwtService;
use App\Admin\Model\Logic\AdministratorLogic;
use App\Admin\Model\Logic\LoginLogic;
use App\Admin\Util\ResultData;
use App\Model\Entity\TUser;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\DB;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Validator\Annotation\Mapping\Validate;
use Exception;

/**
 * @Controller(prefix="/")
 */
class LoginController
{

    /**
     * @Inject()
     * @var AdministratorLogic
     */
    private $adminLogic;

    /**
     * @Inject()
     * @var LoginLogic
     */
    private $loginLogic;

    /**
     * @RequestMapping(route="/auth/login", method={RequestMethod::POST})
     * @Validate(validator="AdminValidator", fields={"username"})
     * @param Request $request
     * @return array
     * @throws Exception
     */
    public function login(Request $request)
    {
        $username = $request->post('username');
        $password = $request->post('password');
        /* @var TUser $user */
        $user = $this->adminLogic->findByName($username);

        $errorMessage = "用户名或密码错误";
        if (empty($user)) {
            throw new Exception($errorMessage);
        }
        if (strcmp($user->getPassword(), md5(md5($password)))) {
            throw new Exception($errorMessage);
        }
        if ($user->getStatus() == 0) {
            throw new Exception('账号已被锁定,请联系管理员！');
        }
        DB::beginTransaction();
        try {
            // 更新用户登录时间
            $this->adminLogic->updateLoginTime($username);
            $this->loginLogic->create($request);
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            return ResultData::failed('认证失败');
        }
        $data                = $user->toArray();
        $data['accessToken'] = JwtService::encode($user->toArray());
        return ResultData::success($data);
    }

    public function register(Request $request)
    {

    }

    /**
     * @RequestMapping(route="/system/index/{username}", method={RequestMethod::GET})
     * @param string $username
     * @return array
     */
    public function index(string $username)
    {
        return ResultData::success([
            'totalVisitCount'         => $this->loginLogic->findTotalVisitCount(),
            'todayVisitCount'         => $this->loginLogic->findTodayVisitCount(),
            'todayIp'                 => $this->loginLogic->findTodayIp(),
            'lastSevenVisitCount'     => $this->loginLogic->findLastSevenDaysVisitCount(null),
            'lastSevenUserVisitCount' => $this->loginLogic->findLastSevenDaysVisitCount($username),
        ]);
    }
}