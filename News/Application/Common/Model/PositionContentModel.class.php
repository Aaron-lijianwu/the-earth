<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/23
 * Time: 下午7:29
 */

namespace Common\Model;

use Think\Model;

class PositionContentModel extends Model{
    private $_db = '';
    public function __construct()
    {
        parent::__construct();

        $this->_db = M('position_content');

    }
    public function getPositionContents($data=array())
    {
        //title 和 position_id
        $condition=$data;
        if (isset($data['title'])&& $data['title'])
        {
            $condition['title'] = array('like','%'.$data['title'].'%');
        }
        $condition['status'] = array('neq',-1);

        $res = $this->_db->where($condition)->order('listorder desc,id desc')->select();
        return $res;
    }
    public function setStatusById($id,$status)
    {
        if(!is_numeric($id) || !is_numeric($status))
        {
            return 0;
        }
        $data['status'] = $status;
        $res = $this->_db->where('id='.$id)->save($data);
        return $res;
    }



    public function getPositionContentById($id)
    {
        if (!is_numeric($id))
        {
            return 0;
        }
        $res =  $this->_db->where('id='.$id)->find();
        return $res;
    }
//    public function insert($data)
//    {
//        if (!$data || !is_array($data)) {
//            return 0;
//        }
//        $data['create_time'] = time();
//        $res = $this->_db->add($data);
//        return $res;
//
//    }

//    更新
    public function updateListorderById($id,$newListorder)
    {
        if(!is_numeric($id) || !is_numeric($newListorder))
        {
            return 0;
        }
        $data['listorder'] = $newListorder;
        $res = $this->_db->where('id='.$id)->save($data);
        return $res;
    }
    public function insert($data = array())
    {
        if(!is_array($data)|| !$data)
        {
            throw_exception('数据不符合要求');
        }
        if(!$data['create_time'])
        {
            $data['create_time']=time();
        }
        return $this->_db->add($data);
    }

    public function updateById($id,$data)
    {
        if (!is_numeric($id) || !is_array($data)) {
            return 0;
        }
        $res = $this->_db->where('id='.$id)->save($data);
        return $res;
    }

}