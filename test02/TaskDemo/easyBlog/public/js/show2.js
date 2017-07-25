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
                $("#show").append("<span>"+data[i]['DATE']+"</span>");
                console.log(i);
                console.log(n);
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
        },
    });
});