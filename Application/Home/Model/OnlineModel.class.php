<?php
namespace Home\Model;

class OnlineModel extends BaseModel
{
    public function setLine($data)
    {
        $id = $this->getColumn(['user_id' => $data['user_id']], 'id');
        if ($id) {
            return $this->where(['id' => $id])->save($data);
        } else {
            return $this->add($data);
        }
    }
}
