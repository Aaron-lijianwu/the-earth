<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/21
 * Time: 下午2:28
 */


namespace Common\Model;

use Think\Model;


class MenuModel extends Model
{
    protected $db = '';

    public function __construct()
    {
        parent::__construct();
        $this->db = M('menu');
    }

    public function getAdminMenu()
    {
//        条件
        $condition = array(
            'status' => array('neq', -1),
            'type' => 1
        );
        $res = $this->db->where($condition)->order('listorder desc, menu_id desc')->select();
        return $res;
    }




//   根据条件获取菜单管理内容
    public function getMenuContent($contition = array(), $pageNum = 0, $pageSize = 3)
    {
        if (!is_array($contition)) {
            return 0;
        }
        if (!is_numeric($pageNum) || !is_numeric($pageSize)) {
            return 0;
        }
        if (in_array(intval($contition['type']), array(0, 1)) && $contition != null) {
            $dataCon['type'] = intval($contition['type']);
        }
        $dataCon['status'] = array('neq', -1);
        $offset = ($pageNum - 1) * $pageSize;
        $res = $this->db->where($dataCon)->order('listorder desc, menu_id desc')->limit($offset, $pageSize)->select();

//        dump($this->db->getLastSql());

        return $res;
    }


//     获取菜单数据总量
    public function getMenuCount($data)
    {
        if (!in_array(intval($data), array(0, 1) && $data != null)) {
            $dataCon['type'] = intval($data['type']);
        }
        $dataCon = array(
            'status' => array('neq', -1),
        );
        return $this->db->where($dataCon)->count();
    }

//添加数据的方法
    public function insert($data)
    {
        if (!$data || !is_array($data)) {
            return 0;
        }
        $res = $this->db->add($data);
        return $res;
    }

//删除数据
    public function update($data)
    {
        if (!$data || !is_array($data)) {
            return 0;
        }
        $dataCon = array(
            'status' => $data['status']
        );
        $res = $this->db->where('menu_id=' . $data['id'])->save($dataCon);
        return $res;
    }

//根据id获取一行信息:
    public function getMenuById($menu_id)
    {
        if (!is_numeric($menu_id)) {
            return 0;
        }
        $res = $this->db->where('menu_id=' . $menu_id)->find();
        return $res;
    }

//
    public function updateMenuById($menu_id, $data)
    {
        if (!is_numeric($menu_id) || !is_array($data)) {
            return 0;
        }
        $res = $this->db->where('menu_id='.$menu_id)->save($data);
        return $res;
    }
 public function updateListorderById($menu_id,$newListorder)
 {
     if(!is_numeric($menu_id) || !is_numeric($newListorder))
     {
         return 0 ;
     }
     $data = array(
         'listorder'=>$newListorder,
     );

     $res = $this->db->where('menu_id='.$menu_id)->save($data);
     return $res;

 }

 public function getMenuByType($data)
 {
     if(!$data)
     {
         return 0;
     }

     $res = $this->db->where('menu_id='.$data)->find();
     return $res;

 }

 public function getWebSiteMenu()
 {
     $data = array('status'=>1);
    return $this->db->where($data)->select();

 }

}