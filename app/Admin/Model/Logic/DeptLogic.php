<?php


namespace App\Admin\Model\Logic;

use App\Admin\Common\Util\Utils;
use App\Model\Entity\TDept;
use Swoft\Bean\Annotation\Mapping\Bean;

/**
 * @Bean()
 */
class DeptLogic
{
    /**
     * @param array $data
     * @param bool $tree
     * @return array
     */
    public function findDeptList(array $data = [], $tree = false)
    {
        $query = TDept::query();
        if (!empty($data['name'])) {
            $query->where('dept_name', $data['name']);
            if (!empty($data['createTimeFrom']) && !empty($data['createTimeTo'])) {
                $query->whereBetween('created_at', [$data['createTimeFrom'], $data['createTimeTo']]);
            }
        }
        $query = $query->get();
        if (empty($query)) {
            return [];
        }
        if($tree){
            return Utils::listToTree($query->toArray());
        }
        return $query->toArray();
    }

    /**
     * @param int $id
     * @return null|string
     */
    public function findDeptName(int $id)
    {
        return TDept::find($id)->getDeptName();
    }

    public function createDept(array $data)
    {
        $dept = new TDept();
        $dept->setDeptName($data['deptName']);
        $dept->setOrderNum($data['orderNum'] ?? '1');
        $dept->setParentId($data['parentId'] ?? 0);
        $dept->save();
    }

    public function updateDept(int $id, array $data)
    {
        /* @var TDept $dept */
        $dept = TDept::findOrFail($id);
        $dept->setDeptName($data['deptName']);
        $dept->setOrderNum($data['orderNum'] ?? 1);
        $dept->setParentId($data['parentId'] ?? 0);
        $dept->update();
    }

    public function deleteDept(array $ids)
    {
        TDept::whereIn('id', $ids)->delete();
    }
}