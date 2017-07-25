/**
 * Created by ZHQ on 2017/7/23.
 */
$(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "http://test02.com/TaskDemo/easyBlog/show.php",
            dataType: "json",
            success: function (data) {
                // if (data.success) {
                //     $("#searchResult").html(data.msg);
                // } else {
                //     $("#searchResult").html("出现错误：" + data.msg);
                // }
                $("#show").html(data);
                $.each(data,function (i,n) {
                    $("#show").append("<div class='summary'>"+"<h2 class='title'><a>"+data[i]['SUBJECT']+"</a></h2>"+"<h2>"+data[i]['DATE']+"</h2>"+"<h3>"+data[i]['CONTENT']+"</h3>"+"<h4 class='filename'>"+data[i]['FILENAME']+"</h4>"+"<h4><a class='edit' href='edit.html'>编辑|</a><a class='delete'>删除</a></h4>"+"</div>");

                });
                console.log(data);
                console.log(data[0]);
                console.log(data[0]['SUBJECT']);
                console.log(data[0]['DATE']);
                console.log(data[0]['CONTENT']);
                console.log(data[0]['FILENAME']);
            },
            error: function (jqXHR) {
                alert("发生错误：" + jqXHR.status);
            }
        });
});


$('body').on('click','.title',function(e){
    // console.log(this); // this 就是button.item这个dom元素。
    // console.log($(this).parent().children(".filename").text());
    // console.log(e); // e 是jq处理好的事件对象，.target 触发源（item中不存在冒泡时就是this） .type 事件类型

    var filename = $(this).parent().children(".filename").text();

    e.stopPropagation(); // 阻止事件冒泡
    e.preventDefault(); // 阻止默认行为 比如a标签的调整 提交按钮的提交等

    console.log('点击了title');
    $.ajax({
        type: "GET",
        url: "http://test02.com/TaskDemo/easyBlog/post2.php?entry="+filename,
        dataType: "json",
        success: function (data) {
            console.log(data);
            $("#show").empty();
            $("#show").append("<div class='summary'>"+"<h2 class='title'><a>"+data[0]+"</a></h2>"+"<h2>"+data[1]+"</h2>"+"<h3>"+data[2]+"</h3>"+"</div>");

        },
        error: function (jqXHR) {
            alert("发生错误：" + jqXHR.status);
        }
    });
});

