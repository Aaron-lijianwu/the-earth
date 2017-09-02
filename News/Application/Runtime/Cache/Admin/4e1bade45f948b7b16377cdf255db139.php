<?php if (!defined('THINK_PATH')) exit();?><div class="container-fluid" >

    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">

            <ol class="breadcrumb">
                <li>
                    <i class="fa fa-dashboard"></i>  <a href="/admin.php?c=menu">菜单管理</a>
                </li>
                <li class="active">
                    <i class="fa fa-table"></i>菜单内容
                </li>
            </ol>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <form action="./admin.php" method="get">
            <div class="input-group">
                <span class="input-group-addon">类型</span>
                <select class="form-control" name="type">
                    <option value='-1' >请选择类型</option>

                    <option value="1"
                    <?php if($type == 1): ?>selected="selected"<?php endif; ?>>后台菜单</option>
                    <option value="0" <?php if($type == 0): ?>selected="selected"<?php endif; ?>>前端导航</option>
                </select>

                <span class="input-group-btn">
                  <button id="sub_data" type="submit" class="btn btn-primary"><i class="glyphicon glyphicon-search"></i></button>
                </span>

            </div>

            <input type="hidden" name="c" value="menu"/>
            <input type="hidden" name="a" value="index"/>


        </form>
    </div>
    <div>
        <button  id="button-add" type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>添加 </button>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h3></h3>
            <div class="table-responsive">
                <form id="cms-listorder">
                    <table class="table table-bordered table-hover cms-table">
                        <thead>
                        <tr>
                            <th width="14">排序</th>
                            <th>id</th>
                            <th>菜单名</th>
                            <th>模块名</th>
                            <th>类型</th>
                            <th>状态</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($menus)): $i = 0; $__LIST__ = $menus;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$menu): $mod = ($i % 2 );++$i;?><tr>
                                <td><input size="4" type="text" name="listorder[<?php echo ($menu["menu_id"]); ?>]" value="<?php echo ($menu["listorder"]); ?>"/></td>
                                <td><?php echo ($menu["menu_id"]); ?></td>
                                <td><?php echo ($menu["name"]); ?></td>
                                <td><?php echo ($menu["m"]); ?></td>
                                <td><?php echo (getMenuType($menu["type"])); ?></td>
                                <td><?php echo (status($menu["status"])); ?></td>
                                <td><span class="glyphicon glyphicon-edit" aria-hidden="true" id="cms-edit" attr-id="<?php echo ($menu["menu_id"]); ?>"></span>    <a  href="javascript:void(0)" attr-id="<?php echo ($menu["menu_id"]); ?>" id="cms-delete"  attr-a="menu" attr-message="删除"><span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span></a></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>

                        </tbody>
                    </table>
                </form>
                <nav>
                    <div class="container">
                        <ul class="pagination">
                            <!--<li><a href="#"><</a></li>-->
                            <!--<li><a href="#">1</a></li>-->
                            <!--<li><a href="#">2</a></li>-->
                            <!--<li><a href="#">3</a></li>-->
                            <!--<li><a href="#">4</a></li>-->
                            <!--<li><a href="#">5</a></li>-->
                            <!--<li><a href="#">></a></li>-->
                            <!---->
                            <?php
 echo $pageSpi['prev']; for ($i = 0;$i <= count($pageStr) ;$i++) { echo $pageStr[$i]; } echo $pageSpi['next']; ?>

                        </ul>
                    </div>
                </nav>
                <div>
                    <button  id="button-listorder" type="button" class="btn btn-primary dropdown-toggle" ><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>更新排序 </button>
                </div>
            </div>
        </div>

    </div>
    <!-- /.row -->



</div>