<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/8/21
 * Time: 下午7:58
 */

//function show($status,$message)
//{
//    $result = array(
//        'status'=> $status,
//        'message'=>$message
//    );
//    exit(json_encode($result));
//}

function MD5Password($password)
{
    return md5($password . C('MD5_PRE'));
}
function getAdminUser()
{
   return isset($_SESSION['adminUser']['username'])?$_SESSION['admin']['username']: '';
}
function getAdminUrl($row)
{
    $url = './admin.php?c='.$row['c'].'&a='.$row['f'];
    return $url;

}