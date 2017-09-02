<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/21
 * Time: 下午5:09
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Exception;

class PositioncontentController extends Controller
{

    public function index()
    {

        $data = array();
        if (isset($_REQUEST['title']) && $_REQUEST['title']) {
            $data['title'] = $_REQUEST['title'];
        }
        $position_id = $_REQUEST['position_id'] ? $_REQUEST['position_id'] : 2;
        $data['position_id'] = $position_id;
        $res = D('PositionContent')->getPositionContents($data);

        $this->assign('positionId', $position_id);
        $this->assign('title', $data['title']);

        $this->assign('contents', $res);


        $positions = D('Position')->getPositions();

        $this->assign('positions', $positions);

        $this->display();
    }

    public function edit()
    {
        if ($_GET) {
            $id = $_GET['id'];

            $res = D('PositionContent')->getPositionContentById($id);
            $positions = D('Position')->getPositions();
            $this->assign('positions', $positions);


            $this->assign('vo', $res);

        }
        $this->display();
    }

    public function delete()
    {
        if ($_POST) {
            $pos_id = $_POST['id'];
            $status = $_POST['status'];

            $res = D('PositionContent')->setStatusById(intval($pos_id), intval($status));

            if ($res) {
                return show(1, '删除成功');
            }
            return show(0, '删除失败');
        }
    }

    public function add()
    {
        if ($_POST) {
            if (!$_POST['title'] || !isset($_POST['title'])) {
                show(0, '标题不能为空');
            }
            if (!$_POST['position_id'] || !isset($_POST['position_id'])) {
                show(0, '选择推荐位不能为空');
            }

            if (!$_POST['thumb'] || !isset($_POST['thumb'])) {

                show(0, '必须上传封面图片');
            }
            if (!$_POST['url'] || !isset($_POST['news_id'])) {
                show(0, 'url和news_id不能为空');
            }
            if (!$_POST['status']) {
                show(0, '状态值不能为空不能为空');
            }
            $res = D('PositionContent')->insert($_POST);

            if ($res) {
                return show(1, '添加成功');
            }
            return show(0, '添加失败');
        }

        $positions = D('Position')->getPositions();
        $this->assign('positions', $positions);

        $this->display();
    }

//    排序

    public function listorder()
    {
        if ($_POST) {
            $listorder = $_POST['listorder'];
            try {
                foreach ($listorder as $key => $value) {
                    D('PositionContent')->updateListorderById(intval($key), intval($value));
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
            return show(1, '更新排序成功');
        }
    }

    public function update()
    {
        if($_POST)
        {
            $id = $_POST['id'];
            unset($_POST['id']);

            $res = D('PositionContent')->updateById($id,$_POST);
            if($res)
            {
                return show(1,'更新成功');
            }
            return show(0,'更新失败');
        }
    }


}