<?php
namespace Home\Controller;

use Gaodun\SystemConstant;
use Home\Service;

class IndexController extends CommonController
{
    public function testAdduser()
    {
        set_time_limit(0);
        for($i = 0; $i < 5000; $i++) {
            $name = $this->getName();
            $url = 'http://www.gtech9.com/?act=addUser&name='.$name.'&equipment={device_code:354332073180597,device_info:SM-G9250}&ip=12.23.113.23';
            echo file_get_contents($url);
            echo '<br />';
        }
        exit;
    }

    public function testAddmessage()
    {
        for($i= 0; $i <= 100; $i++) {
            $from_user_id = rand(25, 3000);
            $mess = 'Hello.'. $this->getName();
            $url = 'http://www.gtech9.com/?act=addMessage&from_user_id='.$from_user_id.'&to_user_id=4513&message='.$mess;
            echo file_get_contents($url);
            echo '<br />';
        }
        exit;
    }

    protected function getName()
    {
        $a = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        $str = '';
        for($i=1; $i <= 6; $i++) {
            $str .= $a[rand(1, strlen($a))];
        }
        return  $str;
    }

    /**
     * 添加用户
     *
     */
    public function addUser()
    {
        
        $data = [
            'name' => I('name', ''),
            'equipment' => I('equipment', ''),
            'ip' => I('ip', ''),
            'create_time' => date('Y-m-d H:i:s')
        ];
        $this->_status = SystemConstant::getConstant('faile');
        $this->_retMsg = '用户名相同';
        if (!empty($data['name']) && !empty($data['equipment'])) {
            $data['user_id'] = D('User')->addUser($data);
            if ($data['user_id']) {
                $this->_retMsg = '获取成功';
                $this->_status = SystemConstant::getConstant('success');
                $this->_data = $data;
            }
        }
        $this->_returnJson();
    }

    /**
     * 添加位置数据
    */
    public function addPosition()
    {
        $this->_status = SystemConstant::getConstant('faile');
        $this->_retMsg = '失败';
        $data = [
            'x' => I('x', ''),//经度
            'y' => I('y', ''),//纬度
            'user_id' => I('user_id', 0, 'intval'),
            'create_time' => date('Y-m-d H:i:s')
        ];
        if (!empty($data['x']) && !empty($data['y'])) {
            $data['geohash'] = AL('Geohash')->encode($data['x'], $data['y']);
            if (D('Position')->addPosition($data)) {
                $this->_retMsg = '获取成功';
                $this->_status = SystemConstant::getConstant('success');
                $this->_data = $data;
            }
        }
        $this->_returnJson();
    }

    /**
     * 周边学生
     * @return [type] [description]
     */
    public function getAroundStudent()
    {
        $this->_status = SystemConstant::getConstant('faile');
        $this->_retMsg = '失败';
        $data = [
            'x' => I('x', ''),//经度
            'y' => I('y', ''),//纬度
            'user_id' => I('user_id', 0, 'intval')
        ];
        if (!empty($data['x']) && !empty($data['y'])) {
            $data = AL('User')->findAroundUser($data);
            if (!empty($data)) {
                $this->_retMsg = '获取成功';
                $this->_status = SystemConstant::getConstant('success');
                $this->_data = $data;
            }
        }
        $this->_returnJson();
    }
    /**
     * 添加消息
     */
    public function addMessage()
    {
        $this->_status = SystemConstant::getConstant('faile');
        $this->_retMsg = '失败';
        $data = [
            'from_user_id' => I('from_user_id', 0, 'intval'),//发送者
            'to_user_id' => I('to_user_id', 0, 'intval'),//接收者
            'message' => I('message', ''),//geohash
            'create_time' => time(),
            'update_time' => time()
        ];
        if (!empty($data['from_user_id']) && !empty($data['to_user_id']) && !empty($data['message'])) {
            $data['id'] = D('Message')->add($data);
            if ($data['id']) {
                $this->_retMsg = '获取成功';
                $this->_status = SystemConstant::getConstant('success');
                $this->_data = $data;
            }
        }
        $this->_returnJson();
    }

    /**
     * 拉取历史数据
    */
    public function getMessageList()
    {
        $toUserId = I('to_user_id', 0, 'intval');
        $page = I('page', 0, 'intval');
        $page = ($page <=0 ? 1 : $page);
        if ($toUserId > 0) {
            $result = D('Message')->getNewMessageList($toUserId, $page);
            $this->_data = ($result ? $result : []);
        }
        $this->_retMsg = '获取成功';
        $this->_status = SystemConstant::getConstant('success');
        $this->_returnJson();
    }


    /**
     * 拉取某个用户发的历史记录
    */
    public function getMessageListByFromUserId()
    {
        $fromUserId = I('from_user_id', 0, 'intval');
        $toUserId = I('to_user_id', 0, 'intval');
        if ($fromUserId > 0 && $toUserId > 0) {
            $where = [
                'from_user_id' => $fromUserId,
                'to_user_id' => $toUserId,
                'status' => \Home\Model\MessageModel::STATUS_ZERO
            ];
            $result = D('Message')->getList($where, '','id DESC');
            $result && D('Message')->where($where)->save(['status' => \Home\Model\MessageModel::STATUS_ONE]);
            $this->_data = ($result ? $result : []);
        }
        $this->_retMsg = '获取成功';
        $this->_status = SystemConstant::getConstant('success');
        $this->_returnJson();
    }

    /**
     * 用户课程信息
    */
    public function getUserOtherList()
    {
        $userId = explode(',', I('user_id', ''));
        if (!empty($userId)) {
            $this->_data = D('UserOther')->getUsreOther($userId);
        }
        $this->_retMsg = '获取成功';
        $this->_status = SystemConstant::getConstant('success');
        $this->_returnJson();
    }

    /**
     * 更新在线时间
    */
    public function setOnline()
    {
        $data['user_id'] = I('user_id', 0, 'intval');
        if ($data['user_id']) {
            $data['create_time'] = time();
            D('Online')->setLine($data);
        }
        $this->_retMsg = '获取成功';
        $this->_status = SystemConstant::getConstant('success');
        $this->_returnJson();
    }

    /**
     * 获取在线人数
    */
    public function getOnlineCount()
    {
        $this->_data = ['count' => D('Online')->getCount(['create_time' => ['gt', (time() - 300)]])];
        $this->_retMsg = '获取成功';
        $this->_status = SystemConstant::getConstant('success');
        $this->_returnJson();
    }
}