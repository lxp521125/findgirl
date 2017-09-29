<?php
namespace Home\Model;

class PositionModel extends BaseModel
{
    public function get10user($geohash)
    {
        $data = $this->where(['geohash' => ['like', $geohash.'%']])->limit(10)->select();
        // p($this->_sql());
        return $data;
    }
}

