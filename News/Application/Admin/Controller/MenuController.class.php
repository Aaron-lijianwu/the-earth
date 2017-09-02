<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/21
 * Time: 下午5:07
 */

namespace Admin\Controller;

use Think\Controller;
use Think\Exception;


class MenuController extends Controller
{
   public function index()
   {
       $data = array();
       if (isset($_REQUEST['type']) && in_array($_REQUEST['type'],array(0,1)))
       {
           $data['type'] = intval($_REQUEST['type']);
           $this->assign('type',$_REQUEST['type']);
       }
       else
       {
           $this->assign('type',-1);
       }
       $pageNum = $_REQUEST['p']?$_REQUEST['p']:1;

       $pageSize = 3;
//       显示菜单管理首页数据
       $res = D('Menu')->getMenuContent($data,$pageNum,$pageSize);
       $this->assign('menus',$res);

       $menuCount = D('Menu')->getMenuCount($data);

       $pageNumber = ceil($menuCount/$pageSize);
       $pageStr = array();
       for($i = 1;$i <= $pageNumber ; $i++)
       {
           $pageli = "<li id=pageId$i data-id=$i><a href=\"#\"  onclick='searchByNum($i)'>$i</a></li>";
           array_push($pageStr,$pageli);
       }

       //上一页与下一页
       if ($pageNum !== $pageNumber) {
           $pageSpi['next'] = "<li><a href=\"#\" onclick='searchByNext()' >></a></li>";
       }
       if($pageNum !=1) {
           $pageSpi['prev'] = "<li><a href=\"#\" onclick='searchByPrev()' ><</a></li>";
       }

       $this->assign('pageStr',$pageStr);
       $this->assign('pageSpi',$pageSpi);




//       $this->assign('count',$res);
      /* $pageObj = new \Think\Page($menuCount,$pageSize);
       $pageString = $pageObj->show();

//       将数据发送到前端页面.
       $this->assign('pageStr',$pageString);*/



       $this->display();


   }

   public function search()
   {


       $data = array();
       if (isset($_REQUEST['type']) && in_array($_REQUEST['type'],array(0,1)))
       {
           $data['type'] = intval($_REQUEST['type']);
           $this->assign('type',$_REQUEST['type']);
       }
       else
       {
           $this->assign('type',-1);
       }
       $pageNum = $_REQUEST['p']?$_REQUEST['p']:1;

       $pageSize = 3;
//       显示菜单管理首页数据
       $res = D('Menu')->getMenuContent($data,$pageNum,$pageSize);
       $this->assign('menus',$res);

       $menuCount = D('Menu')->getMenuCount($data);

       $pageNumber = ceil($menuCount/$pageSize);
       $pageStr = array();
       for($i = 1;$i <= $pageNumber ; $i++)
       {
           $pageli = "<li id=pageId$i data-id=$i><a href=\"#\"  onclick='searchByNum($i)'>$i</a></li>";
           array_push($pageStr,$pageli);
       }

       //上一页与下一页
       if ($pageNum != $pageNumber) {
           $pageSpi['next'] = "<li><a href=\"#\" onclick='searchByNext()' >></a></li>";
       }
       if ($pageNum != 1)
       {
           $pageSpi['prev'] = "<li><a href=\"#\" onclick='searchByPrev()' ><</a></li>";
       }

       $this->assign('pageStr',$pageStr);
       $this->assign('pageSpi',$pageSpi);

       $html_go = $this->fetch('content');
       exit($html_go);


   }

   public function add(){
//     判断数据
       if ($_POST)
       {
          if(!$_POST['name'] || !isset($_POST['name']))
          {
              return show(0,'菜单名不能为空');
          }
           if(!isset($_POST['type']))
           {
                return show(0,'菜单名类型不能为空');
           }
           if(!$_POST['m'] || !isset($_POST['m']))
           {
               return show(0,'模块名不能为空');
           }
           if(!$_POST['c'] || !isset($_POST['c']))
           {
               return show(0,'控制器名不能为空');
           }
           if(!$_POST['f'] || !isset($_POST['f']))
           {
               return show(0,'方法名不能为空');
           }
           if(!$_POST['status'] || !isset($_POST['status']))
           {
               return show(0,'状态值不能为空');
           }
//           存入数据库
           $res = D('Menu')->insert($_POST);
           if($res)
           {
               show(1,'添加功能成功');
           }
           return show(0,'添加失败');




       }
       $this->display();
   }

//   删除数据.

   public function delete()
   {
       if($_POST)
       {
           $res = D('menu')->update($_POST);
           if($res)
           {
               return show(1,'删除成功');
           }
           return show(0,'删除失败');
       }
   }


//   更新修改后的数据
   public function edit()
   {
       if ($_GET)
       {
           $menu_id = $_GET['id'];
//           根据id查询这个菜单的信息.
           $res = D('Menu')->getMenuById($menu_id);
           $this->assign('menu',$res);
           $this->display();
       }

   }

   public function update()
   {
       if($_POST)
       {
           $menu_id = $_POST['menu_id'];
           unset($_POST['menu_id']);
           $res = D('Menu')->updateMenuById($menu_id,$_POST);
           if($res)
           {
               return show(1,'更新成功');
           }
           return show(0,'更新失败');
       }
   }
   public function listorder()
   {
       if($_POST)
       {
          $listorderArray = $_POST['listorder'];
          try{
              foreach ($listorderArray as $key => $value)
              {
                  $res = D('Menu')->updateListorderById(intval($key),intval($value));
              }
          }catch (Exception $e)
          {
              return show(0,$e->getMessage());
          }
          return show(1,'更新成功');
       }
   }


}