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
        if ($result) {
            $userModel = D('User');
            foreach ($result as $key => $value) {
                $username = $userModel->getColumn(['id' => $value['user_id']], 'name');
                $result[$key]['user_name'] = ($username ? $username : '');
            }
        }
        return ($result ? $result : []);
    }
}
