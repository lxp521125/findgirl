<?php
namespace Home\Model;

class PositionModel extends BaseModel
{
    /**
     * 更新用户位置数据
     * 保留用户位置历史
    */
    public function addPosition($data)
    {
        if (empty($data)) {
            return false;
        }
        $this->startTrans();
        $id = D('PositionLog')->add($data);
        if ($id) {
            $this->rollback();
            return false;
        }
        $data['create_time'] = time();
        if (D('Position')->where(['user_id' => $data['user_id']])->save($data) === false) {
            $this->rollback();
            return false;
        }
        $this->comment();
        return true;
    }
    
}

