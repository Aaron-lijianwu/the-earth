<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/21
 * Time: 下午5:08
 */

namespace Admin\Controller;


use Think\Controller;

class ContentController extends Controller
{

    public function index()
    {

        $data = array();
        if (isset($_REQUEST['title']) && $_REQUEST['title']) {
            $data['title'] = $_REQUEST['title'];
        }
        $catid = $_REQUEST['catid'] ? $_REQUEST['catid'] : false;
        $data['catid'] = $catid;
        $res = D('Content')->getContents($data);
        $this->assign('news', $res);

        $menus = D('Menu')->getWebSiteMenu();
        $this->assign('WebSiteMenu', $menus);
        $this->assign('title', $data['title']);
        $this->assign('catid', $catid);

        $position = D('Position')->getPositions();

        $this->assign('positions', $position);


        $this->display();

    }

//    分页功能

public function fenye()
{

    $pageNum = $_REQUEST['p']?$_REQUEST['p']:1;
    $pageSize = 3;
    $res = D('Content')->getMenuContent($pageNum,$pageSize);
    $this->assign('news',$res);

    $data['status'] = array('neq',-1) ;

    $menuCount = D('Content')->getMenuCount($data);
    $pageObj = new \Think\Page($menuCount,$pageSize);
    $pageString = $pageObj->show();
    将数据发送到前端页面.
    $this->assign('pageStr',$pageString);


    $this->display();
}
//    更新排序.

    public function listorder()
    {
        if ($_POST) {
            $listorder = $_POST['listorder'];
            try {
                foreach ($listorder as $key => $value) {
                  return $this->D('Content')->updateListorderById(intval($key), intval($value));
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
            return show(1, '更新排序成功');
        }

    }


//    推送过来的新闻

    public function push()
    {
        if ($_POST) {
            if (!isset($_POST['newsIDs']) || !$_POST['newsIDs']) {
                return show(0, '请选择要推送的文章');
            }
            $newsIDs = $_POST['newsIDs'];
            $position_id = $_POST['position_id'];  //数字
//           获取所有在NewsIDS里的新闻信息.
            $newsArray = D('Content')->getNewsByIdIn($newsIDs);


            try {
                foreach ($newsArray as $news) {
                    $data = array(
                        'position_id' => $position_id,
                        'title' => $news['title'],
                        'news_id' => $news['news_id'],
                        'thumb' => $news['thumb'],
                        'create_time' => $news['create_time'],
                        'status' => $news['status']
                    );

                    $res = D('PositionContent')->insert($data);
                    return $res;
                }
            } catch (Exception $e) {
                return show(0, $e->getMessage());
            }
            return show(1, '添加到推荐位成功');
        }
    }




    public function ContentById()
    {

        $menus = D('Menu')->getWebSiteMenu();
        $this->assign('WebSiteMenu', $menus);
        $catid = $_REQUEST['catid'] ? $_REQUEST['catid'] : false;
        $data['catid'] = $catid;


    }
}