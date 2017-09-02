<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/29
 * Time: 上午9:11
 */

namespace Common\Model;


use Think\Model;

class AdminModel extends Model
{
    private $_db = '';
//    protected $tableName = 'admin';
    public function __construct()
    {
        parent::__construct();
        $this->_db = M('admin');
    }

    public function getAdminByUsername($username)
    {
        $res = $this->_db->where("username = '$username'")->find();

        return $res;
    }

    public function getAdminBypassword($username, $password)

    {
        $res = $this->_db->where("username='$username' and password='$password' ")->find();
        return $res;

    }


    public function getAdmins()
    {
        $data['status'] = array('neq',-1);

        return $this->_db->where($data)->select();
    }



    public function setStatusById($id,$status)
    {
        if(is_numeric($id) || is_numeric($status))
        {
            return 0;
        }
        $data['status'] = $status;

        $res = $this->_db->where('admin_id='.$id)->save($data);
        return $res;

    }
}