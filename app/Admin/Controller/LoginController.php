<?php


namespace App\Admin\Controller;


use App\Admin\Common\Service\JwtService;
use App\Admin\Exception\AdminException;
use App\Admin\Model\Logic\AdministratorLogic;
use App\Admin\Model\Logic\LoginLogic;
use App\Admin\Util\ResultData;
use App\Model\Entity\TUser;
use Gregwar\Captcha\CaptchaBuilder;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Db\DB;
use Swoft\Http\Message\Request;
use Swoft\Http\Server\Annotation\Mapping\Controller;
use Swoft\Http\Server\Annotation\Mapping\RequestMethod;
use Swoft\Http\Server\Annotation\Mapping\RequestMapping;
use Swoft\Redis\Redis;
use Swoft\Validator\Annotation\Mapping\Validate;
use Exception;
use Throwable;
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
        $uniqid = $request->post('uniqid', '');
        $code = $request->post('code', '');
        if ($code == '' || $uniqid == '') {

            return ResultData::failed('请输入验证码');
        }
        $key = Redis::get($uniqid);
        if (is_null($key)) {
            return ResultData::failed('验证码已过期，请重新获取');
        }
        if (strpos(strtolower($key), strtolower($code)) !== 0) {
            return ResultData::failed('验证码错误');
        }
        /* @var TUser $user */
        $user = $this->adminLogic->findByName($username);

        $errorMessage = "用户名或密码错误";
        if (empty($user)) {
            throw new AdminException($errorMessage, 1);
        }
        if (strcmp($user->getPassword(), md5(md5($password))) !== 0) {
            throw new AdminException($errorMessage, 1);
        }
        if ($user->getStatus() == 0) {
            throw new AdminException('账号已被锁定,请联系管理员！', 1);
        }
        DB::beginTransaction();
        try {
            // 更新用户登录时间
            $this->adminLogic->updateLoginTime($username);
            $this->loginLogic->create($request);
            DB::commit();
        } catch (Throwable $e) {
            DB::rollBack();
            return ResultData::failed('server error');
        }
        $data = $user->toArray();
        $data['accessToken'] = JwtService::encode($user->toArray());
        Redis::del($uniqid);
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
            'totalVisitCount' => $this->loginLogic->findTotalVisitCount(),
            'todayVisitCount' => $this->loginLogic->findTodayVisitCount(),
            'todayIp' => $this->loginLogic->findTodayIp(),
            'lastSevenVisitCount' => $this->loginLogic->findLastSevenDaysVisitCount(null),
            'lastSevenUserVisitCount' => $this->loginLogic->findLastSevenDaysVisitCount($username),
        ]);
    }


    /**
     * @RequestMapping(route="/auth/captcha", method={RequestMethod::GET})
     * @return array
     */
    public function captcha()
    {

        $str = $this->generate_password(4);
        $builder = new CaptchaBuilder($str);
        $img = $builder->build()->get();
        $uniqid = uniqid($str);
        // 5分钟过期
        Redis::set($uniqid, $str, 5 * 60 * 1000);

        return ResultData::success([
            'uniqid' => $uniqid,
            'src' => 'data:image/jpeg;base64,' . base64_encode($img),
        ]);
    }

    private function generate_password($length = 8)
    {
        // 密码字符集，可任意添加你需要的字符
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $password = '';
        for ($i = 0; $i < $length; $i++) {
            // 这里提供两种字符获取方式
            // 第一种是使用 substr 截取$chars中的任意一位字符；
            // 第二种是取字符数组 $chars 的任意元素
            // $password .= substr($chars, mt_rand(0, strlen($chars) – 1), 1);
            $password .= $chars[mt_rand(0, strlen($chars) - 1)];
        }
        return $password;
    }

}
