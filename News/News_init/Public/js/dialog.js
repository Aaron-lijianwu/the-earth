/**
 * Created by lijianwu on 2017/8/17.
 */
//TODO #5 error和success的封装
var dialog = {
  error: function (message) {
      layer.open({
          icon:2,
          title:'登录失败',
          content:message

      });
  },
    success: function (message,url)
    {
      layer.open({

          icon:1,
          title:'登录成功',
          content:message,
          yes:function () {
              location.href=url;
          }

      });
    },
};