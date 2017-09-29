<?php
namespace Home\Controller;

use Gaodun\SystemConstant;

header('content-type:text/html;charset=utf-8');
class CommonController extends BaseController
{

    protected $_studentID = ''; // 学生ID

    protected $_sessionID = ''; // sessionID

    protected $_status = '';

    protected $_retMsg = '';

    protected $_data = [];
    /**
     * 初始化
     */
    public function _initialize()
    {
        parent::_initialize();
        $this->_actionName = I('request.act', 'empty');
        $this->_studentID = I('request.student_id', 0);

    }

    /**
     * 所有接口的入口地址
     */
    public function index()
    {
        $doAction = $this->_actionName;
        $this->$doAction();
    }

    /**
     * 改写TP方法
     */
    public function __call($method, $args)
    {
        if (0 === strcasecmp($method, ACTION_NAME . C('ACTION_SUFFIX'))) {
            if (method_exists($this, '_empty')) {
                // 如果定义了_empty操作 则调用
                $this->_empty($method, $args);
            } elseif (file_exists_case($this->view->parseTemplate())) {
                // 检查是否存在默认模版 如果有直接输出模版
                $this->display();
            } else {
                E(L('_ERROR_ACTION_') . ':' . ACTION_NAME);
            }
        } else {
            $this->_status = SystemConstant::getConstant('noFunction');
            $this->_retMsg = '接口:' . $method . '不存在！';
            $this->_handleError();
        }
    }

    /**
     * 返回处理数据
     */
    protected function _returnJson($info = '')
    {
        $data['status'] = $this->_status;
        $data['ret'] = $this->_retMsg;
        $data['data'] = $this->_data;
        global $t;
        header('losttime:' . (microtime(true) - $t));
        if (!empty($this->_otherData)) {
            $data['other_data'] = $this->_otherData;
        }
        $this->_jsonReturn($data, $data['status'], $info, $this->_callBack);
    }

    /**
     * @desc 验证参数是否存在 ，不存在返回103错误
     */
    public function verifyParam()
    {
        $paramArray = func_get_args();
        foreach ($paramArray as $k => $v) {
            if (empty($v)) {
                $this->_status = SystemConstant::getConstant('parameterError');
                $this->_retMsg = '参数错误' . $k;
                $this->_data = '';
                $this->_returnJson();
            }
        }
        return true;
    }
}
