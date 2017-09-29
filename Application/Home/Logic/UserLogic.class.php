<?php
namespace Home\Logic;

/**
 * summary
 */
class UserLogic
{
    public function findAroundUser($x, $y, $long = 6)
    {
        $geohash = AL('Geohash');
        $hash = $geohash->encode($x, $y);
        //取前缀，前缀约长范围越小
        $prefix = substr($hash, 0, 6);
        //取出相邻八个区域
        $neighbors = $geohash->neighbors($prefix);
        array_push($neighbors, $prefix);
        $position =  D('Position');
        $data = [];
        foreach ($neighbors as $v) {
            if (!empty($position->get10user($v))) {
                $data = $position->get10user($v);
            }
        }
        $retdata = [];
        $userId = [];

        foreach ($data as $v) {
            $retdata[] = $v;
            $userId[] = $v['user_id'];
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