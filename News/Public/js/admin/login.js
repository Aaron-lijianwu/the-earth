/**
 * Created by lijianwu on 2017/8/17.
 */

var login = {
//   接收从前端传来的数据.
    check :function () {
        var username = $("input[name = 'username']").val();
        var password = $("input[name = 'password']").val();

    //    判断数据是否为空
        var result = !username || !password ? (!username ? '用户名不能为空':(!password ? '密码不能为空':null)):null;
        if(result)
        {
            dialog.error(result);
        }


    //    准备数据和url传给后台.
        var url = './admin.php?c=login&a=check';

        var data = {
            username : username,
            password : password
        };


        $.post(url,data,function (res) {


        //    从前端传回来的数据,以json格式res.
            if(res.status==1){
                dialog.success(res.message,'./admin.php?c=index');
            }
            if(res.status==0)
            {
                dialog.error(res.message);
            }

        },'JSON');

    }
};