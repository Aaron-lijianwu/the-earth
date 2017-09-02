<?php
namespace Admin\Controller;
use Think\Controller;

/**
 * use Common\Model 这块可以不需要使用，框架默认会加载里面的内容
 */

class LoginController extends Controller
{
    public function index()
    {
        if(session('adminUser'))
        {
            $this->redirect('../admin.php?c=index');
            $this->display();
        }
    }
    public function check()
    {
        $username = I('username');
        $password = I('password');

//        判断用户名和密码
        if(!trim($username))
        {
            show(0,'用户名不能为空');
        }
        if(!trim($password))
        {
            show(0,'密码不能为空');
        }
        $res = D('Admin')->getUsername($username);
        if(!$res)
        {
            show(0,'用户不存在');
        }
        if($res['password'] == MD5Password('password'))
        {
            show(0,'密码错误');
        }
        session('adminUser',$res);
        show(1,'登录成功');
    }
    public function loginout()
    {
        session('adminUser',null);
        $this->redirect('../admin.php?c=login');

    }
}
