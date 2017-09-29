<?php
namespace Gaodun;
use Think\Image;
/**
 * Created by PhpStorm.
 * User: dafa
 * Date: 2015/8/26
 * Time: 15:24
 */



class GdImage{

    const share_photo = '/share/v';
    const error = 101;//上传失败
    const error_notemp = 105;//找不到临时文件夹
    const error_fialsave = 106;//文件写入失败
    const error_partup = 107;//部分被上传
    const error_size = 108;//文件大小超过html表单max_file_size指定
    const error_nofile = 200;//没有文件被上传

    public $filename;//文件名
    public $absolutePath; //绝对路径
    public $relativePath;//相对路径
    public $fileArray;//$_FILE


    /**
     * 处理图片上传
     * param：Array
     * return:mix
     *          上传成功返回string
     *          上传失败返回101~108
     */
    public function handleImage($_files,$url,$filename=''){

        $this->relativePath = $url;
        $this->fileArray = $_files;
        $this->filename = $filename;
        if(!empty($_files)){
            $picArray = $this->picUpload();
            if(!is_int($picArray)){ //不为int则为array
                $PK = 0;
                $picNewArr = [];
                foreach ($picArray as $valPic){
                    foreach($valPic as $key=>&$valP){
                        if(count($valP)>1){
                            foreach($valP as $kk=>$vv){
                                $picNewArr[$PK][$key][$kk] =$vv;
                            }
                        }else{
                            $picNewArr[$PK][$key] = $valP;
                        }
                    }
                    $PK++;
                }
                $file_url = serialize($picNewArr);
                return $file_url;
            }else{
                return $picArray;
            }
        }
    }


    /**
    * 获取图片
    * @param1 $path 上传文件夹路径，‘/Uploads/confirm_comment_img/’.date('Y/m/d');
    * @return mix 1、上传成功返回缩略图和原图地址array，2、失败返回 string 101~108
    */
    public function picUpload(){

        $picArray = [];
        $this->absolutePath = $_SERVER['DOCUMENT_ROOT'] . self::share_photo . $this->relativePath;
        if (!is_dir($this->absolutePath)) {
            mkdir($this->absolutePath, 0755, true);
        }

        foreach ($this->fileArray as $key => $valFile) {
            switch($valFile['error']){
                case 0;
                    $picArray[] = self::upImgFile($valFile,$key);
                    break;
                case 1;
                    return self::error_size;
                    break;
                case 2;
                    return self::error_size;
                    break;
                case 3;
                    return self::error_partup;
                    break;
                case 4;
                    return self::error_nofile;
                    break;
                case 6;
                    return self::error_notemp;
                    break;
                case 7;
                    return self::error_fialsave;
                    break;
            }
        }
        return $picArray;
    }

    /**
     * 上传图片
     * param：Array
     * return:mix 上传成功返回图片uri 上传失败返回101 没上传图片返回110
     */

    public function upImgFile($valFile,$key){

        if($this->filename != ''){
            $saveNameBig = $this->filename . '.jpg';
        }else{
            $saveNameBig = md5($valFile['avatr_name'] . uniqid()) . '_big.jpg';
            $saveNameSmall = md5($valFile['avatr_name'] . uniqid()) . '_small.jpg';
        }

        /*
        $image = new Image();
        $info = self::getImageInfo($valFile['tmp_name']);
        if($info['width'] > $info['height']){
            $newWidth = ceil($info['width'] * 54 / $info['height']);
            $smallResult = $image::thumb($valFile['tmp_name'], $savePath . '/' . $saveNameSmall, '', $newWidth, 54);
        }else{
            $newHeight = ceil($info['height'] * 54 / $info['width']);
            $smallResult = $image::thumb($valFile['tmp_name'], $savePath . '/' . $saveNameSmall, '', 54, $newHeight);
        }
        */
//         p($this->relativePath . '/' . $saveNameBig);
        $resultUpload = move_uploaded_file($valFile['tmp_name'], $this->absolutePath . '/' . $saveNameBig);
//         if (empty($resultUpload) || empty($smallResult)) {
        if (empty($resultUpload)) {
            //只要出现上传失败，就将已上传成功的全部删除，然后提示上传失败，重新提交数据
            if (!empty($picArray)) {
                foreach ($picArray as $valPic) {
                    unlink($valPic);
                }
            }
            return self::error;
        } else {
            $picArray = array(
                't' =>self::share_photo.$this->relativePath . '/' . $saveNameSmall,
                'o' =>self::share_photo.$this->relativePath . '/' . $saveNameBig
            );
            return $picArray;
        }
    }


    /**
     * 获取上传图片信息
     * return Array
     */
    public static function getImageInfo($img){

        $imageInfo = getimagesize($img);
        if ($imageInfo !== false) {
            $imageType = strtolower(substr(image_type_to_extension($imageInfo[2]), 1));
            $info = array(
                "width" => $imageInfo[0],
                "height" => $imageInfo[1],
                "type" => $imageType,
                "mime" => $imageInfo['mime'],
            );
            return $info;
        } else {
            return false;
        }
    }

}