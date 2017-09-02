<?php if (!defined('THINK_PATH')) exit();?><table class="table table-bordered table-hover cms-table">
    <thead>
    <tr>
        <th id="cms-checkbox-all" width="10"><input type="checkbox"/></th>
        <th width="14">排序</th><!--6.7-->
        <th>id</th>
        <th>标题</th>
        <th>栏目</th>
        <th>来源</th>
        <th>封面图</th>
        <th>时间</th>
        <th>状态</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if(is_array($news)): $i = 0; $__LIST__ = $news;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$new): $mod = ($i % 2 );++$i;?><tr>
            <td><input type="checkbox" name="pushcheck" value="<?php echo ($new["news_id"]); ?>"></td>
            <td><input size=4 type='text'  name='listorder[<?php echo ($new["news_id"]); ?>]' value="<?php echo ($new["listorder"]); ?>"/></td><!--6.7-->
            <td><?php echo ($new["news_id"]); ?></td>
            <td><?php echo ($new["title"]); ?></td>
            <td><?php echo (getCatName($new["catid"])); ?></td>
            <td><?php echo (getCopyFromById($new["copyfrom"])); ?></td>
            <td>
                <?php echo (isThumb($new["thumb"])); ?>
            </td>
            <td><?php echo (date("Y-m-d H:i",$new["create_time"])); ?></td>
            <td><span  attr-status="<?php if($new['status'] == 1): ?>0<?php else: ?>1<?php endif; ?>"  attr-id="<?php echo ($new["news_id"]); ?>" class="news_cursor cms-on-off" id="cms-on-off" ><?php echo (status($new["status"])); ?></span></td>
            <td><span class="news_cursor glyphicon glyphicon-edit" aria-hidden="true" id="cms-edit" attr-id="<?php echo ($new["news_id"]); ?>" ></span>
                <a href="javascript:void(0)" id="cms-delete"  attr-id="<?php echo ($new["news_id"]); ?>"  attr-message="删除">
                    <span class="glyphicon glyphicon-remove-circle" aria-hidden="true"></span>
                </a>
                <a target="_blank" href="/index.php?c=detail&a=view&id=<?php echo ($new["news_id"]); ?>" class="news_cursor glyphicon glyphicon-eye-open" aria-hidden="true"  ></a>

            </td>
        </tr><?php endforeach; endif; else: echo "" ;endif; ?>

    </tbody>
</table>
<nav>

    <ul >
        <?php echo ($pageres); ?>
    </ul>

</nav>
<div>
    <button  id="button-listorder" type="button" class="btn btn-primary dropdown-toggle" ><span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span>更新排序</button>
</div>