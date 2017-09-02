<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/28
 * Time: 上午9:47
 */
namespace Common\Model;

use Think\Model;



class UploadImageModel extends Model {
    private $_uploadObj = '';
    private $_uploadImageData = '';
    const UPLOAD = 'upload';
    public function __construct()
    {
        $this->_uploadObj = new \Think\Upload();

        $this->_uploadObj->rootPath = './'.self::UPLOAD.'/';
        $this->_uploadObj->subName = date('Y') . '/' . date('m') . '/' . date('d');

    }

    public function imageUpload()
    {
        $res = $this->_uploadObj->upload();

        if ($res)
        {
            return '/'.self::UPLOAD.'/'.$res['file']['savepath'].$res['file']['savename'];
        }
        else
        {
            dump($this->_uploadObj->getError());
            return false;
        }
    }
}

