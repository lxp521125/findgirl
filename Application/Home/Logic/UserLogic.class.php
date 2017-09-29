<?php
namespace Home\Logic;

/**
 * summary
 */
class UserLogic
{
    public function findAroundUser($data, $long = 6)
    {
        $userId = $data['user_id'];

        $geohash = AL('Geohash');
        $hash = $geohash->encode($data['x'], $data['y']);
        //取前缀，前缀约长范围越小
        $prefix = substr($hash, 0, $long);
        //取出相邻八个区域
        $neighbors = $geohash->neighbors($prefix);
        array_push($neighbors, $prefix);
        $position =  D('Position');
        $data = [];
        foreach ($neighbors as $v) {
            $tmp = $position->get10user($v, $userId);
            if (!empty($tmp)) {
                $data[] = $tmp;
            }
        }
        // p(count($data));
        $retdata = [];
        $userId = [];

        foreach ($data as $fv) {
            foreach ($fv as $v) {
                $retdata[] = $v;
                $userId[] = $v['user_id'];
            }
        }
        $userInfo = D('UserOther')->getUsreOther($userId);
        $newUserData = [];
        foreach ($userInfo as $value) {
            $newUserData[$value['user_id']] = $value; 
        }
        foreach ($retdata as &$value) {
            $value['user_info'] = $newUserData[$value['user_id']];
        }
        //用户信息；
        //合并用户信息；
        return $retdata;

    }
//     SELECT * FROM xy WHERE geohash LIKE 'wx4eqw%';
// SELECT * FROM xy WHERE geohash LIKE 'wx4eqx%';
// SELECT * FROM xy WHERE geohash LIKE 'wx4eqt%';
// SELECT * FROM xy WHERE geohash LIKE 'wx4eqy%';
// SELECT * FROM xy WHERE geohash LIKE 'wx4eqq%';
// SELECT * FROM xy WHERE geohash LIKE 'wx4eqr%';
// SELECT * FROM xy WHERE geohash LIKE 'wx4eqz%';
// SELECT * FROM xy WHERE geohash LIKE 'wx4eqv%';
// SELECT * FROM xy WHERE geohash LIKE 'wx4eqm%';

}