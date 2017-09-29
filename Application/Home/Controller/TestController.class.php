<?php
namespace Home\Controller;

use Gaodun\SystemConstant;

class TestController extends CommonController
{
    public function test()
    {
        p(AL('User')->findAroundUser(39.98123848,116.30683690, 6));
        
    }

    public function addpos()
    {
        for($i=25;  $i<200; $i++){
            $data = [
            'x' => '121.47'.rand(0, 9990),//经度
            'y' => '31.27'.rand(0,9999),//纬度
            'user_id' => $i,
            'create_time' => date('Y-m-d H:i:s')
        ];
            $data['geohash'] = AL('Geohash')->encode($data['x'], $data['y']);
            D('Position')->addPosition($data);
        }
        
        // p($a);
    }
}