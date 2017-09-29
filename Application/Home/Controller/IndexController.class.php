<?php
namespace Home\Controller;

use Gaodun\SystemConstant;

class IndexController extends CommonController
{
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
            'create_time' => date('Y-m-d H:i:s'),
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
            'x' => I('x', ''), //经度
            'y' => I('y', ''), //纬度
            'user_id' => I('user_id', 0, 'intval'),
            'create_time' => date('Y-m-d H:i:s'),
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
            'x' => I('x', ''), //经度
            'y' => I('y', ''), //纬度
            'user_id' => I('user_id', 0, 'intval'),
        ];
        $land = I('land', '6'); //经度
        if (!empty($data['x']) && !empty($data['y'])) {
            $data = AL('User')->findAroundUser($data, $land);
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
        $this->_retMsg = '是不是没登录失败';
        $data = [
            'from_user_id' => I('from_user_id', 0, 'intval'), //发送者
            'to_user_id' => I('to_user_id', 0, 'intval'), //接收者
            'message' => I('message', ''), //geohash
            'create_time' => time(),
            'update_time' => time(),
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
        $page = ($page <= 0 ? 1 : $page);
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
                'status' => \Home\Model\MessageModel::STATUS_ZERO,
            ];
            $result = D('Message')->getList($where, '', 'id DESC');
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
     * 获取在线人数
     */
    public function getOnlineCount()
    {
        D('Online')->setLine(['user_id'=> I('user_id', 0, 'intval'), 'create_time' => time()]);
        $this->_data = ['count' => D('Online')->getCount(['create_time' => ['gt', (time() - 300)]])];
        $this->_retMsg = '获取成功';
        $this->_status = SystemConstant::getConstant('success');
        $this->_returnJson();
    }
}
