<?php
namespace Home\Model;

use Think\Model\Model;

class BaseModel extends Model
{
    public function getOneById($id)
    {
        return $this->find($id);
    }
}
