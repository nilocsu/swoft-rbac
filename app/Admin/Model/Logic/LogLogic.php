<?php


namespace App\Admin\Model\Logic;

use App\Admin\Common\Util\Utils;
use App\Model\Entity\TLog;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 */
class LogLogic
{
    /**
     * @param array $data
     * @return array
     */
    public function findLogs(array $data)
    {
        $log = TLog::query();
        if (!empty($data['filter'])) {
            $filter = (array)json_decode($data['filter']);
            if (!empty($filter['username']) && $filter['username'] !== '') {
                $log->where('username', $filter['username']);
            }
            if (!empty($filter['operation']) && $filter['operation'] !== '') {
                $log->where('operation', $filter['operation']);
            }
            if (!empty($filter['createTimeFrom']) && !empty($filter['createTimeTo'])) {
                $log->whereBetween('created_at', [$filter['createTimeFrom'], $filter['createTimeTo']]);
            }
        }

        return Utils::pageSort($log, $data['sortBy'], $data['descending'] ? 'desc' : 'asc');
    }

    /**
     * @param array $logIds
     */
    public function deleteLogs(array $logIds)
    {
        TLog::whereIn('id', $logIds)->delete();
    }

}