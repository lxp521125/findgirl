<?php
namespace Home\Model;

class UserOtherModel extends BaseModel
{
    /**
     * 用户列表
     * @param array 用户id
     * @return mixed
     */
    public function getUsreOther($userId)
    {
        if (empty($userId)) {
            return [];
        }
        $result = $this->getList(['uesr_id' => ['IN', $userId]], '', 'id DESC');
        return ($result ? $result : []);
    }
}
