<?php
namespace Home\Controller;

use Think\Controller;

class BaseController extends Controller
{
    protected $_replace = [];

    protected $title = '高顿教育';

    public function _initialize()
    {
        vendor('Gaodun.SystemConstant');
        vendor('Gaodun.ArrayHelper');
        vendor('Gaodun.ToolHelper');
        vendor('Gaodun.AESMcrypt');
        vendor('Gaodun.WxJsShareHelper');
    }

    /**
     * @nodename 空操作名称
     *
     * @param String $name
     */
    public function _empty($name = '')
    {
        p('Error!!' . $name);
    }

    /**
     * 用户模版化显示
     * @date:2014.12.30
     *
     * @author :Stone.geng
     */
    protected function gd_display($tpl = '', $templates = '')
    {
        $this->assign('title', $this->title);
        $content_templates = $this->fetch($tpl);
        $this->assign('content_templates', $content_templates);
        $this->display("Public:$templates");
    }

    /**
     * ajax返回
     */
    protected function _jsonReturn($data = [], $status = 0, $info = '', $callback = '', $type = '')
    {
        $jsondata = json_encode($data);
        header('Content-Length:' . strlen($jsondata));
        /**
         * 输出之前替换
         */
        if (!empty($this->_replace)) {
            foreach ($this->_replace as $k => $v) {
                $jsondata = str_replace($k, $v, $jsondata);
            }
            $this->_replace = [];
        }

        if (!empty($callback)) {
            echo $callback . '(' . $jsondata . ')';
        } else {
//             $this->ajaxReturn($rdata, $type);
            echo $jsondata;
        }
        die();
    }

}
