<?php


namespace App\Admin\Model\Logic;

use App\Admin\Common\Util\Ip2Region;
use App\Admin\Model\Dao\LoginLogDao;
use App\Model\Entity\TLoginLog;
use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Bean\Annotation\Mapping\Inject;
use Swoft\Http\Message\Request;

/**
 * @Bean()
 */
class LoginLogic
{
    /**
     * @Inject()
     * @var LoginLogDao
     */
    private $logLoginDao;

    /**
     * @param Request $request
     */
    public function create(Request $request)
    {
        //内网ip无需验证
        $remoteAddress = $request->getServerParams()["remote_addr"];
//        $request->getServerParams()->
        $ip2Region = new Ip2Region(\Swoft::getAlias('@resource') . '/data/ip2region.db');
        $loginLog  = new TLoginLog();
        $loginLog->setUsername($request->post('username'));
        $loginLog->setLocation($ip2Region->btreeSearch($remoteAddress)['region']);
        $loginLog->setIp($remoteAddress);
        $loginLog->save();
    }


    public function findTodayVisitCount()
    {
        return $this->logLoginDao->findTodayVisitCount();
    }

    public function findTodayIp()
    {
        return $this->logLoginDao->findTodayIp();
    }

    /**
     * @param null|string $username
     * @return mixed
     */
    public function findLastSevenDaysVisitCount(?string $username)
    {
        return $this->logLoginDao->findLastSevenDaysVisitCount($username);
    }
}