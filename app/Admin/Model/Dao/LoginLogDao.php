<?php


namespace App\Admin\Model\Dao;


use Swoft\Bean\Annotation\Mapping\Bean;
use Swoft\Db\DB;

/**
 * @Bean()
 */
class LoginLogDao
{
    public function findTodayVisitCount(){
        return DB::select('select count(1) as count from t_login_log where datediff(created_at,now())=0')[0]['count'];
    }

    public function findTodayIp(){
        return DB::select(' select count(distinct(ip)) as ip from t_login_log where datediff(created_at,now())=0')[0]['ip'];
    }

    public function findLastSevenDaysVisitCount(?string $username){
        $sql = "
select
date_format(l.created_at, '%m-%d') days,
count(1) count
from
(
select
*
from
t_login_log
where
date_sub(curdate(), interval 7 day) <= date(created_at)
) as l where 1 = 1 ";
        if ($username !== null && $username != '') {
            $sql .= ' and username = "'. $username .'"';
        }
        $sql .= ' group by days';
        return DB::select($sql);
    }
}