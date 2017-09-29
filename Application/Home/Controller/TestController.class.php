<?php
namespace Home\Controller;

class TestController extends CommonController
{
    public function test()
    {
        p(AL('User')->findAroundUser(39.98123848, 116.30683690, 6));

    }

    public function addpos()
    {
        for ($i = 25; $i < 200; $i++) {
            $data = [
                'x' => '121.47' . rand(0, 9990), //经度
                'y' => '31.27' . rand(0, 9999), //纬度
                'user_id' => $i,
                'create_time' => date('Y-m-d H:i:s'),
            ];
            $data['geohash'] = AL('Geohash')->encode($data['x'], $data['y']);
            D('Position')->addPosition($data);
        }

        // p($a);
    }

    public function testAdduser()
    {
        set_time_limit(0);
        for ($i = 0; $i < 5000; $i++) {
            $name = $this->getName();
            $url = 'http://www.gtech9.com/?act=addUser&name=' . $name . '&equipment={device_code:354332073180597,device_info:SM-G9250}&ip=12.23.113.23';
            echo file_get_contents($url);
            echo '<br />';
        }
        exit;
    }

    public function testAddmessage()
    {
        for ($i = 0; $i <= 100; $i++) {
            $from_user_id = rand(25, 3000);
            $mess = 'Hello.' . $this->getName();
            $url = 'http://www.gtech9.com/?act=addMessage&from_user_id=' . $from_user_id . '&to_user_id=4513&message=' . $mess;
            echo file_get_contents($url);
            echo '<br />';
        }
        exit;
    }

    protected function getName()
    {
        $a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = '';
        for ($i = 1; $i <= 6; $i++) {
            $str .= $a[rand(1, strlen($a))];
        }
        return $str;
    }
}
