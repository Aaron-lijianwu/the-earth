/**
 * Created by lijianwu on 2017/8/17.
 */

var dialog = {

    error : function (message) {
        layer.open({

            icon :2,
            titlt:'错误提示',
            content:message,

        });

        },
    success : function (message,url) {
        layer.open({
             icon:1,
            title:'登录成功',
            content:message,
            yes:function () {
                location.href = url;
            }
        });

    }

};

