<?php
namespace Gaodun;

/**
 * 字符串帮助类，把function.php中的方法取缔掉
 * 
 * @author Stone
 *        
 */
class GdstringHelper
{

    /**
     * 替换内容
     * @param $text:原文
     * @param $filterContent:要过滤掉的内容
     * @param $flag:过滤位置；head（头部）,foot（底部）,all（全文）
     */
    public static function replaceText($text, $filterContent = ['<br\s*?\/?>'], $replace = '', $flag = 'head')
    {
        if(is_array($filterContent)){
            $pattern = '';
            switch ($flag){
                case 'head':
                    foreach ($filterContent as $v){
                        $pattern = "/^({$v})({$v})*/";
                        $text = preg_replace($pattern,$replace,$text);
                    }
                    break;
                case 'foot':
                    foreach ($filterContent as $v){
                        $pattern = "/({$v})*$/";
                        $text = preg_replace($pattern,$replace,$text);
                    }
                    break;
                case 'all':
                    foreach ($filterContent as $v){
                        $pattern = "/({$v})/";
                        $text = preg_replace($pattern,$replace,$text);
                    }
                    break;
                default:break;
            }
        }
        return $text;
    }
}
