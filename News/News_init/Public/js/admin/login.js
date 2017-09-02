/**
 * Created by lijianwu on 2017/8/17.
 */
// var login = {
//   check: function () {
//       //TODO #3 前端获取用户名的密码,进行判断
//       //判断为空,提示框
//       var username = $('#inputUsername').val();
//
//       var password =$('#inputPassword').val();
//
//       //用户名和密码不为空
//       if(!username)
//       {
//          return dialog.alert('用户名不能为空');
//       }
//       if (!password){
//         return  dialog.alert('密码不能为空');
//       }
//
//       //TODO #4 Ajax给后台.
//
//
//       var url ='./index.php?m=admin&c=login&a=check';
//       var data = {
//           'username' : username,
//           'password' : password
//       };
//
//       $.post(url,data,function (result) {
//       //    根据result的结果,提示框.
//
//       },'JSON');
//   }
// };


var login = {
    check : function () {
        var username = $("input[name='username']").val();
        var password = $("input[password='password']").val();

    //    判断用户名和密码是否为空
        var res = !username || !password ?(!username ? '用户名不能为空':(!password ? '密码不能为空':null)):null;
        if(res)
        {
            dialog.error();
        }

       var url='../admin.php?c=admin&a=check';
        var data={
           username:username,
            password:password
        };
        $.post(url,data,function (res) {
            if(res.status == 1)
            {
                dialog.success(res.message,'../admin.php?c=index');
            }
            if(res.status == 0)
            {
                dialog.error(res.message);
            }

        })

    }
}