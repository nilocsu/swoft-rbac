<?php


namespace App\Admin\Model\Logic;

use App\Model\Entity\TLog;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 */
class LogLogic
{
    /**
     * @param array $query
     * @return array
     */
    public function findLogs(array $query)
    {
        $log = TLog::query();
        if (isset($query['username'])) {
            $log->where('username', $query['username']);
        }
        if (isset($query['operation'])) {
            $log->where('operation', $query['operation']);
        }
        if (isset($query['createTimeFrom']) && isset($query['createTimeTo'])) {
            $log->whereBetween('created_at', [$query['createTimeFrom'], $query['createTimeTo']]);
        }

        $page     = max($data['page'] ?? 1, 1);
        $pageSize = max($data['pageSize'] ?? 20, 0) ?? 20;
        $offset   = ($page - 1) * $pageSize;

        return [
            'total' => $log->count(),
            'page'  => $page,
            'data'  => $log->offset($offset)->limit((int)$pageSize)->get(),
        ];
    }

    /**
     * @param array $logIds
     */
    public function deleteLogs(array $logIds)
    {
        TLog::whereIn('id', $logIds)->delete();
    }

}