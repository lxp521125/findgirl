<?php
namespace Gaodun;

use Gaodun\AESMcrypt;
use Gaodun\SystemConstant;

/**
 * 数组帮助类，dede
 *
 * @author Stone
 *
 */
class ToolHelper
{
    /**
     * 题库使用！一键解密！不能外用
     * @method tikuHandleSewise
     * @param  [type]           $sourceid [description]
     * @param  [type]           $token    [description]
     * @return [type]                     [description]
     */
    public function tikuHandleSewise($sourceid)
    {
        $token = SystemConstant::getConstant('TIKU_VIDEO_TOKEN');
        $targeturl = C('SHIPINJIEMI') . '/biz/get?source=' . $sourceid;
        $post = array();
        $rs = self::curl_post($targeturl, $post);
        $data = json_decode($rs);

        if ($data->status == '0') {
            $key = $data->result->key;
            $iv = $data->result->iv;
        } else {
            return '';
        }
        //  计算得出通知验证结果
        $aes = new AESMcrypt($bit = 128, substr($token, 0, 16), substr($token, 16, 16), $mode = 'cbc');
        return $aes->encrypt($key . "|" . $iv);
    }

    /**
     * 视频解密地址
     * @method courseHandleSewise
     * @param  [type]           $sourceid [description]
     * @param  [type]           $token    [description]
     * @return [type]                     [description]
     */
    public static function courseHandleSewise($sourceid, $token)
    {
        $targeturl = C('SHIPINJIEMI') . '/biz/get?source=' . $sourceid;
        $post = array();
        $rs = self::curl_post($targeturl, $post);
        $data = json_decode($rs);

        if ($data->status == '0') {
            $key = $data->result->key;
            $iv = $data->result->iv;
        } else {
            return '';
        }
        //  计算得出通知验证结果
        $aes = new AESMcrypt($bit = 128, substr($token, 0, 16), substr($token, 16, 16), $mode = 'cbc');
        return $aes->encrypt($key . "|" . $iv);
    }

    public static function changePhone(&$phone)
    {
        $phone = substr($phone, 0, 3) . '****' . substr($phone, -4);
        return $phone;
    }
    /**
     * 将复杂类型转换为统一综合题
     * @method typeChange
     * @param  [type]     &$data [description]
     * @return [type]            [description]
     */
    public static function typeChange(&$data)
    {
        if (isset($data['type']) && $data['type'] > 7) {
            $data['type'] = 5;
        }

    }
    /**
     * curl
     */
    public static function curl_post($url, $post = [], $head = false, $foll = 1, $ref = false)
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $head = array(
            'X-FORWARDED-FOR:' . $ip, 'CLIENT-IP:' . $ip, 'Accept-Language: zh-cn', 'Accept-Encoding:gzip,deflate', 'Connection: Keep-Alive', 'Cache-Control: no-cache',
        );

        $curl = curl_init(); // 启动一个CURL会话
        if ($head) {
            curl_setopt($curl, CURLOPT_HTTPHEADER, $head); // 模似请求头
        }
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        @curl_setopt($curl, CURLOPT_FOLLOWLOCATION, $foll); // 使用自动跳转
        if ($ref) {
            curl_setopt($curl, CURLOPT_REFERER, $ref); // 带来的Referer
        } else {
            curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        }

        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post); // Post提交的数据包
        curl_setopt($curl, CURLOPT_COOKIEJAR, $GLOBALS['cookie_file']); // 存放Cookie信息的文件名称
        curl_setopt($curl, CURLOPT_COOKIEFILE, $GLOBALS['cookie_file']); // 读取上面所储存的Cookie信息
        curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate'); // 解释gzip
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        if ($foll == 1) {
            curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        } else {
            curl_setopt($curl, CURLOPT_HEADER, 1); // 显示返回的Header区域内容
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            echo 'Errno' . curl_error($curl);
        }
        curl_close($curl); // 关键CURL会话
        $tmpInfo = preg_replace('/script/', 'js', $tmpInfo);
        return $tmpInfo; // 返回数据
    }

    /**
     * guzzle HTTP 客户端和框架
     * $mustbe['url']
     * $mustbe['query'] : []
     * $mustbe['method'] : get
     * $mustbe['model'] ：json
     * $options['query'] :[]
     * $options['form_params']:[]
     * $options['headers']
     */
    public static function getBodyByGuzzleHttp($mustbe = [], $options = [], $timeout = 10)
    {
        if (empty($mustbe['url'])) {throw new \Exception('请求路径必填！', '777');}
        vendor('autoload', 'vendor');

        $client = new \GuzzleHttp\Client([
            'timeout' => $timeout,
        ]);

        $type = [
            'xml' => 'application/xml,text/xml,application/x-xml',
            'json' => 'application/json,text/x-json,application/jsonrequest,text/json',
            'js' => 'text/javascript,application/javascript,application/x-javascript',
            'css' => 'text/css',
            'rss' => 'application/rss+xml',
            'yaml' => 'application/x-yaml,text/yaml',
            'atom' => 'application/atom+xml',
            'pdf' => 'application/pdf',
            'text' => 'text/plain',
            'png' => 'image/png',
            'jpg' => 'image/jpg,image/jpeg,image/pjpeg',
            'gif' => 'image/gif',
            'csv' => 'text/csv',
            'html' => 'text/html,application/xhtml+xml,*/*',
        ];

        $options['headers']['Accept'] = 'text/html,application/xhtml+xml,*/*';
        if (isset($type[$mustbe['model']])) {
            $options['headers']['Accept'] = $type[$mustbe['model']];

        }
        if (!isset($options['headers']['User-Agent'])) {
            $options['headers']['User-Agent'] = 'gaodunApi/1.0';
        }
        if (!in_array(strtolower($mustbe['method']), [
            'get', 'delete', 'head', 'options', 'patch', 'post', 'put',
        ])) {
            $mustbe['method'] = 'get';
        }
        isset($options['query']) ? $options['query'] : $options['query'] = [];
        isset($options['form_params']) ? $options['form_params'] : $options['form_params'] = [];

        $opts = [];
        $opts['headers'] = $options['headers'];
        $opts['query'] = $options['query'];
        $opts['form_params'] = $options['form_params'];

        $response = $client->request($mustbe['method'], $mustbe['url'], $opts);

        $body = (string) $response->getBody(true);

        isset($mustbe['model']) ? $mustbe['model'] : $mustbe['model'] = 'json';
        if ('json' == $mustbe['model']) {
            $body = json_decode($body, true);
        } else if ('xml' == $mustbe['model']) {
        }

        return $body;
    }

}
