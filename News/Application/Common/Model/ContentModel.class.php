<?php

namespace Common\Model;

use Think\Model;

class ContentModel extends Model
{
    private $_db = '';
    protected $tableName = 'news';
    public function __construct()
    {
//        parent::__construct();
        $this->_db = M('news');
    }

    public function getContents($data)
    {
        $condition = $data;
        if(isset($data['title']) && $data['title'])
        {
            $condition['title'] = array('like','%'.$data['title'],'%');
        }
        if(!is_array($data))
        {
            return 0;
        }
        if($data['catit'])
        {
            unset($condition['catit']);
        }
        $condition['status'] = array('neq',-1);
        return $this->_db->where($condition)->select();
    }


//    分页管理
public function getMenuContent($pageNum=0,$pageSize=3)
{
//    if(!is_array($contition))
//    {
//        return 0;
//    }
    if(!is_numeric($pageNum) || !is_numeric($pageSize))
    {
        return 0;
    }
    $data['status'] = array('neq',-1);

    $offset = ($pageNum-1)*$pageSize;

    $res = $this->_db->where($data)->order('listorder desc,news_id desc')->limit($offset,$pageSize)->select();

    return $res;

}
public function getMenuCount($status)
{
    if(!$status)
    {
        return 0;
    }
    $data['status'] = array('neq',-1) ;
    return $this->_db->where($data)->count();
}


    public function updateListorderById($id, $newListorder)
    {
        if (!is_numeric($id) || !is_numeric($newListorder)) {
            return 0;
        }
        $data['listorder'] = $newListorder;
        $res = $this->_db->where('news_id=' . $id)->save($data);
        return $res;
    }




    //    推送
    public function getNewsByIdIn($newsIds = array())
    {
        if (!is_array($newsIds) || !$newsIds) {
            return 0;
        }
        $data = array(
            'news_id' => array('in', implode(',', $newsIds)),
        );
        $res = $this->_db->where($data)->select();
        return $res;
    }



}


