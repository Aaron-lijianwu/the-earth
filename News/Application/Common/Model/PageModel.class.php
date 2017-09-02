<?php
/**
 * Created by PhpStorm.
 * User: lijianwu
 * Date: 2017/9/1
 * Time: 下午7:47
 */

namespace Common\Model;


use Think\Model;

class PageModel extends Model{

//   总条数
    public $titalCount;
    protected $tableName = 'menu';
//    数据库的变量
    private $table;

//  每页显示几条数据
    public $pageSize;
//  当前页
    public $pageNow;
//  总页数
    private $pageCount;
    public function __construct($titalCount,$table,$pageCount,$pageSize,$pageNow)
    {
        $this->titalCount = $titalCount;
        $this->table = M('menu');
        $this->pageSize = $pageSize;
        $this->pageNow = $pageNow;
        $this->pageCount = $pageCount;
    }
    public function PageCounts()
    {

        return $this->titalCount = $this->table->count();
//      总页数
        $pageCount = ceil($titalCount/$pageSize);
//      将要跳转的页.
        $offset = ($pageNew-1)*$pageSize;




        $this->table->limit($offset,$pageSize)->select();
//        下一页
        $next = ($pageNew==$pageCount) ? 0 : ($pageNew+1);
//      最后一页.
        $end = ($pageNew==$pageCount)?$titalCount:($pageNew*$pageSize);
//      上一页
        $pre = ($pageNew == 1)? 0 : ($pageNew-1);



    }


}