<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/28
 * Time: 上午9:19
 */

namespace Admin\Controller;

use Think\Controller;

class ImageController extends Controller{

    public function ajaxuploadimage()
    {
        $upload = D('UploadImage');

        $res = $upload->imageUpload();
//        res是上传成功后的图片绝对路径.
        if($res == false)
        {
            return show(0,'上传失败');
        }
        if($res ==true)
        {
            return show(1,'上传成功',$res);
        }
    }

}