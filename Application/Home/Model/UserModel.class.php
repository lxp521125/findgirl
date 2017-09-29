<?php
namespace Home\Model;

class UserModel extends BaseModel
{
    public function addUser($data)
    {
        try {
            $id = $this->add($data);
            if ($id) {
            $otheradd = [
                'course_name' => randomName(),
                'course_time' => rand(10, 10000),
                'user_id' => $id,
            ];
            D('UserOther')->add($otheradd);
        }
        return $id;
        } catch (\Exception $e) {
            return '';
        }
        
        
    }


}
