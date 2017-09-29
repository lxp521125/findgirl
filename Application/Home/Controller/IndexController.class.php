<?php
namespace Home\Controller;

use Gaodun\SystemConstant;
use Home\Service;

class IndexController extends CommonController
{
    public function test()
    {
        p(M('User'));
        
    }


    /**
     * 添加用户
     */
    public function addUser()
    {
        $this->_status = SystemConstant::getConstant('faile');
        $this->_retMsg = '失败';
        $data = [
            'name' => I('name', ''),
            'equipment' => I('equipment', ''),
            'ip' => I('ip', ''),
            'creat_time' => time()
        ];
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
     *用户数据
    */


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
            'geohash' => I('y', ''),//geohash
            'user_id' => I('user_id', 0, 'intval'),
            'creat_time' => time()
        ];
        if (!empty($data['x']) && !empty($data['y'])) {
            $data['id'] = D('Position')->add($data);
            if ($data['id']) {
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
            'creat_time' => time(),
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
     * 拉取历史记录
    */
    public function getMessageList()
    {
        $toUserId = I('to_user_id', 0, 'intval');
        if ($toUserId > 0) {
            $page = I('page', 0, 'intval');
            $result = D('Message')->getList(['to_user_id' => $toUserId]);

        } 
        $this->_retMsg = '获取成功';
        $this->_status = SystemConstant::getConstant('success');
        $this->_returnJson();
    }





}