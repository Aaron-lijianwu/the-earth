<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/23
 * Time: 下午3:16
 */

namespace Common\Model;

use Think\Model;

class PositionModel extends Model{

    private $_db = '';
    public function __construct()
    {
        parent::__construct();
        $this->_db = M('position');

    }
    public function getPositions()
    {
//        $data = array(
//            'status'=> 1,
//        );


        $data['status'] = array('neq',-1);
        $res = $this->_db->where($data)->select();
        return $res;
    }
    public function insert($data=array())
    {
        if(!$data || !is_array($data))
        {
            return 0;
        }
        $data['create_time']=time();
        $res = $this->_db->add($data);
        return $res;
    }
    public function setStatusById($id,$status)
    {
        if(!is_numeric($status) || !is_numeric($id))
        {
            return 0 ;
        }
        $data['status'] = $status;

        $res = $this->_db->where('id='.$id)->save($data);
        return $res;
    }


    public function getPositionById($id)
    {
        if(!is_numeric($id))
        {
            return 0 ;
        }
        $res = $this->_db->where('id='.$id)->find();
        return $res;
    }
    public function updatePositionById($id,$data=array())
    {
        if(!is_numeric($id) || !is_array($data) || !$data)
        {
            return 0;
        }
        $res = $this->_db->where('id='.$id)->save($data);
        return $res;
    }



}