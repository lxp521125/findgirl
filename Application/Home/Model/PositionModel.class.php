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
        if (!$id) {
            $this->rollback();
            return false;
        }
        $data['create_time'] = time();
        $id = $this->getColumn(['user_id' => $data['user_id']], 'id');
        if ($id) {
            if ($this->where(['id' => $id])->save($data) === false) {
                $this->rollback();
                return false;
            }
        } else {
            if ($this->add($data) === false) {
                $this->rollback();
                return false;
            }
        }
        $this->commit();
        return true;
    }

    public function get10user($geohash, $userId=0)
    {
        $data = $this->where(['geohash' => ['like', $geohash.'%'], 'user_id' => ['NEQ', $userId]])->order('create_time desc')->limit(10)->select();
        // p($this->_sql(),0);
        return $data;
    }
}

