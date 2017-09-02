/**
 * Created by lijianwu on 2017/8/22.
 */
//公共js函数.

$('#button-add').click(function () {
    // 点击前往./admin.php?c=menu&c=add.
    var url = SCOPE.add_url;

    window.location.href = url;
});

$('#cms-button-submit').click(function () {
//    获取到前台的表单数据:
    var dataArry = $('#cms-form').serializeArray();
    // console.log(dataArry);
//    遍历数组.

    var data = {};
    $.each(dataArry,function () {
        //this是每一次遍历出来的那个对象
        data[this.name] = this.value;

    });


    $.post(SCOPE.save_url,data,function (res) {
        if(res.status==1)
        {
            return dialog.success(res.message,SCOPE.jump_url);
        }
        if(res.status==0)
        {
            return dialog.error(res.message)
        }

    },'JSON');
});

//    删除按钮点击事件
    $('.cms-table #cms-delete').click(function () {

        var id = $(this).attr('attr-id');
    //    删除是指数据库里的这个id对应的status改为-1
        var data = {
            id : id,
            status : -1
        };
        layer.open({
            title : '提示',
            icon : 3,
            btn : ['yes','no'],
            content:'确认删除',
            yes :function () {
               toDelete(data);
            }
        });
    });


function toDelete(data) {
    $.post(SCOPE.delete_url,data,function (res) {
        if(res.status == 1)
        {
            return dialog.success(res.message,SCOPE.jump_url);
        }
        if(res.status == 0)
        {
            return dialog.error(res.message);
        }
    },'JSON');
}

// 编辑方法

$(".cms-table #cms-edit").click(function () {
    var id = $(this).attr('attr-id');

   // 跳转到后端的menu的edit方法:
    window.location.href = SCOPE.edit_url+'&id=' + id;

});



// 更新排序,获取点击事件.

$('#button-listorder').click(function () {
//    获取input

    // alert(123);
    var dataArray = $("#cms-listorder").serializeArray();


    var data = {};

    $.each(dataArray,function () {
        data[this.name] = this.value;
    });

    $.post(SCOPE.listorder_url,data,function (res) {
        if(res.status == 1)
        {
            return dialog.success(res.message,SCOPE.jump_url);
        }
        if(res.status == 0)
        {
            return dialog.error(res.message);
        }
    },'JSON');
});

$('#sub_data').click(function () {
   var dataArry = $('#aaa').serializeArray();
   var data={};
   $.each(dataArry,function () {
       data[this.name] = this.value();
   });
    url: "/admin.php?c=Content&a=ContentById";
    $.get(url,data,function (res) {
        $('#cms-listorder').html(res);
    });
});


// $('select[name="catid"]').change(
//     function () {
//
//
//         var catid = $(this).val();
//
//         alert(catid);
//
//         $.ajax({
//             url: "/admin.php?c=Content&a=ContentById",
//             type: 'post',
//             data: 'catid='+catid,
//             dataType: "html",
//
//             success: function (data) {
//
//
//
//                 $('#cms-listorder').html(data);
//
//             }
//         });
//
//     }
// );






// 推送的方法
$("#cms-push").click('click',function () {
    var id =  $("#select-push").val();
    if(id == 0)
    {
        return dialog.error('请选择推荐位');
    }
    var pushData = {};
    var postData= {};

//    被选中的checkbox,获取其value
    $.each($('input[name="pushcheck"]:checked'), function(i) {
       pushData[i] = $(this).val();
    });

    postData['newsIDs'] = pushData;
    postData['position_id']=id;

   $.post(SCOPE.push_url,postData,function (res) {
       if(res.status == 1)
       {
           return dialog.success(res.message,SCOPE.jump_url);
       }
       if(res.status==0)
       {
           return dialog.error(res.message);
       }
   })
});


//ajax数据库交互


window.onload = function () {
    $('#pageId1').toggleClass('active');

};
function searchByNum(num) {
    var p = num;
    var data = {
        p : p,
    };
    var url = SCOPE.search_url;
    $.post(url,data,function (res) {

        $('.container-fluid').html(res);
        changeClass(p);
    },'HTML');
}
function searchByNext() {
    var id = $('.pagination .active').attr('data-id');
    console.log(id);
    var newId = Number(id)+1;
    if (newId == 3)
    {

    }
    console.log(newId);
    var data = {
        p : newId,
    }
    var url = SCOPE.search_url;
    $.post(url,data,function (res) {
        $('.container-fluid').html(res);
        changeClass(newId);
    },'HTML');
}
function searchByPrev() {
    var id = $('.pagination .active').attr('data-id');
    console.log(id);
    var newId = Number(id)-1;
    console.log(newId);
    var data = {
        p : newId,
    }
    var url = SCOPE.search_url;
    $.post(url,data,function (res) {
        $('.container-fluid').html(res);
        changeClass(newId);
    },'HTML');

}
function changeClass(id) {
    $('#pageId'+id).toggleClass('active');
}





