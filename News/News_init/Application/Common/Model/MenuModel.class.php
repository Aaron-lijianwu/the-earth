<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/29
 * Time: 下午1:42
 */

namespace Common\Model;


use Think\Model;

class MenuModel extends Model
{
    private $_db = '';
    public function __construct()
    {
        parent::__construct();
        $this->_db = M('menu');
    }
    public function getMenus()
    {
        $condition = array();

        $condition['status'] = array(status => 1);

        return $this->_db->where($condition)->order('listorder desc,menu_id desc')->select();
    }
    public function getMenu($data=array(),$pageNum=0,$pageSize=3)
    {

    }
}