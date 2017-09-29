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
        $result = $this->getList(['user_id' => ['IN', $userId]], '', 'id DESC');
        p($this->_sql());
        if ($result) {
            $userModel = D('User');
            foreach ($result as $key => $value) {
                $result['user_name'] = $userModel->getColumn(['id' => $value['user_id']], 'name');
            }
        }
        return ($result ? $result : []);
    }
}
