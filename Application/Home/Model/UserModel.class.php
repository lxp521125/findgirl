<?php
namespace Home\Model;

class UserModel extends BaseModel
{
    public function addUser($data)
    {
        return $this->add($data);
    }
}
