<?php
namespace Home\Model;

class MessageModel extends BaseModel
{
    /**
     * 状态,0未读,1已读
     * @var int
    */
    const STATUS_ZERO = 0;

    /**
     * 状态,0未读,1已读
     * @var int
     */
    const STATUS_ONE = 1;


    /**
     * 获取当前用户最新的消息，每个用户一条最新的
     * @param int $userId 用户id
     * @return mixed
    */
    public function getNewMessageList($userId)
    {
        if ($userId <= 0) {
            return [];
        }
        $result = $this->getDistinct(['to_user_id' => $userId], 'from_user_id');
        if (!$result) {
            return [];
        }
        foreach ($result as $key => $value) {
            $result[$key] = $this->getOne(['from_user_id' => $value['from_user_id']],'', 'id DESC');
        }
        return $result;
    }
    
}
