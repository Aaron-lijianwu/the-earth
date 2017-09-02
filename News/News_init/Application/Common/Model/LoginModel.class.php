<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/29
 * Time: 上午11:11
 */

namespace Common\Model;

use Think\Model;

class LoginModel extends Model{
    private $_db = '';
    public function __construct()
    {
        parent::__construct();
        $this->_db = D('admin');
    }
    public function getUsername($username)
    {
        return $this->_db->where("username='$username'")->find();
    }
    public function getPaaword($username,$password)
    {
        return $this->_db->where("username='$username',password='$password'");
    }



}