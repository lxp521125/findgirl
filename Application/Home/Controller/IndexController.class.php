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
        $data['name'] = I('name', '');
        $data['equipment'] = I('equipment', '');
        if (!empty($data['name']) && !empty($data['equipment'])) {
            $data['user_id'] = D('User')->add($data);
            if ($data['user_id']) {
                $this->_retMsg = '获取成功';
                $this->_status = SystemConstant::getConstant('success');
                $this->_data = $data;
            }
        }
        $this->_returnJson();
    }
}