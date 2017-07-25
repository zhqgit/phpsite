/**
 * Created by ZHQ on 2017/7/24.
 */

$('body').on('click','.delete',function(e){
    console.log(this);
    $("#delalert").trigger("click");
});

$('body').on('click','#delbtn',function(e){
    var filename = $(".filename").text();

    $.ajax({
        type: "GET",
        url: "http://test02.com/TaskDemo/easyBlog/delete.php?entry="+filename,
        dataType: "json",
        success: function (data) {
            console.log(data.msg);
            $('#myModal').modal('hide');
            window.location.reload();
        },
        error: function (jqXHR) {
            alert("发生错误：" + jqXHR.status);
        }
    });
});


// $('body').on('click','#delete',function(e){
//     // console.log(this); // this 就是button.item这个dom元素。
//     // console.log($(this).parent().children(".filename").text());
//     // console.log(e); // e 是jq处理好的事件对象，.target 触发源（item中不存在冒泡时就是this） .type 事件类型
//
//     var filename = $(this).parent().children(".filename").text();
//
//     e.stopPropagation(); // 阻止事件冒泡
//     e.preventDefault(); // 阻止默认行为 比如a标签的调整 提交按钮的提交等
//
//     console.log('点击了title');
//     $.ajax({
//         type: "GET",
//         url: "http://test02.com/TaskDemo/easyBlog/delete.php?entry="+filename,
//         dataType: "json",
//         success: function (data) {
//
//         },
//         error: function (jqXHR) {
//             alert("发生错误：" + jqXHR.status);
//         }
//     });
// });