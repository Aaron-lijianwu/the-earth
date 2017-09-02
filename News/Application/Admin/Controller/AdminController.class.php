<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/29
 * Time: 上午9:10
 */
namespace Admin\Controller;

use think\Controller;

class AdminController extends Controller
{
    public function index()
    {


        $res = D('Admin')->getAdmins();
        $this->assign('admins',$res);
        $this->display();
    }
    public function delete()
    {
        if($_POST)
        {
            $admin_id = $_POST['id'];
            $status = $_POST['$status'];
            $res = D('Admin')->setStatusById(intval($admin_id),intval($status));

            if($res)
            {
                return show(1,'删除成功');
            }
            return show(0,'删除失败');
        }
    }

    public function add()
    {
        if($_POST)
        {
            if(!$_POST['username'] || !isset($_POST['username']))
            {
                return show(0,'用户名不能为空');
            }
        }
    }
}