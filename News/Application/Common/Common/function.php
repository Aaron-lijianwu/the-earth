<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/21
 * Time: 下午1:43
 */
function show($status,$message,$data = array()){
    $result = array(
        'status' => $status,
        'message'=>$message,
        'data'=> $data,
    );
    exit(json_encode($result));
}
function MD5Password($password) {
    return md5($password . C('MD5_PRE'));
}
function getAdminUsername()
{
    return isset($_SESSION['adminUser']['username'])?$_SESSION['adminUser']['username'] : '';
}
function getAdminUrl($row)
{
    $url = './admin.php?c='.$row['c'].'&a='.$row['f'];
    return $url;
}

//获取当前菜单的活跃状态
function getActive($conName)
{
//    CONTROLLER_NAME;//获取当前控制器的名称.
//    ACTION_NAME;//获取当前方法名.
//    将字符串字母全都转化为小写.
    $c=strtolower(CONTROLLER_NAME);

    if ($c==strtolower($conName))
    {
        return 'class="active"';
    }
   return '';

}

//根据type返回对应的名称

function getMenuType($type)
{
    return $type == 1 ? '后台模块':($type == 0 ? '前端模块':'');
}

function status($sta)
{
    return $sta == 1 ? '正常':($sta == -1 ? '关闭':'');
}
function isThumb($thumb)
{
    if($thumb)
    {
        return '<span style="color: red">有</span>';
        return '无';
    }
}
function getCatName($webSiteMenu,$catid)
{
//    $res = D('menu')->getMenuByType($catid);
//    return $res['name'];

   for($i=0;$i<count($webSiteMenu);$i++)
   {
       if($webSiteMenu[$i]['menu_id'] == $catid)
       {
           return $webSiteMenu[$i]['name'];
       }
   }
}
function getCopyFromById($copyfrom)
{
        return C('COPY_FROM')[$copyfrom]?C('COPY_FROM')[$copyfrom]:'';
}






