<?php
/**
 * Created by PhpStorm.
 * User: gaodun
 * Date: 2015/11/30
 * Time: 14:27
 */

namespace Gaodun;

class WxJsShareHelper{

//生成微信分享的参数
    public static function getSignatureByWX() {
        $jsapiTicket = self::getJsApiTicket();
        $url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];//这里修改成需要的打开地址
        $timestamp = time();
        $nonceStr = self::createNonceStr();
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";// 这里参数的顺序要按照 key 值 ASCII 码升序排序

        $signature = sha1($string);

        $signPackage = array(
            "appId"     => 'wx0f18d42101e26fc3',
            "nonceStr"  => $nonceStr,
            "timestamp" => $timestamp,
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }


//获取微信 JsApiTicket （次数非常有限，故取缓存）
    public static function getJsApiTicket() {
        $data = json_decode(S('TokenTime'),true);
        
        if ($data['expire_time'] < time()) {
            $accessToken = self::getAccessTokenByWX(); //这里读取缓存中的accesstoken
            $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken";
            $res = json_decode(self::request_by_curl($url),true);
            if($res['errcode'] == '40001'){ //40001	获取access_token时AppSecret错误，或者access_token无效
                $access_token = self::getAccessTokenByWX();
                //这里需要重新请求一次获取ticket
                $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$access_token";
                $res = json_decode(request_by_curl($url),true);
            }

            $ticket = $res['ticket'];
            if ($ticket) {
                $data['expire_time'] = time() + 7000;
                $data['jsapi_ticket'] = $ticket;
                S('TokenTime',json_encode($data));
                //这里ticket需要写入缓存
            }
        } else {
            $ticket = $data['jsapi_ticket'];
        }

        return $ticket;
    }

//再一次请求accesstoken
    public static function getAccessTokenByWX(){
        $token = S("gdwx_accesstoken");
        if($token){
            return $token;
        }
        $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx0f18d42101e26fc3&secret=bbbd861dfadf69bd9b75fbb841999f89';
        $token = json_decode(self::request_by_curl($url),true);
        S('gdwx_accesstoken',$token['access_token'],7200);
        return $token['access_token'];
    }


    public static function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = '';
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

	function request_by_curl($url, $data = NULL) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		if(!empty($data)){
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
		}
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}
}


